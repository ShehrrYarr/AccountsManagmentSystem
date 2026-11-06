<?php

/**
 * Dashboard ApexCharts. Data is computed server-side; on 'transaction-updated'
 * the component pushes fresh data to the browser and the charts re-render in place.
 */

use App\Enums\DisbursementType;
use App\Enums\RecordStatus;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Disbursement;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

use function Livewire\Volt\{computed, on, state};

state(['months' => 12]);

$chartData = computed(function () {
    $start = now()->startOfMonth()->subMonths($this->months - 1);

    // Group in PHP so this works the same on MySQL and SQLite.
    $flows = Transaction::query()
        ->where('status', TransactionStatus::Posted)
        ->whereIn('type', [...TransactionType::inflows(), ...TransactionType::outflows()])
        ->whereDate('date', '>=', $start)
        ->get(['date', 'type', 'amount']);

    $labels = $in = $out = [];
    for ($i = 0; $i < $this->months; $i++) {
        $month = $start->copy()->addMonths($i);
        $key = $month->format('Y-m');
        $labels[] = $month->format('M y');
        $monthRows = $flows->filter(fn ($t) => $t->date->format('Y-m') === $key);
        $in[] = round((float) $monthRows->filter(fn ($t) => in_array($t->type, TransactionType::inflows(), true))->sum('amount'), 2);
        $out[] = round((float) $monthRows->filter(fn ($t) => in_array($t->type, TransactionType::outflows(), true))->sum('amount'), 2);
    }

    $accounts = BankAccount::where('current_balance', '>', 0)->orderByDesc('current_balance')->get(['name', 'current_balance']);
    $top = Company::where('payable_balance', '>', 0)->orderByDesc('payable_balance')->limit(10)->get(['name', 'payable_balance']);
    $mix = Disbursement::where('status', RecordStatus::Posted)->whereDate('date', '>=', $start)
        ->selectRaw('type, SUM(amount) as total')->groupBy('type')->pluck('total', 'type');

    return [
        'monthly' => ['labels' => $labels, 'in' => $in, 'out' => $out],
        'liquidity' => [
            'labels' => $accounts->pluck('name')->all(),
            'values' => $accounts->map(fn ($a) => (float) $a->current_balance)->all(),
        ],
        'topCompanies' => [
            'labels' => $top->pluck('name')->all(),
            'values' => $top->map(fn ($c) => (float) $c->payable_balance)->all(),
        ],
        'payoutMix' => [
            'labels' => collect(DisbursementType::cases())->map->label()->all(),
            'values' => collect(DisbursementType::cases())->map(fn ($t) => (float) ($mix[$t->value] ?? 0))->all(),
        ],
    ];
});

$refresh = function () {
    unset($this->chartData);
    $this->dispatch('charts-refresh', data: $this->chartData);
};

on(['transaction-updated' => fn () => $this->refresh()]);

$updatedMonths = function () {
    $this->months = in_array((int) $this->months, [3, 6, 12, 24], true) ? (int) $this->months : 12;
    $this->refresh();
};

?>

<div x-data="amsCharts(@js($this->chartData))" x-on:charts-refresh.window="render($event.detail.data)">
    <div class="row g-3">
        <div class="col-xl-8">
            <div class="card h-100 mb-0">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 me-auto">Cash in vs cash out</h5>
                    <select class="form-select form-select-sm w-auto" wire:model.live="months">
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
                <div class="card-header"><h5 class="card-title mb-0">Where my money is</h5></div>
                <div class="card-body"><div wire:ignore x-ref="liquidity"></div></div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Top companies by amount owed</h5></div>
                <div class="card-body"><div wire:ignore x-ref="topCompanies"></div></div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Payout methods ({{ $months }} months)</h5></div>
                <div class="card-body"><div wire:ignore x-ref="payoutMix"></div></div>
            </div>
        </div>
    </div>
</div>
