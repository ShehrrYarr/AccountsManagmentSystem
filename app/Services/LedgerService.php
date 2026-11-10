<?php

namespace App\Services;

use App\Enums\LedgerAccount;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contracts\PostsToLedger;
use App\Models\JournalLedgerEntry;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Support\Money;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * The only place that writes to the journal and touches cached balances.
 *
 * Every posting is a balanced set of debit/credit lines, and the lines of each company
 * balance on their own. The cached balance of each cash / bank account is updated in the
 * same database transaction.
 *
 * Invariants (checked when the outermost batch finishes, so an edit may void and re-post
 * without tripping over intermediate states):
 *   - no cash / bank account may go below zero
 *   - no company may owe a supplier less than zero (no paying more than is owed)
 */
class LedgerService
{
    private int $depth = 0;

    /** @var array<int, string> account id => balance before the batch */
    private array $touchedAccounts = [];

    /** @var array<string, array{company: int, supplier: int}> */
    private array $touchedSuppliers = [];

    /**
     * Run several postings / voids atomically; invariants are verified once at the end.
     */
    public function batch(Closure $callback): mixed
    {
        return DB::transaction(function () use ($callback) {
            $this->depth++;

            try {
                $result = $callback();

                if ($this->depth === 1) {
                    $this->assertInvariants();
                }

                return $result;
            } finally {
                $this->depth--;
                if ($this->depth === 0) {
                    $this->touchedAccounts = [];
                    $this->touchedSuppliers = [];
                }
            }
        });
    }

    /**
     * Save a source document and (re)build its journal postings.
     */
    public function record(Model&PostsToLedger $document): Model
    {
        return $this->batch(function () use ($document) {
            $document->save();
            $this->sync($document);

            return $document;
        });
    }

    /** Void a document's postings and soft-delete it. */
    public function remove(Model&PostsToLedger $document): void
    {
        $this->batch(function () use ($document) {
            $this->voidAllFor($document);
            $document->delete();
        });
    }

    /** Void what the document posted before and post its current state. */
    public function sync(Model&PostsToLedger $document): void
    {
        $this->batch(function () use ($document) {
            $this->voidAllFor($document);

            // Foreign keys may have changed since relations were loaded; let descriptions reload them.
            $document->unsetRelations();

            foreach ($document->ledgerPostings() as $p) {
                $this->post($p['type'], $p['date'], $p['lines'], $p['attributes'] ?? [], $document, $p['allowEmpty'] ?? false);
            }
        });
    }

    /**
     * Post a balanced journal transaction.
     *
     * @param  array<int, array<string, mixed>>  $lines  each: account (LedgerAccount), debit|credit, company_id, + the party column
     * @param  array<string, mixed>  $attributes  extra Transaction columns
     * @param  bool  $allowEmpty  return null instead of failing when every line is zero (e.g. a zero opening balance)
     */
    public function post(TransactionType $type, mixed $date, array $lines, array $attributes = [], ?Model $source = null, bool $allowEmpty = false): ?Transaction
    {
        return $this->batch(function () use ($type, $date, $lines, $attributes, $source, $allowEmpty) {
            $lines = $this->normaliseLines($lines);

            if ($lines === [] && $allowEmpty) {
                return null;
            }

            $total = $this->assertBalanced($lines);

            $transaction = Transaction::create(array_merge([
                'date' => $date,
                'type' => $type,
                'amount' => $total,
                'description' => $type->label(),
                'status' => TransactionStatus::Posted,
                'created_by' => auth()->id(),
            ], $attributes, $source ? [
                'source_type' => $source->getMorphClass(),
                'source_id' => $source->getKey(),
            ] : []));

            foreach ($lines as $line) {
                $line['ledger_account'] = $line['account'];
                unset($line['account']);
                $transaction->entries()->create($line);
            }

            $this->applyBalances($lines, 1);

            return $transaction;
        });
    }

    /** Void one transaction: its effect on balances is removed, the row is kept for history. */
    public function void(Transaction $transaction): void
    {
        if ($transaction->status === TransactionStatus::Void) {
            return;
        }

        $this->batch(function () use ($transaction) {
            $lines = $transaction->entries->map(fn (JournalLedgerEntry $e) => [
                'account' => $e->ledger_account,
                'company_id' => $e->company_id,
                'account_id' => $e->account_id,
                'supplier_id' => $e->supplier_id,
                'debit' => Money::of($e->debit),
                'credit' => Money::of($e->credit),
            ])->all();

            $this->applyBalances($lines, -1);

            $transaction->update([
                'status' => TransactionStatus::Void,
                'voided_by' => auth()->id(),
                'voided_at' => now(),
            ]);
        });
    }

    /** Void every posted transaction generated by a source document. */
    public function voidAllFor(Model $source): void
    {
        if (! $source->exists) {
            return;
        }

        $this->batch(function () use ($source) {
            Transaction::query()
                ->where('source_type', $source->getMorphClass())
                ->where('source_id', $source->getKey())
                ->where('status', TransactionStatus::Posted)
                ->with('entries')
                ->orderByDesc('id')
                ->get()
                ->each(fn (Transaction $t) => $this->void($t));
        });
    }

