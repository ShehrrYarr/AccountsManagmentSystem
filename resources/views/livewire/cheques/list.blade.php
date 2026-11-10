<?php

/**
 * Government cheque register: live filters, summary tiles, pagination and row actions.
 * Embeddable on a company or department page via the locked companyId / departmentId.
 */

use App\Enums\ChequeStatus;
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
    'status' => 'all',
    'filterCompany' => null,
    'filterDepartment' => null,
    'from' => '',
    'to' => '',
    'perPage' => 15,
    'sortField' => 'received_date',
    'sortDir' => 'desc',
]);

$updated = function ($property) {
    if (in_array($property, ['search', 'status', 'filterCompany', 'filterDepartment', 'from', 'to', 'perPage'], true)) {
        $this->resetPage('chequesPage');
    }
};

$sortBy = function (string $field) {
    abort_unless(in_array($field, ['cheque_number', 'amount', 'received_date', 'expiry_date', 'status'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

// Filtered query (clone before use — computed values are cached per request).
$baseQuery = computed(fn () => Cheque::query()
    ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->departmentId ?? $this->filterDepartment, fn ($q, $id) => $q->where('department_id', $id))
    ->when($this->status !== 'all' && $this->status !== '', fn ($q) => $q->where('status', $this->status))
    ->when($this->from, fn ($q) => $q->whereDate('received_date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('received_date', '<=', $this->to))
    ->when($this->search, function ($q) {
        $s = '%'.trim($this->search).'%';
        $q->where(fn ($q) => $q->where('cheque_number', 'like', $s)
            ->orWhere('issuing_bank', 'like', $s)
            ->orWhereHas('company', fn ($c) => $c->where('name', 'like', $s))
            ->orWhereHas('department', fn ($d) => $d->where('name', 'like', $s)));
    }));

$cheques = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'department', 'depositAccount'])
    ->orderBy($this->sortField, $this->sortDir)->orderByDesc('id')
    ->paginate($this->perPage, pageName: 'chequesPage'));

$summary = computed(function () {
    $scope = fn () => Cheque::query()
        ->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
        ->when($this->departmentId, fn ($q, $id) => $q->where('department_id', $id));
    $inHand = $scope()->inHand();

    return [
        'inHandCount' => (clone $inHand)->count(),
        'inHandAmount' => Money::of((clone $inHand)->sum('amount')),
        'nearExpiry' => (clone $inHand)->whereDate('expiry_date', '<=', now()->addDays(Cheque::EXPIRY_WARNING_DAYS))->count(),
        'depositedMonth' => Money::of($scope()->deposited()->whereBetween('deposited_date', [now()->startOfMonth()->toDateString(), now()->toDateString()])->sum('amount')),
        'filteredTotal' => Money::of((clone $this->baseQuery)->sum('amount')),
    ];
});

$companyOptions = computed(fn () => Options::companies());
$departmentOptions = computed(fn () => Options::departments());

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->cheques, $this->summary);
}]);

