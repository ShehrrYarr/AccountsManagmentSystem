<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\LedgerAccount;
use App\Models\Account;
use App\Models\Cheque;
use App\Models\JournalLedgerEntry;
use App\Support\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Read-only balance queries over the posted journal. Department, supplier and inter-company
 * balances are not cached anywhere; the journal is the single source of truth.
 */
class Balances
{
    private static function lines(LedgerAccount $account, ?int $companyId = null, mixed $asOf = null): Builder
    {
        return JournalLedgerEntry::posted()
            ->where('journal_ledger_entries.ledger_account', $account->value)
            ->when($companyId, fn ($q) => $q->where('journal_ledger_entries.company_id', $companyId))
            ->when($asOf, fn ($q) => $q->where('transactions.date', '<=', Carbon::parse($asOf)->toDateString()));
    }

    /**
     * Per department and company: spent (debits), cheques & closings (credits), balance (debit − credit).
     * Balance > 0: the department owes me. < 0: I hold its money (cheque came first).
     *
     * @return Collection<int, object{department_id: int, company_id: int, spent: string, received: string, balance: string}>
     */
    public static function departments(?int $companyId = null, ?int $departmentId = null, mixed $asOf = null): Collection
    {
        return self::lines(LedgerAccount::Department, $companyId, $asOf)
            ->when($departmentId, fn ($q) => $q->where('journal_ledger_entries.department_id', $departmentId))
            ->groupBy('journal_ledger_entries.department_id', 'journal_ledger_entries.company_id')
            ->selectRaw('journal_ledger_entries.department_id, journal_ledger_entries.company_id, SUM(debit) as spent, SUM(credit) as received')
            ->get()
            ->map(fn ($r) => (object) [
                'department_id' => (int) $r->department_id,
                'company_id' => (int) $r->company_id,
                'spent' => Money::of($r->spent),
                'received' => Money::of($r->received),
                'balance' => Money::sub($r->spent, $r->received),
            ]);
    }

    public static function departmentBalance(int $departmentId, ?int $companyId = null, mixed $asOf = null): string
    {
        return Money::add(...self::departments($companyId, $departmentId, $asOf)->pluck('balance')->all());
    }

    /**
     * Per supplier and company: purchased (credits), paid (debits), owed (credit − debit).
     *
     * @return Collection<int, object{supplier_id: int, company_id: int, purchased: string, paid: string, owed: string}>
     */
    public static function suppliers(?int $companyId = null, ?int $supplierId = null): Collection
    {
        return self::lines(LedgerAccount::Supplier, $companyId)
            ->when($supplierId, fn ($q) => $q->where('journal_ledger_entries.supplier_id', $supplierId))
            ->groupBy('journal_ledger_entries.supplier_id', 'journal_ledger_entries.company_id')
            ->selectRaw('journal_ledger_entries.supplier_id, journal_ledger_entries.company_id, SUM(credit) as purchased, SUM(debit) as paid')
            ->get()
            ->map(fn ($r) => (object) [
                'supplier_id' => (int) $r->supplier_id,
                'company_id' => (int) $r->company_id,
                'purchased' => Money::of($r->purchased),
                'paid' => Money::of($r->paid),
                'owed' => Money::sub($r->purchased, $r->paid),
            ]);
    }

    public static function supplierOwed(int $supplierId, ?int $companyId = null): string
    {
        return Money::add(...self::suppliers($companyId, $supplierId)->pluck('owed')->all());
    }

    /**
     * What each other company owes $companyId (positive) or is owed by it (negative).
     *
     * @return Collection<int, string> counterparty company id => balance
     */
    public static function interCompany(int $companyId): Collection
    {
        return self::lines(LedgerAccount::InterCompany, $companyId)
            ->groupBy('journal_ledger_entries.counterparty_company_id')
            ->selectRaw('journal_ledger_entries.counterparty_company_id as cid, SUM(debit) - SUM(credit) as bal')
            ->pluck('bal', 'cid')
            ->map(fn ($v) => Money::of($v))
            ->reject(fn ($v) => Money::isZero($v));
    }

    /** Positive: $debtor owes $creditor. */
    public static function owedBetween(int $creditor, int $debtor): string
    {
        return Money::of(self::interCompany($creditor)[$debtor] ?? 0);
    }

    /** @return array{cash: string, bank: string, total: string} */
    public static function money(?int $companyId = null): array
    {
        $accounts = Account::query()->when($companyId, fn ($q) => $q->where('company_id', $companyId))->get(['type', 'current_balance']);
        $cash = Money::of($accounts->where('type', AccountType::Cash)->sum('current_balance'));
        $bank = Money::of($accounts->where('type', AccountType::Bank)->sum('current_balance'));

        return ['cash' => $cash, 'bank' => $bank, 'total' => Money::add($cash, $bank)];
    }

    /** @return array{count: int, amount: string} */
    public static function chequesInHand(?int $companyId = null, ?int $departmentId = null): array
    {
        $q = Cheque::inHand()
            ->when($companyId, fn ($q) => $q->where('company_id', $companyId))
            ->when($departmentId, fn ($q) => $q->where('department_id', $departmentId));

        return ['count' => (clone $q)->count(), 'amount' => Money::of((clone $q)->sum('amount'))];
    }

    /**
     * Profit for a period: deal profits − deal losses − expenses − bank charges.
     *
     * @return array{deals: string, expenses: string, charges: string, net: string}
     */
    public static function profit(?int $companyId = null, mixed $from = null, mixed $to = null): array
    {
        $sum = function (LedgerAccount $account, string $expr) use ($companyId, $from, $to) {
            return Money::of(self::lines($account, $companyId)
                ->when($from, fn ($q) => $q->where('transactions.date', '>=', Carbon::parse($from)->toDateString()))
                ->when($to, fn ($q) => $q->where('transactions.date', '<=', Carbon::parse($to)->toDateString()))
                ->selectRaw("COALESCE({$expr}, 0) as v")->value('v'));
        };

        $deals = $sum(LedgerAccount::DealResult, 'SUM(credit) - SUM(debit)');
        $expenses = $sum(LedgerAccount::Expense, 'SUM(debit) - SUM(credit)');
        $charges = $sum(LedgerAccount::BankCharges, 'SUM(debit) - SUM(credit)');

        return [
            'deals' => $deals,
            'expenses' => $expenses,
            'charges' => $charges,
            'net' => Money::sub($deals, Money::add($expenses, $charges)),
        ];
    }
}
