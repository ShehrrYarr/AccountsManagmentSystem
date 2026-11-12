<?php

/**
 * Government cheque register (every cheque is already deposited): live filters, summary tiles,
 * pagination and row actions. Embeddable on a company or department page via the locked ids.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Cheque;
use App\Services\ChequeService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null, 'departmentId' => null])->locked();

state([
    'search' => '',
    'filterCompany' => null,
    'filterDepartment' => null,
    'from' => '',
    'to' => '',
    'perPage' => 15,
    'sortField' => 'date',
    'sortDir' => 'desc',
]);

$updated = function ($property) {
    if (in_array($property, ['search', 'filterCompany', 'filterDepartment', 'from', 'to', 'perPage'], true)) {
        $this->resetPage('chequesPage');
    }
};

$sortBy = function (string $field) {
    abort_unless(in_array($field, ['cheque_number', 'amount', 'date', 'cheque_date'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

// Filtered query (clone before use — computed values are cached per request).
$baseQuery = computed(fn () => Cheque::query()
    ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->departmentId ?? $this->filterDepartment, fn ($q, $id) => $q->where('department_id', $id))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, function ($q) {
        $s = '%'.trim($this->search).'%';
        $q->where(fn ($q) => $q->where('cheque_number', 'like', $s)
            ->orWhere('issuing_branch', 'like', $s)
            ->orWhere('deposit_reference', 'like', $s)
            ->orWhereHas('company', fn ($c) => $c->where('name', 'like', $s))
            ->orWhereHas('department', fn ($d) => $d->where('name', 'like', $s)));
    }));

$cheques = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'department', 'depositAccount'])
    ->orderBy($this->sortField, $this->sortDir)->orderByDesc('id')
    ->paginate($this->perPage, pageName: 'chequesPage'));

$summary = computed(function () {
    $month = Cheque::query()
        ->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
        ->when($this->departmentId, fn ($q, $id) => $q->where('department_id', $id))
        ->whereBetween('date', [now()->startOfMonth()->toDateString(), now()->toDateString()]);

    return [
        'monthAmount' => Money::of((clone $month)->sum('amount')),
        'monthCount' => (clone $month)->count(),
        'filteredTotal' => Money::of((clone $this->baseQuery)->sum('amount')),
        'filteredCount' => (clone $this->baseQuery)->count(),
        'filteredCharges' => Money::of((clone $this->baseQuery)->sum('bank_charges')),
    ];
});

$companyOptions = computed(fn () => Options::companies());
$departmentOptions = computed(fn () => Options::departments());

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->cheques, $this->summary);
}]);

$delete = function (int $id) {
    $cheque = Cheque::findOrFail($id);
    if ($this->attempt(fn () => app(ChequeService::class)->delete($cheque)) !== false) {
        $this->toast('success', "Cheque #{$cheque->cheque_number} deleted and removed from {$cheque->depositAccount?->shortLabel()}.");
        $this->broadcastChange();
    }
};

$clearFilters = function () {
    $this->fill(['search' => '', 'filterCompany' => null, 'filterDepartment' => null, 'from' => '', 'to' => '']);
    $this->resetPage('chequesPage');
};

?>

<div>
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4">
            <x-stat-card label="Deposited this month" :value="money($this->summary['monthAmount'])" icon="ri-checkbox-circle-line" color="success" :hint="$this->summary['monthCount'].' cheque(s) · '.now()->format('F Y')" />
        </div>
        <div class="col-sm-6 col-xl-4">
            <x-stat-card label="Total of filtered list" :value="money($this->summary['filteredTotal'])" icon="ri-filter-3-line" color="info" :hint="$this->summary['filteredCount'].' cheque(s)'" />
        </div>
        <div class="col-sm-6 col-xl-4">
            <x-stat-card label="Bank charges (filtered)" :value="money($this->summary['filteredCharges'])" icon="ri-bank-line" color="warning" hint="Deducted by banks on deposit" />
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:220px">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-transparent"><i class="ri-search-line text-muted"></i></span>
                    <input type="search" class="form-control" placeholder="Search cheque #, bank, slip, company, department…" aria-label="Search cheques" wire:model.live.debounce.350ms="search">
                </div>
            </div>
            @unless ($companyId)
                <div style="min-width:190px">
                    <x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" />
                </div>
            @endunless
            @unless ($departmentId)
                <div style="min-width:190px">
                    <x-searchable-select wire:model.live="filterDepartment" :options="$this->departmentOptions" placeholder="All departments" size="sm" />
                </div>
            @endunless
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" title="Deposited from" aria-label="Deposited from">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" title="Deposited to" aria-label="Deposited to">
            <button type="button" class="btn btn-sm btn-light" wire:click="clearFilters" title="Reset filters"><i class="ri-refresh-line"></i></button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,filterCompany,filterDepartment,from,to,sortBy,gotoPage,nextPage,previousPage,perPage">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <x-sort-th field="cheque_number" :sort="$sortField" :dir="$sortDir">Cheque #</x-sort-th>
                            <th class="d-none d-md-table-cell">Department → Company</th>
                            <th class="d-none d-lg-table-cell">Deposited into</th>
                            <x-sort-th field="date" :sort="$sortField" :dir="$sortDir" class="d-none d-md-table-cell">Date</x-sort-th>
                            <x-sort-th field="amount" :sort="$sortField" :dir="$sortDir" class="money d-none d-md-table-cell">Amount</x-sort-th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->cheques as $c)
                            <tr wire:key="cheque-{{ $c->id }}">
                                <td>
                                    <div class="fw-semibold">#{{ $c->cheque_number }}</div>
                                    @if ($c->issuing_branch || $c->issuing_bank)
                                        <div class="fs-12 text-muted">{{ $c->issuing_branch ? 'Branch '.$c->issuing_branch : $c->issuing_bank }}</div>
                                    @endif
                                    <div class="fs-11 text-muted">Cheque date {{ $c->cheque_date->format('d M Y') }}</div>
                                    {{-- Phones: the other columns folded into this cell --}}
                                    <div class="d-md-none mt-1 fs-13">
                                        <div class="fw-medium">{{ $c->department->name }}</div>
                                        <div class="text-muted">{{ $c->company->name }} → {{ $c->depositAccount?->shortLabel() }}</div>
                                        <div><span class="fw-semibold">{{ money($c->amount) }}</span> · {{ $c->date->format('d M Y') }}</div>
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="{{ route('departments.show', $c->department_id) }}" class="text-body fw-medium">{{ $c->department->name }}</a>
                                    <div class="fs-12"><a href="{{ route('companies.show', $c->company_id) }}" class="text-muted">{{ $c->company->name }}</a></div>
                                </td>
                                <td class="fs-13 d-none d-lg-table-cell">
                                    {{ $c->depositAccount?->shortLabel() }}
                                    @if ($c->deposit_reference)<div class="fs-12 text-muted">Slip {{ $c->deposit_reference }}</div>@endif
                                </td>
                                <td class="fs-13 d-none d-md-table-cell text-nowrap">{{ $c->date->format('d M Y') }}</td>
                                <td class="money d-none d-md-table-cell">
                                    <span class="fw-semibold">{{ money($c->amount) }}</span>
                                    @if (Money::isPositive($c->bank_charges))<div class="fs-11 text-muted">charges {{ money($c->bank_charges) }}</div>@endif
                                </td>
                                <td class="text-end text-nowrap">
                                    @if ($c->scan_path)
                                        <a class="btn btn-sm btn-light icon-btn-sm" href="{{ route('files.show', ['cheque', $c->id]) }}" target="_blank" title="View scan"><i class="ri-attachment-2"></i></a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('cheque-edit', { id: {{ $c->id }} })"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete cheque #'.$c->cheque_number.'? It will be removed from the bank and the department ledger.'), 'Delete').then(ok => ok && $wire.delete({{ $c->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="6" icon="ri-bank-card-line" message="No cheques match these filters." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex flex-wrap align-items-center gap-3">
            <div class="text-muted fs-13 me-auto">
                Showing {{ $this->cheques->firstItem() ?? 0 }}–{{ $this->cheques->lastItem() ?? 0 }} of {{ $this->cheques->total() }}
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="perPage" aria-label="Rows per page">
                @foreach ([15, 30, 50, 100] as $n)
                    <option value="{{ $n }}">{{ $n }} / page</option>
                @endforeach
            </select>
            {{ $this->cheques->onEachSide(1)->links() }}
        </div>
    </div>
</div>
