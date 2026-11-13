<?php

/**
 * Real-time stat cards, for all companies or one. Re-queries on 'transaction-updated';
 * the company picker also tells the charts which company to show.
 */

use App\Services\Balances;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, state};

state(['company' => null]);

$metrics = computed(function () {
    $companyId = $this->company ? (int) $this->company : null;
    $depts = Balances::departments($companyId);

    return [
        'money' => Balances::money($companyId),
        'agents' => Balances::withAgents($companyId),
        'owedToAgents' => Balances::owedToAgents($companyId),
        'cheques' => (function () use ($companyId) {
            $q = \App\Models\Cheque::query()->when($companyId, fn ($q) => $q->where('company_id', $companyId))
                ->whereBetween('date', [now()->startOfMonth()->toDateString(), now()->toDateString()]);

            return ['amount' => Money::of((clone $q)->sum('amount')), 'count' => (clone $q)->count()];
        })(),
        'deptsOwe' => Money::add(...$depts->filter(fn ($r) => Money::isPositive($r->balance))->pluck('balance')->all()),
        'deptsOweCount' => $depts->filter(fn ($r) => Money::isPositive($r->balance))->unique('department_id')->count(),
        'deptsHeld' => Money::sub(0, Money::add(...$depts->filter(fn ($r) => Money::isNegative($r->balance))->pluck('balance')->all())),
        'suppliers' => Money::add(...Balances::suppliers($companyId)->pluck('owed')->all()),
        'profit' => Balances::profit($companyId, now()->startOfMonth(), now()),
    ];
});

$companyOptions = computed(fn () => Options::companies());

$updatedCompany = function () {
    $this->dispatch('dashboard-company', company: $this->company ? (int) $this->company : null);
};

on(['transaction-updated' => function () {
    unset($this->metrics);
}]);

?>

<div wire:poll.120s.visible>
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <span class="text-muted fs-13">Showing</span>
        <div style="min-width:240px"><x-searchable-select wire:model.live="company" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
    </div>

    @php($m = $this->metrics)
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4 col-xxl">
            @if ($company)
                <x-stat-card label="Moved to cash in hand" :value="money($m['money']['moved'])" icon="ri-wallet-3-line" color="success" hint="From this company's banks (cash has no company)" :href="route('accounts.index')" />
            @else
                <x-stat-card label="Admin cash in hand" :value="money($m['money']['cash'])" icon="ri-wallet-3-line" color="success" hint="Physical cash · no company" :href="route('accounts.index')" />
            @endif
        </div>
        <div class="col-sm-6 col-xl-4 col-xxl">
            <x-stat-card label="In banks" :value="money($m['money']['bank'])" icon="ri-bank-line" color="primary" :hint="'Total money '.money($m['money']['total'])" :href="route('accounts.index')" />
        </div>
        <div class="col-sm-6 col-xl-4 col-xxl">
            <x-stat-card label="With agents" :value="money($m['agents'])" icon="ri-user-star-line" color="secondary" :hint="Money::isPositive($m['owedToAgents']) ? 'You owe agents '.money($m['owedToAgents']) : 'Agents owe this back'" :href="route('agents.index')" />
        </div>
        <div class="col-sm-6 col-xl-4 col-xxl">
            <x-stat-card label="Cheques this month" :value="money($m['cheques']['amount'])" icon="ri-bank-card-line" color="warning" :hint="$m['cheques']['count'].' deposited in '.now()->format('F')" :href="route('cheques.index')" />
        </div>
        <div class="col-sm-6 col-xl-4 col-xxl">
            <x-stat-card label="Departments owe you" :value="money($m['deptsOwe'])" icon="ri-government-line" color="danger" :hint="'You hold '.money($m['deptsHeld']).' for others'" :href="route('departments.index')" />
        </div>
        <div class="col-sm-6 col-xl-4 col-xxl">
            <x-stat-card label="Owed to suppliers" :value="money($m['suppliers'])" icon="ri-truck-line" color="info" hint="Goods bought on credit" :href="route('suppliers.index')" />
        </div>
        <div class="col-sm-6 col-xl-4 col-xxl">
            <x-stat-card label="Profit this month" :value="money($m['profit']['net'])" icon="ri-line-chart-line" :color="Money::isNegative($m['profit']['net']) ? 'danger' : 'secondary'"
                :hint="'Deals '.money($m['profit']['deals']).' − costs '.money(Money::add($m['profit']['expenses'], $m['profit']['charges']))" />
        </div>
    </div>
</div>
