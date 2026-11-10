<?php

/**
 * Dashboard ApexCharts. Data is computed server-side; on 'transaction-updated' or a company change
 * the component pushes fresh data to the browser and the charts re-render in place.
 */

use App\Enums\LedgerAccount;
use App\Enums\PaymentMethod;
use App\Enums\TransactionType;
use App\Models\Account;
use App\Models\Department;
use App\Models\JournalLedgerEntry;
use App\Services\Balances;

use function Livewire\Volt\{computed, on, state};

state(['months' => 6, 'company' => null]);

$chartData = computed(function () {
    $start = now()->startOfMonth()->subMonths($this->months - 1);
    $companyId = $this->company ? (int) $this->company : null;

    // Money lines (cash / bank) by month and transaction type; transfers move money between my own accounts, so skip them.
    $lines = JournalLedgerEntry::posted()
        ->where('journal_ledger_entries.ledger_account', LedgerAccount::Money->value)
        ->whereNotIn('transactions.type', [TransactionType::AccountTransfer->value, TransactionType::InterCompanyTransfer->value, TransactionType::OpeningBalance->value])
        ->when($companyId, fn ($q) => $q->where('journal_ledger_entries.company_id', $companyId))
        ->where('transactions.date', '>=', $start->toDateString())
        ->get(['transactions.date', 'transactions.type', 'journal_ledger_entries.debit', 'journal_ledger_entries.credit']);

    $labels = $in = $out = [];
    for ($i = 0; $i < $this->months; $i++) {
        $month = $start->copy()->addMonths($i);
        $rows = $lines->filter(fn ($l) => substr((string) $l->date, 0, 7) === $month->format('Y-m'));
        $labels[] = $month->format('M y');
        $in[] = round((float) $rows->sum('debit'), 2);
        $out[] = round((float) $rows->sum('credit'), 2);
    }

    $accounts = Account::with('company')->where('current_balance', '>', 0)
        ->when($companyId, fn ($q) => $q->where('company_id', $companyId))
        ->orderByDesc('current_balance')->get();

    $names = Department::pluck('name', 'id');
    $top = Balances::departments($companyId)->groupBy('department_id')
        ->map(fn ($rows, $id) => ['name' => $names[$id] ?? '?', 'balance' => (float) $rows->sum(fn ($r) => (float) $r->balance)])
        ->filter(fn ($r) => $r['balance'] != 0)
        ->sortByDesc(fn ($r) => abs($r['balance']))->take(8)->values();

    // Spending for departments by method, plus general expenses, in the period.
    $spend = \App\Models\Payment::query()->whereDate('date', '>=', $start)
        ->when($companyId, fn ($q) => $q->where('company_id', $companyId))
        ->selectRaw('method, SUM(amount) as total')->groupBy('method')->get()
        ->mapWithKeys(fn ($r) => [$r->method->value => (float) $r->total]);
    $expenses = (float) \App\Models\Expense::query()->whereDate('date', '>=', $start)
        ->when($companyId, fn ($q) => $q->where('company_id', $companyId))->sum('amount');

    return [
        'monthly' => ['labels' => $labels, 'in' => $in, 'out' => $out],
        'liquidity' => [
            'labels' => $accounts->map(fn ($a) => $companyId ? $a->shortLabel() : $a->label())->all(),
            'values' => $accounts->map(fn ($a) => (float) $a->current_balance)->all(),
        ],
        'departments' => [
            'labels' => $top->pluck('name')->all(),
            'values' => $top->pluck('balance')->all(),
        ],
        'spendMix' => [
            'labels' => [...collect(PaymentMethod::cases())->map->label()->all(), 'General expenses'],
            'values' => [...collect(PaymentMethod::cases())->map(fn ($m) => $spend[$m->value] ?? 0)->all(), $expenses],
        ],
    ];
});

$refresh = function () {
    unset($this->chartData);
    $this->dispatch('charts-refresh', data: $this->chartData);
};

on([
    'transaction-updated' => fn () => $this->refresh(),
    'dashboard-company' => function (?int $company = null) {
        $this->company = $company;
        $this->refresh();
    },
]);

$updatedMonths = function () {
    $this->months = in_array((int) $this->months, [3, 6, 12, 24], true) ? (int) $this->months : 6;
    $this->refresh();
};

?>

<div x-data="amsCharts(@js($this->chartData))" x-on:charts-refresh.window="render($event.detail.data)">
    <div class="row g-3">
        <div class="col-xl-8">
            <div class="card h-100 mb-0">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 me-auto">Money in vs money out</h5>
                    <select class="form-select form-select-sm w-auto" wire:model.live="months" aria-label="Period">
                        <option value="3">3 months</option>
                        <option value="6">6 months</option>
                        <option value="12">12 months</option>
                        <option value="24">24 months</option>
                    </select>
                </div>
                <div class="card-body"><div wire:ignore x-ref="monthly"></div></div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Where the money is</h5></div>
                <div class="card-body"><div wire:ignore x-ref="liquidity"></div></div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Department balances</h5></div>
                <div class="card-body">
                    <div wire:ignore x-ref="departments"></div>
                    <div class="fs-12 text-muted">Positive: the department owes you. Negative: you hold their cheque money.</div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Spending ({{ $months }} months)</h5></div>
                <div class="card-body"><div wire:ignore x-ref="spendMix"></div></div>
            </div>
        </div>
    </div>
</div>
