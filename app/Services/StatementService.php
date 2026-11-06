<?php

namespace App\Services;

use App\Enums\LedgerAccount;
use App\Enums\TransactionStatus;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\JournalLedgerEntry;
use App\Support\Money;
use Illuminate\Support\Carbon;

/**
 * Statement of account for one company, built from the journal:
 * opening position, every posted movement of payable / receivable with
 * running balances, closing position and cheques still in clearing.
 */
class StatementService
{
    public function build(Company $company, ?string $from = null, ?string $to = null): array
    {
        $from = $from ? Carbon::parse($from)->startOfDay() : null;
        $to = $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay();

        $entries = fn () => JournalLedgerEntry::query()
            ->join('transactions', 'transactions.id', '=', 'journal_ledger_entries.transaction_id')
            ->where('transactions.status', TransactionStatus::Posted->value)
            ->where('journal_ledger_entries.company_id', $company->id)
            ->whereIn('journal_ledger_entries.ledger_account', [LedgerAccount::CompanyPayable->value, LedgerAccount::CompanyReceivable->value]);

        // Opening position (everything before the period).
        $openingPayable = '0.00';
        $openingReceivable = '0.00';
        if ($from) {
            $before = $entries()->where('transactions.date', '<', $from->toDateString())
                ->selectRaw('journal_ledger_entries.ledger_account as acc, SUM(credit) as cr, SUM(debit) as dr')
                ->groupBy('journal_ledger_entries.ledger_account')->get()->keyBy('acc');
            $p = $before[LedgerAccount::CompanyPayable->value] ?? null;
            $r = $before[LedgerAccount::CompanyReceivable->value] ?? null;
            $openingPayable = $p ? Money::sub($p->cr, $p->dr) : '0.00';
            $openingReceivable = $r ? Money::sub($r->dr, $r->cr) : '0.00';
        }

        $lines = $entries()
            ->when($from, fn ($q) => $q->where('transactions.date', '>=', $from->toDateString()))
            ->where('transactions.date', '<=', $to->toDateString())
            ->orderBy('transactions.date')->orderBy('transactions.id')
            ->get([
                'transactions.id as tx_id', 'transactions.date', 'transactions.type', 'transactions.description',
                'transactions.cheque_number', 'transactions.notes',
                'journal_ledger_entries.ledger_account', 'journal_ledger_entries.debit', 'journal_ledger_entries.credit',
            ]);

        $rows = [];
        $payable = $openingPayable;
        $receivable = $openingReceivable;
        $totals = ['credited' => '0.00', 'paid' => '0.00', 'charged' => '0.00', 'recovered' => '0.00'];

        foreach ($lines->groupBy('tx_id') as $txLines) {
            $first = $txLines->first();
            $payDelta = '0.00';
            $recDelta = '0.00';
            foreach ($txLines as $l) {
                $acc = $l->ledger_account instanceof LedgerAccount ? $l->ledger_account : LedgerAccount::from($l->ledger_account);
                if ($acc === LedgerAccount::CompanyPayable) {
                    $payDelta = Money::add($payDelta, Money::sub($l->credit, $l->debit));
                } else {
                    $recDelta = Money::add($recDelta, Money::sub($l->debit, $l->credit));
                }
            }

            $payable = Money::add($payable, $payDelta);
            $receivable = Money::add($receivable, $recDelta);

            $totals['credited'] = Money::add($totals['credited'], Money::isPositive($payDelta) ? $payDelta : 0);
            $totals['paid'] = Money::add($totals['paid'], Money::isNegative($payDelta) ? Money::sub(0, $payDelta) : 0);
            $totals['charged'] = Money::add($totals['charged'], Money::isPositive($recDelta) ? $recDelta : 0);
            $totals['recovered'] = Money::add($totals['recovered'], Money::isNegative($recDelta) ? Money::sub(0, $recDelta) : 0);

            $type = $first->type instanceof \App\Enums\TransactionType ? $first->type : \App\Enums\TransactionType::from($first->type);

            $rows[] = [
                'date' => Carbon::parse($first->date),
                'type' => $type,
                'description' => $first->description,
                'reference' => $first->cheque_number,
                'notes' => $first->notes,
                'credit' => Money::isPositive($payDelta) ? $payDelta : null,          // payable up: money credited to company
                'debit' => Money::isNegative($payDelta) ? Money::sub(0, $payDelta) : null, // payable down: paid out
                'receivable_change' => Money::isZero($recDelta) ? null : $recDelta,
                'payable' => $payable,
                'receivable' => $receivable,
            ];
        }

        $pending = Cheque::pending()->where('company_id', $company->id)->orderBy('received_date')->get();

        return [
            'company' => $company,
            'from' => $from,
            'to' => $to,
            'openingPayable' => $openingPayable,
            'openingReceivable' => $openingReceivable,
            'rows' => $rows,
            'totals' => $totals,
            'closingPayable' => $payable,
            'closingReceivable' => $receivable,
            'net' => Money::sub($payable, $receivable),
            'hasReceivable' => ! Money::isZero($openingReceivable) || ! Money::isZero($receivable) || collect($rows)->contains(fn ($r) => $r['receivable_change'] !== null),
            'pendingCheques' => $pending,
            'pendingTotal' => Money::of($pending->sum('amount')),
            'generatedAt' => now(),
        ];
    }
}