$undoDeposit = function (int $id) {
    $cheque = Cheque::findOrFail($id);
    if ($this->attempt(fn () => app(ChequeService::class)->undoDeposit($cheque)) !== false) {
        $this->toast('success', "Cheque #{$cheque->cheque_number} is back in hand.");
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $cheque = Cheque::findOrFail($id);
    if ($this->attempt(fn () => app(ChequeService::class)->delete($cheque)) !== false) {
        $this->toast('success', "Cheque #{$cheque->cheque_number} deleted.");
        $this->broadcastChange();
    }
};

$clearFilters = function () {
    $this->fill(['search' => '', 'status' => 'all', 'filterCompany' => null, 'filterDepartment' => null, 'from' => '', 'to' => '']);
    $this->resetPage('chequesPage');
};

?>

<div>
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Cheques in hand" :value="money($this->summary['inHandAmount'])" icon="ri-time-line" color="warning" :hint="$this->summary['inHandCount'].' not yet deposited'" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Expiring within {{ Cheque::EXPIRY_WARNING_DAYS }} days" :value="$this->summary['nearExpiry']" icon="ri-alarm-warning-line" color="danger" hint="Includes already expired" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Deposited this month" :value="money($this->summary['depositedMonth'])" icon="ri-checkbox-circle-line" color="success" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card label="Total of filtered list" :value="money($this->summary['filteredTotal'])" icon="ri-filter-3-line" color="info" />
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:220px">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-transparent"><i class="ri-search-line text-muted"></i></span>
                    <input type="search" class="form-control" placeholder="Search cheque #, bank, company, department…" aria-label="Search cheques" wire:model.live.debounce.350ms="search">
                </div>
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="status" aria-label="Status">
                <option value="all">All statuses</option>
                @foreach (ChequeStatus::cases() as $s)
                    <option value="{{ $s->value }}">{{ $s->label() }}</option>
                @endforeach
            </select>
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
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" title="Received from" aria-label="Received from">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" title="Received to" aria-label="Received to">
            <button type="button" class="btn btn-sm btn-light" wire:click="clearFilters" title="Reset filters"><i class="ri-refresh-line"></i></button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,status,filterCompany,filterDepartment,from,to,sortBy,gotoPage,nextPage,previousPage,perPage">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <x-sort-th field="cheque_number" :sort="$sortField" :dir="$sortDir">Cheque #</x-sort-th>
                            <th class="d-none d-md-table-cell">Department → Company</th>
                            <x-sort-th field="received_date" :sort="$sortField" :dir="$sortDir" class="d-none d-md-table-cell">Received</x-sort-th>
                            <x-sort-th field="expiry_date" :sort="$sortField" :dir="$sortDir" class="d-none d-lg-table-cell">Valid until</x-sort-th>
                            <x-sort-th field="amount" :sort="$sortField" :dir="$sortDir" class="money d-none d-md-table-cell">Amount</x-sort-th>
                            <x-sort-th field="status" :sort="$sortField" :dir="$sortDir" class="d-none d-md-table-cell">Status</x-sort-th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->cheques as $c)
                            <tr wire:key="cheque-{{ $c->id }}">
                                <td>
                                    <div class="fw-semibold">#{{ $c->cheque_number }}</div>
                                    <div class="fs-12 text-muted">{{ $c->issuing_bank }}{{ $c->issuing_branch ? ' · '.$c->issuing_branch : '' }}</div>
                                    {{-- Phones: the other columns folded into this cell --}}
                                    <div class="d-md-none mt-1 fs-13">
                                        <div class="fw-medium">{{ $c->department->name }}</div>
                                        <div class="text-muted">{{ $c->company->name }}</div>
                                        <div class="fw-semibold">{{ money($c->amount) }}</div>
                                        <span class="badge {{ $c->status->badge() }}">{{ $c->status->label() }}</span>
                                        @if ($c->isExpired())<span class="badge bg-danger-subtle text-danger">Expired</span>@endif
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="{{ route('departments.show', $c->department_id) }}" class="text-body fw-medium">{{ $c->department->name }}</a>
                                    <div class="fs-12"><a href="{{ route('companies.show', $c->company_id) }}" class="text-muted">{{ $c->company->name }}</a></div>
                                </td>
                                <td class="fs-13 d-none d-md-table-cell text-nowrap">{{ $c->received_date->format('d M Y') }}</td>
                                <td class="fs-13 d-none d-lg-table-cell text-nowrap">
                                    @if ($c->isExpired())
                                        <span class="text-danger" title="Expired"><i class="ri-error-warning-fill"></i> {{ $c->expiry_date->format('d M Y') }}</span>
                                    @elseif ($c->isNearExpiry())
                                        <span class="text-warning" title="Expiring soon"><i class="ri-alarm-warning-line"></i> {{ $c->expiry_date->format('d M Y') }}</span>
                                    @else
                                        {{ $c->expiry_date->format('d M Y') }}
                                    @endif
                                </td>
                                <td class="money fw-semibold d-none d-md-table-cell">{{ money($c->amount) }}</td>
                                <td class="d-none d-md-table-cell">
                                    <span class="badge {{ $c->status->badge() }}">{{ $c->status->label() }}</span>
                                    @if ($c->isDeposited())
                                        <div class="fs-11 text-muted mt-1">→ {{ $c->depositAccount?->shortLabel() }}, {{ $c->deposited_date->format('d M') }}
                                            @if (Money::isPositive($c->bank_charges))<br>charges {{ money($c->bank_charges) }}@endif
                                        </div>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    @unless ($c->isDeposited())
                                        <button type="button" class="btn btn-sm btn-success" wire:click="$dispatch('cheque-deposit', { id: {{ $c->id }} })">
                                            <i class="ri-bank-line me-1"></i>Deposit
                                        </button>
                                    @endunless
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-light icon-btn-sm" data-bs-toggle="dropdown" aria-expanded="false" aria-label="More actions"><i class="ri-more-2-fill"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if ($c->scan_path)
                                                <li><a class="dropdown-item" href="{{ route('files.show', ['cheque', $c->id]) }}" target="_blank"><i class="ri-attachment-2 me-2"></i>View scan</a></li>
                                            @endif
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="$dispatch('cheque-edit', { id: {{ $c->id }} })"><i class="ri-edit-line me-2"></i>Edit cheque</a></li>
                                            @if ($c->isDeposited())
                                                <li><a class="dropdown-item" href="#" wire:click.prevent="$dispatch('cheque-deposit', { id: {{ $c->id }} })"><i class="ri-bank-line me-2"></i>Edit deposit</a></li>
                                                <li>
                                                    <a class="dropdown-item text-warning" href="#"
                                                        x-on:click.prevent="amsConfirm(@js('Put cheque #'.$c->cheque_number.' back in hand? The deposit will be removed from '.$c->depositAccount?->shortLabel().'.'), 'Undo deposit').then(ok => ok && $wire.undoDeposit({{ $c->id }}))">
                                                        <i class="ri-arrow-go-back-line me-2"></i>Undo deposit
                                                    </a>
                                                </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                    x-on:click.prevent="amsConfirm(@js('Delete cheque #'.$c->cheque_number.'? Its ledger entries will be voided.'), 'Delete').then(ok => ok && $wire.delete({{ $c->id }}))">
                                                    <i class="ri-delete-bin-line me-2"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="7" icon="ri-bank-card-line" message="No cheques match these filters." />
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
