<?php

/**
 * Real-time stat cards. Re-queries whenever any component dispatches 'transaction-updated'.
 */

use App\Enums\BankAccountType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionStatus;
use App\Models\BankAccount;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\JournalLedgerEntry;
use App\Support\Money;

use function Livewire\Volt\{computed, on};

$metrics = computed(function () {
    $pending = Cheque::pending();
    $accounts = BankAccount::query()->get(['id', 'type', 'current_balance', 'is_active']);

    // My commission earned this month, straight from the journal.
    $commission = JournalLedgerEntry::query()
        ->where('ledger_account', LedgerAccount::CommissionIncome)
        ->whereHas('transaction', fn ($q) => $q->where('status', TransactionStatus::Posted)
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()]))
        ->selectRaw('COALESCE(SUM(credit) - SUM(debit), 0) as total')->value('total');

    return [
        'pendingCount' => (clone $pending)->count(),
        'pendingAmount' => Money::of((clone $pending)->sum('amount')),
        'expiring' => (clone $pending)->whereDate('expiry_date', '<=', now()->addDays(Cheque::EXPIRY_WARNING_DAYS))->count(),
        'vault' => Money::of($accounts->where('type', BankAccountType::Cash)->sum('current_balance')),
        'bank' => Money::of($accounts->where('type', BankAccountType::Bank)->sum('current_balance')),
        'bankCount' => $accounts->where('type', BankAccountType::Bank)->where('is_active', true)->count(),
        'payables' => Money::of(Company::sum('payable_balance')),
        'payableCompanies' => Company::where('payable_balance', '>', 0)->count(),
        'receivables' => Money::of(Company::sum('receivable_balance')),
        'receivableCompanies' => Company::where('receivable_balance', '>', 0)->count(),
        'commission' => Money::of($commission),
    ];
});

on(['transaction-updated' => function () {
    unset($this->metrics);
}]);

?>

<div class="row g-3 mb-4" wire:poll.120s.visible>
    @php($m = $this->metrics)
    <div class="col-sm-6 col-xxl">
        <x-stat-card label="Cheques pending clearing" :value="money($m['pendingAmount'])" icon="ri-time-line" color="warning"
            :hint="$m['pendingCount'].' cheque(s)'.($m['expiring'] ? ' · <span class=\'text-danger\'>'.$m['expiring'].' expiring</span>' : '')" :href="route('cheques.index', ['status' => 'received'])" />
    </div>
    <div class="col-sm-6 col-xxl">
        <x-stat-card label="Cash in vault" :value="money($m['vault'])" icon="ri-safe-2-line" color="success" hint="Physical cash on hand" :href="route('bank-accounts.index')" />
    </div>
    <div class="col-sm-6 col-xxl">
        <x-stat-card label="Bank liquidity" :value="money($m['bank'])" icon="ri-bank-line" color="primary" :hint="$m['bankCount'].' active bank account(s)'" :href="route('bank-accounts.index')" />
    </div>
    <div class="col-sm-6 col-xxl">
        <x-stat-card label="Payable to companies" :value="money($m['payables'])" icon="ri-building-2-line" color="info" :hint="$m['payableCompanies'].' company(ies) owed'" :href="route('companies.index')" />
    </div>
    <div class="col-sm-6 col-xxl">
        <x-stat-card label="Receivable from companies" :value="money($m['receivables'])" icon="ri-arrow-go-back-line" color="danger" :hint="$m['receivableCompanies'].' company(ies) owe you'" :href="route('companies.index')" />
    </div>
    <div class="col-sm-6 col-xxl">
        <x-stat-card label="Commission this month" :value="money($m['commission'])" icon="ri-percent-line" color="secondary" :hint="now()->format('F Y')" />
    </div>
</div>
