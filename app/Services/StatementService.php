<?php

namespace App\Services;

use App\Enums\LedgerAccount;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\JournalLedgerEntry;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Support\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Running-balance statements built from the posted journal:
 *
 *   account     a bank account or cash in hand (cash statement): money in / out
 *   department  customer ledger: spent for them / cheques received, optionally for one company
 *   supplier    supplier ledger: purchased / paid, optionally for one company
 *   company     everything one company did, with its total cash + bank balance
 */
class StatementService
{
    public const KINDS = ['account', 'department', 'supplier', 'company'];

    public function subject(string $kind, int $id): Account|Department|Supplier|Company
    {
        return match ($kind) {
            'account' => Account::withTrashed()->with('company')->findOrFail($id),
            'department' => Department::findOrFail($id),
            'supplier' => Supplier::findOrFail($id),
            'company' => Company::withTrashed()->findOrFail($id),
        };
    }

    public function build(string $kind, int $id, ?int $companyId = null, ?string $from = null, ?string $to = null): array
    {
        abort_unless(in_array($kind, self::KINDS, true), 404);

        $subject = $this->subject($kind, $id);
        $from = $from ? Carbon::parse($from)->startOfDay() : null;
        $to = $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay();
        $company = $kind === 'company' ? $subject : (($kind === 'account' ? $subject->company : null) ?? ($companyId ? Company::withTrashed()->find($companyId) : null));
        // The admin's cash is shared by every company: its statement can be narrowed to one.
        $sharedCash = $kind === 'account' && $subject->isAdminCash();

        $meta = match ($kind) {
            'account' => [
                'title' => $subject->isCash() ? 'Cash Statement' : 'Bank Statement',
                'name' => $subject->shortLabel(),
                'debit' => 'Money in', 'credit' => 'Money out', 'balance' => 'Balance', 'sign' => 1,
                'note' => null,
                'filter' => fn (Builder $q) => $q->where('journal_ledger_entries.ledger_account', LedgerAccount::Money->value)
                    ->where('journal_ledger_entries.account_id', $id)
                    ->when($sharedCash && $companyId, fn ($q) => $q->where('journal_ledger_entries.company_id', $companyId)),
            ],
            'department' => [
                'title' => 'Department Ledger',
                'name' => $subject->name,
                'debit' => 'Spent for them', 'credit' => 'Cheques received', 'balance' => 'Balance', 'sign' => 1,
                'note' => 'Positive balance = the department owes you. Negative = cheques received ahead of spending (you hold their money).',
                'filter' => fn (Builder $q) => $q->where('journal_ledger_entries.ledger_account', LedgerAccount::Department->value)
                    ->where('journal_ledger_entries.department_id', $id)
                    ->when($companyId, fn ($q) => $q->where('journal_ledger_entries.company_id', $companyId)),
            ],
            'supplier' => [
                'title' => 'Supplier Ledger',
                'name' => $subject->name,
                'debit' => 'Paid', 'credit' => 'Purchased', 'balance' => 'You owe', 'sign' => -1,
                'note' => null,
                'filter' => fn (Builder $q) => $q->where('journal_ledger_entries.ledger_account', LedgerAccount::Supplier->value)
                    ->where('journal_ledger_entries.supplier_id', $id)
                    ->when($companyId, fn ($q) => $q->where('journal_ledger_entries.company_id', $companyId)),
            ],
            'company' => [
                'title' => 'Company Ledger',
                'name' => $subject->name,
                'debit' => 'Money in', 'credit' => 'Money out', 'balance' => 'Cash + bank', 'sign' => 1,
                'note' => 'Every transaction of the company. Rows without money in or out (goods on credit, deal closings) change other balances, not cash or bank.',
                'filter' => fn (Builder $q) => $q->where('journal_ledger_entries.ledger_account', LedgerAccount::Money->value)
                    ->where('journal_ledger_entries.company_id', $id),
            ],
        };

        $lines = fn () => $meta['filter'](JournalLedgerEntry::posted());

        $opening = '0.00';
        if ($from) {
            $before = $lines()->where('transactions.date', '<', $from->toDateString())
                ->selectRaw('COALESCE(SUM(debit), 0) as dr, COALESCE(SUM(credit), 0) as cr')->first();
            $opening = $this->signed(Money::sub($before->dr, $before->cr), $meta['sign']);
        }

        $period = $lines()
            ->when($from, fn ($q) => $q->where('transactions.date', '>=', $from->toDateString()))
            ->where('transactions.date', '<=', $to->toDateString())
            ->get(['journal_ledger_entries.transaction_id', 'journal_ledger_entries.company_id as line_company_id', 'debit', 'credit'])
            ->groupBy('transaction_id');

        // The company ledger also lists transactions that moved no money.
        $txIds = $kind === 'company'
            ? Transaction::query()->posted()
                ->whereHas('entries', fn ($q) => $q->where('company_id', $id))
                ->when($from, fn ($q) => $q->whereDate('date', '>=', $from->toDateString()))
                ->whereDate('date', '<=', $to->toDateString())
                ->pluck('id')
            : $period->keys();

        $transactions = Transaction::query()
            ->whereIn('id', $txIds)
            ->with(['company', 'counterpartyCompany', 'department', 'supplier'])
            ->orderBy('date')->orderBy('id')
            ->get();

        $balance = $opening;
        $totals = ['debit' => '0.00', 'credit' => '0.00'];
        $rows = [];
        $companyNames = Company::withTrashed()->pluck('name', 'id');

        foreach ($transactions as $t) {
            $txLines = $period->get($t->id, collect());
            $debit = Money::add(...$txLines->pluck('debit')->all());
            $credit = Money::add(...$txLines->pluck('credit')->all());
            $balance = Money::add($balance, $this->signed(Money::sub($debit, $credit), $meta['sign']));
            $totals['debit'] = Money::add($totals['debit'], $debit);
            $totals['credit'] = Money::add($totals['credit'], $credit);

            $lineCompany = $txLines->first()?->line_company_id ?? $t->company_id;

            $rows[] = [
                'id' => $t->id,
                'date' => $t->date,
                'type' => $t->type,
                'description' => $t->description,
                'reference' => $t->reference,
                'notes' => $t->notes,
                'company' => $companyNames[$lineCompany] ?? null,
                'amount' => $t->amount,
                'debit' => Money::isZero($debit) ? null : $debit,
                'credit' => Money::isZero($credit) ? null : $credit,
                'balance' => $balance,
            ];
        }

        return [
            'kind' => $kind,
            'subject' => $subject,
            'company' => $company,
            'title' => $meta['title'],
            'name' => $meta['name'],
            'labels' => ['debit' => $meta['debit'], 'credit' => $meta['credit'], 'balance' => $meta['balance']],
            'note' => $meta['note'],
            'showCompany' => (in_array($kind, ['department', 'supplier'], true) || $sharedCash) && ! $companyId,
            'companyFilter' => in_array($kind, ['department', 'supplier'], true) || $sharedCash,
            'showAmount' => $kind === 'company',
            'from' => $from,
            'to' => $to,
            'opening' => $opening,
            'rows' => $rows,
            'totals' => $totals,
            'closing' => $balance,
            'generatedAt' => now(),
        ];
    }

    private function signed(string $value, int $sign): string
    {
        return $sign < 0 ? Money::sub(0, $value) : $value;
    }
}