    /**
     * Rebuild every cached account balance from the posted journal lines.
     * Safe to run at any time (artisan ams:recalculate-balances).
     */
    public function recalculateAll(): void
    {
        DB::transaction(function () {
            $balances = JournalLedgerEntry::posted()
                ->where('journal_ledger_entries.ledger_account', LedgerAccount::Money->value)
                ->groupBy('journal_ledger_entries.account_id')
                ->selectRaw('journal_ledger_entries.account_id as aid, SUM(debit) - SUM(credit) as bal')
                ->pluck('bal', 'aid');

            Account::withTrashed()->pluck('id')->each(function ($id) use ($balances) {
                DB::table('accounts')->where('id', $id)->update(['current_balance' => Money::of($balances[$id] ?? 0)]);
            });
        });
    }

    // ---------------------------------------------------------------------

    private function normaliseLines(array $lines): array
    {
        $out = [];

        foreach ($lines as $line) {
            $debit = Money::of($line['debit'] ?? 0);
            $credit = Money::of($line['credit'] ?? 0);

            if (Money::isZero($debit) && Money::isZero($credit)) {
                continue; // drop empty lines such as zero bank charges
            }

            if (Money::isNegative($debit) || Money::isNegative($credit)) {
                throw new \LogicException('Journal lines must not be negative.');
            }

            /** @var LedgerAccount $account */
            $account = $line['account'];

            if (empty($line['company_id'])) {
                throw new \LogicException("{$account->label()} lines require company_id.");
            }

            if (($column = $account->partyColumn()) && empty($line[$column])) {
                throw new \LogicException("{$account->label()} lines require {$column}.");
            }

            $out[] = [
                'account' => $account,
                'company_id' => (int) $line['company_id'],
                'account_id' => $line['account_id'] ?? null,
                'department_id' => $line['department_id'] ?? null,
                'supplier_id' => $line['supplier_id'] ?? null,
                'counterparty_company_id' => $line['counterparty_company_id'] ?? null,
                'expense_category_id' => $line['expense_category_id'] ?? null,
                'debit' => $debit,
                'credit' => $credit,
                'memo' => $line['memo'] ?? null,
            ];
        }

        return $out;
    }

    /** Debits = credits overall and within every company. Returns the total. */
    private function assertBalanced(array $lines): string
    {
        $debits = Money::add(...array_column($lines, 'debit'));
        $credits = Money::add(...array_column($lines, 'credit'));

        if ($lines === [] || Money::cmp($debits, $credits) !== 0 || Money::isZero($debits)) {
            throw new \LogicException("Unbalanced journal: debits {$debits} vs credits {$credits}.");
        }

        foreach (collect($lines)->groupBy('company_id') as $companyId => $companyLines) {
            $d = Money::add(...$companyLines->pluck('debit')->all());
            $c = Money::add(...$companyLines->pluck('credit')->all());
            if (Money::cmp($d, $c) !== 0) {
                throw new \LogicException("Unbalanced journal for company {$companyId}: debits {$d} vs credits {$c}.");
            }
        }

        return $debits;
    }

    /** @param  int  $sign  1 = apply, -1 = undo */
    private function applyBalances(array $lines, int $sign): void
    {
        $deltas = [];

        foreach ($lines as $l) {
            if ($l['account'] === LedgerAccount::Money) {
                $deltas[$l['account_id']] = Money::add($deltas[$l['account_id']] ?? 0, Money::sub($l['debit'], $l['credit']));
            }

            if ($l['account'] === LedgerAccount::Supplier) {
                $this->touchedSuppliers[$l['company_id'].'-'.$l['supplier_id']] = ['company' => $l['company_id'], 'supplier' => $l['supplier_id']];
            }
        }

        // Fixed lock order (by id) avoids deadlocks between concurrent postings.
        ksort($deltas);

        foreach ($deltas as $id => $delta) {
            $delta = $sign < 0 ? Money::sub(0, $delta) : $delta;

            if (! isset($this->touchedAccounts[$id])) {
                $this->touchedAccounts[$id] = Money::of(DB::table('accounts')->where('id', $id)->lockForUpdate()->value('current_balance'));
            }

            DB::table('accounts')->where('id', $id)->update([
                'current_balance' => DB::raw('current_balance + ('.Money::of($delta).')'),
            ]);
        }
    }

    private function assertInvariants(): void
    {
        foreach ($this->touchedAccounts as $id => $before) {
            $account = Account::withTrashed()->with('company')->find($id);
            if (Money::isNegative($account->current_balance)) {
                throw new BusinessRuleException(
                    "Not enough money in {$account->label()}. Available: ".money($before).
                    ', short by '.money(Money::sub(0, $account->current_balance)).'.',
                    'amount'
                );
            }
        }

        foreach ($this->touchedSuppliers as $pair) {
            $owed = Balances::supplierOwed($pair['supplier'], $pair['company']);
            if (Money::isNegative($owed)) {
                $supplier = Supplier::find($pair['supplier']);
                $company = Company::withTrashed()->find($pair['company']);
                throw new BusinessRuleException(
                    "This is more than {$company->name} owes {$supplier->name}. Overpaid by ".money(Money::sub(0, $owed)).'.',
                    'amount'
                );
            }
        }
    }
}
