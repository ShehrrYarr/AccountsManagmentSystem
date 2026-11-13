<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\LedgerAccount;
use App\Models\Account;
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

    /**
     * Cash and bank money. Overall: the admin's cash in hand + every company bank (money with
     * agents is separate: withAgents()). For one company: its banks + its net share of the admin's cash (what
     * the admin's cash holds for it; negative when the admin's cash was spent for it).
     *
     * @return array{cash: string, bank: string, total: string}
     */
    public static function money(?int $companyId = null): array
    {
        $bank = Money::of(Account::query()->banks()->whereNotNull('company_id')
            ->when($companyId, fn ($q) => $q->where('company_id', $companyId))->sum('current_balance'));

        $cash = $companyId
            ? self::adminCashFor($companyId)
            : Money::of(Account::query()->adminCashOnly()->sum('current_balance'));

        return ['cash' => $cash, 'bank' => $bank, 'total' => Money::add($cash, $bank)];
    }

    /** The company's net share of the admin's cash in hand, from the journal. */
    public static function adminCashFor(int $companyId): string
    {
        $cashIds = Account::withTrashed()->adminCashOnly()->pluck('id');

        return Money::of(JournalLedgerEntry::posted()
            ->where('journal_ledger_entries.ledger_account', LedgerAccount::Money->value)
            ->whereIn('journal_ledger_entries.account_id', $cashIds)
            ->where('journal_ledger_entries.company_id', $companyId)
            ->selectRaw('COALESCE(SUM(debit) - SUM(credit), 0) as b')->value('b'));
    }

    /**
     * Company money agents hold and owe back: advances + opening amounts − returns.
     * Per agent and company, from the Agent lines on the agents' accounts.
     *
     * @return Collection<int, object{agent_id: int, company_id: int, advanced: string, returned: string, owed: string}>
     */
    public static function agents(?int $companyId = null, ?int $agentId = null, mixed $asOf = null): Collection
    {
        return self::lines(LedgerAccount::Agent, $companyId, $asOf)
            ->join('accounts', 'accounts.id', '=', 'journal_ledger_entries.account_id')
            ->when($agentId, fn ($q) => $q->where('accounts.agent_id', $agentId))
            ->groupBy('accounts.agent_id', 'journal_ledger_entries.company_id')
            ->selectRaw('accounts.agent_id, journal_ledger_entries.company_id, SUM(debit) as advanced, SUM(credit) as returned')
            ->get()
            ->map(fn ($r) => (object) [
                'agent_id' => (int) $r->agent_id,
                'company_id' => (int) $r->company_id,
                'advanced' => Money::of($r->advanced),
                'returned' => Money::of($r->returned),
                'owed' => Money::sub($r->advanced, $r->returned),
            ]);
    }

    /** What an agent owes (one company, or all of them). */
    public static function agentOwed(int $agentId, ?int $companyId = null): string
    {
        return Money::add(...self::agents($companyId, $agentId)->pluck('owed')->all());
    }

    /** Total company money with agents (one company, or the whole business). */
    public static function withAgents(?int $companyId = null): string
    {
        return Money::add(...self::agents($companyId)->pluck('owed')->all());
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
