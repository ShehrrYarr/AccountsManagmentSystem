<?php

/**
 * Header of a company page: money, cheques this month, what departments / suppliers / other
 * companies owe, profit — plus its accounts and inter-company balances.
 */

use App\Models\Company;
use App\Services\Balances;
use App\Support\Money;

use function Livewire\Volt\{computed, on, state};

state(['companyId' => null])->locked();

$data = computed(function () {
    $company = Company::withTrashed()->with(['accounts' => fn ($q) => $q->orderBy('type')->orderBy('name')])->findOrFail($this->companyId);
    $depts = Balances::departments($company->id);
    $names = Company::withTrashed()->pluck('name', 'id');
    $month = \App\Models\Cheque::where('company_id', $company->id)
        ->whereBetween('date', [now()->startOfMonth()->toDateString(), now()->toDateString()]);

    return [
        'company' => $company,
        'money' => Balances::money($company->id),
        'cheques' => [
            'amount' => Money::of($month->sum('amount')),
            'count' => (clone $month)->count(),
        ],
        'deptsOwe' => Money::add(...$depts->filter(fn ($r) => Money::isPositive($r->balance))->pluck('balance')->all()),
        'deptsHeld' => Money::sub(0, Money::add(...$depts->filter(fn ($r) => Money::isNegative($r->balance))->pluck('balance')->all())),
        'suppliers' => Money::add(...Balances::suppliers($company->id)->pluck('owed')->all()),
        'interCompany' => Balances::interCompany($company->id)->map(fn ($bal, $id) => ['name' => $names[$id] ?? '?', 'balance' => $bal]),
        'agents' => Balances::agents($company->id)->reject(fn ($r) => Money::isZero($r->owed))
            ->map(fn ($r) => ['id' => $r->agent_id, 'name' => \App\Models\User::find($r->agent_id)?->name ?? '?', 'owed' => $r->owed])->values(),
        'profitMonth' => Balances::profit($company->id, now()->startOfMonth(), now()),
        'profitYear' => Balances::profit($company->id, now()->startOfYear(), now()),
    ];
});

on(['transaction-updated' => function () {
    unset($this->data);
}]);

?>

<div>
    @php($d = $this->data)
    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="In banks" :value="money($d['money']['bank'])" icon="ri-bank-line" color="success" :hint="'Moved to cash in hand so far '.money($d['money']['moved'])" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Cheques this month" :value="money($d['cheques']['amount'])" icon="ri-bank-card-line" color="warning" :hint="$d['cheques']['count'].' deposited in '.now()->format('F')" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Departments owe you" :value="money($d['deptsOwe'])" icon="ri-government-line" color="danger" :hint="'You hold '.money($d['deptsHeld']).' of their cheques'" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Profit this month" :value="money($d['profitMonth']['net'])" icon="ri-line-chart-line" :color="Money::isNegative($d['profitMonth']['net']) ? 'danger' : 'primary'" :hint="'This year '.money($d['profitYear']['net'])" />
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-7">
            <div class="card h-100 mb-0">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 me-auto">Bank accounts</h5>
                    <button type="button" class="btn btn-sm btn-light" x-data x-on:click="Livewire.dispatch('account-create', { companyId: {{ $d['company']->id }} })"><i class="ri-add-line me-1"></i>Bank account</button>
                </div>
                <div class="list-group list-group-flush">
                    @foreach ($d['company']->accounts as $a)
                        <a href="{{ route('accounts.show', $a) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3" wire:key="sum-acc-{{ $a->id }}">
                            <i class="{{ $a->type->icon() }} fs-20 text-{{ $a->isCash() ? 'success' : 'primary' }}"></i>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="fw-medium text-truncate">{{ $a->shortLabel() }}</div>
                                <div class="fs-12 text-muted">{{ $a->isCash() ? 'Cash statement' : (trim(($a->account_number ? 'A/c '.$a->account_number : '').' '.($a->branch ? '· '.$a->branch : '')) ?: 'Bank statement') }}</div>
                            </div>
                            <div class="fw-semibold ams-balance text-nowrap">{{ money($a->current_balance) }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Other balances</h5></div>
                <ul class="list-group list-group-flush fs-13">
                    <li class="list-group-item d-flex justify-content-between gap-2 bg-light-subtle">
                        <a href="{{ route('agents.index') }}" class="text-body fw-medium">With agents <span class="text-muted fw-normal">(they owe this company)</span></a>
                        <strong class="text-nowrap">{{ money(Money::add(...$d['agents']->pluck('owed')->all())) }}</strong>
                    </li>
                    @foreach ($d['agents'] as $ag)
                        <li class="list-group-item d-flex justify-content-between gap-2 ps-4" wire:key="sum-ag-{{ $ag['id'] }}">
                            <a href="{{ route('agents.show', $ag['id']) }}" class="text-body">{{ $ag['name'] }}</a>
                            <span class="text-nowrap">{{ money($ag['owed']) }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between gap-2"><span>Owed to suppliers</span><strong class="text-nowrap {{ Money::isPositive($d['suppliers']) ? 'text-warning' : '' }}">{{ money($d['suppliers']) }}</strong></li>
                    @forelse ($d['interCompany'] as $id => $ic)
                        <li class="list-group-item d-flex justify-content-between gap-2" wire:key="ic-{{ $id }}">
                            <a href="{{ route('companies.show', $id) }}" class="text-body">{{ Money::isPositive($ic['balance']) ? $ic['name'].' owes this company' : 'This company owes '.$ic['name'] }}</a>
                            <strong class="text-nowrap {{ Money::isPositive($ic['balance']) ? 'text-success' : 'text-danger' }}">{{ money(Money::isNegative($ic['balance']) ? Money::sub(0, $ic['balance']) : $ic['balance']) }}</strong>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No inter-company balances.</li>
                    @endforelse
                    <li class="list-group-item d-flex justify-content-between gap-2"><span>Deal profit this year</span><strong class="text-nowrap">{{ money($d['profitYear']['deals']) }}</strong></li>
                    <li class="list-group-item d-flex justify-content-between gap-2"><span>Expenses + bank charges this year</span><strong class="text-danger text-nowrap">{{ money(Money::add($d['profitYear']['expenses'], $d['profitYear']['charges'])) }}</strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>
