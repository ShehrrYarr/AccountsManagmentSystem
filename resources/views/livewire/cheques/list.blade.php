<?php

/**
 * Government cheque register: live filters, summary tiles, pagination and row actions.
 * Refreshes itself whenever any component dispatches 'transaction-updated'.
 */

use App\Enums\ApprovalStatus;
use App\Enums\ChequeStatus;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Cheque;
use App\Services\ChequeService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null])->locked(); // set when embedded on a company page

state([
    'search' => '',
    'status' => 'received',
    'filterCompany' => null,
    'from' => '',
    'to' => '',
    'perPage' => 15,
    'sortField' => 'received_date',
    'sortDir' => 'desc',
])->url(except: '');

$updated = function ($property) {
    if (in_array($property, ['search', 'status', 'filterCompany', 'from', 'to', 'perPage'], true)) {
        $this->resetPage();
    }
};

$sortBy = function (string $field) {
    abort_unless(in_array($field, ['cheque_number', 'amount', 'cheque_date', 'received_date', 'expiry_date', 'status'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

// Filtered query (clone before use — computed values are cached per request).
$baseQuery = computed(function () {
    return Cheque::query()
        ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
        ->when($this->status !== 'all' && $this->status !== '', fn ($q) => $q->where('status', $this->status))
        ->when($this->from, fn ($q) => $q->whereDate('received_date', '>=', $this->from))
        ->when($this->to, fn ($q) => $q->whereDate('received_date', '<=', $this->to))
        ->when($this->search, function ($q) {
            $s = '%'.trim($this->search).'%';
            $q->where(fn ($q) => $q->where('cheque_number', 'like', $s)
                ->orWhere('issuing_bank', 'like', $s)
                ->orWhereHas('company', fn ($c) => $c->where('name', 'like', $s))
                ->orWhereHas('department', fn ($d) => $d->where('name', 'like', $s)));
        });
});

$cheques = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'department', 'clearedInto', 'approvalRequests' => fn ($q) => $q->where('status', ApprovalStatus::Pending)])
    ->orderBy($this->sortField, $this->sortDir)->orderByDesc('id')
    ->paginate($this->perPage));

$summary = computed(function () {
    $pending = Cheque::pending()->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id));

    return [
        'pendingCount' => (clone $pending)->count(),
        'pendingAmount' => Money::of((clone $pending)->sum('amount')),
        'nearExpiry' => (clone $pending)->whereDate('expiry_date', '<=', now()->addDays(Cheque::EXPIRY_WARNING_DAYS))->count(),
        'clearedMonth' => Money::of(Cheque::cleared()->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
            ->whereBetween('cleared_date', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount')),
        'filteredTotal' => Money::of((clone $this->baseQuery)->sum('amount')),
    ];
});

$companyOptions = computed(fn () => Options::companies(false));

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->cheques, $this->summary);
}]);

$delete = function (int $id) {
    $cheque = Cheque::findOrFail($id);
    $ok = $this->attempt(function () use ($cheque) {
        $outcome = app(ChequeService::class)->delete($cheque, auth()->user());
        $this->toastOutcome($outcome, "Cheque #{$cheque->cheque_number} deleted.", 'The delete request');
    });
    if ($ok !== false) {
        $this->broadcastChange();
    }
};

$clearFilters = function () {
    $this->reset(['search', 'filterCompany', 'from', 'to']);
    $this->status = 'all';
    $this->resetPage();
};

?>

<div>
    @unless ($companyId)
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <x-stat-card label="Pending clearing" :value="$this->summary['pendingCount'].' cheques'" icon="ri-time-line" color="warning" :hint="money($this->summary['pendingAmount'])" />
            </div>
            <div class="col-sm-6 col-xl-3">
                <x-stat-card label="Expiring within {{ \App\Models\Cheque::EXPIRY_WARNING_DAYS }} days" :value="$this->summary['nearExpiry']" icon="ri-alarm-warning-line" color="danger" hint="Includes already expired" />
            </div>
            <div class="col-sm-6 col-xl-3">
                <x-stat-card label="Cleared this month" :value="money($this->summary['clearedMonth'])" icon="ri-checkbox-circle-line" color="success" />
            </div>
            <div class="col-sm-6 col-xl-3">
                <x-stat-card label="Total of filtered list" :value="money($this->summary['filteredTotal'])" icon="ri-filter-3-line" color="info" />
            </div>
        </div>
    @endunless

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:220px">
                <div class="position-relative">
                    <input type="search" class="form-control form-control-sm ps-5" placeholder="Search cheque #, bank, company, department…" wire:model.live.debounce.350ms="search">
                    <i class="ri-search-line position-absolute top-50 translate-middle-y ms-3 text-muted" style="left:0"></i>
                </div>
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="status">
                <option value="all">All statuses</option>
                @foreach (ChequeStatus::cases() as $s)
                    <option value="{{ $s->value }}">{{ $s->label() }}</option>
                @endforeach
            </select>
            @unless ($companyId)
                <div style="min-width:200px">
                    <x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" class="form-select-sm" />
                </div>
            @endunless
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" title="Received from">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" title="Received to">
            <button type="button" class="btn btn-sm btn-light" wire:click="clearFilters" title="Reset filters"><i class="ri-refresh-line"></i></button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,status,filterCompany,from,to,sortBy,gotoPage,nextPage,previousPage,perPage">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <x-sort-th field="cheque_number" :sort="$sortField" :dir="$sortDir">Cheque #</x-sort-th>
                            @unless ($companyId)<th>Company</th>@endunless
                            <th>Issued by</th>
                            <x-sort-th field="received_date" :sort="$sortField" :dir="$sortDir">Received</x-sort-th>
                            <x-sort-th field="expiry_date" :sort="$sortField" :dir="$sortDir">Valid until</x-sort-th>
                            <x-sort-th field="amount" :sort="$sortField" :dir="$sortDir" class="money">Amount</x-sort-th>
                            <x-sort-th field="status" :sort="$sortField" :dir="$sortDir">Status</x-sort-th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->cheques as $c)
                            @php($pendingReq = $c->approvalRequests->first())
                            <tr wire:key="cheque-{{ $c->id }}">
                                <td>
                                    <div class="fw-semibold">#{{ $c->cheque_number }}</div>
                                    <div class="fs-12 text-muted">{{ $c->issuing_bank }}{{ $c->issuing_branch ? ' · '.$c->issuing_branch : '' }}</div>
                                </td>
                                @unless ($companyId)
                                    <td><a href="{{ route('companies.show', $c->company_id) }}" class="text-body fw-medium">{{ $c->company->name }}</a></td>
                                @endunless
                                <td class="fs-13">{{ $c->department?->name ?? '—' }}</td>
                                <td class="fs-13">{{ $c->received_date->format('d M Y') }}</td>
                                <td class="fs-13">
                                    @if ($c->isExpired())
                                        <span class="text-danger" title="Expired"><i class="ri-error-warning-fill"></i> {{ $c->expiry_date->format('d M Y') }}</span>
                                    @elseif ($c->isNearExpiry())
                                        <span class="text-warning" title="Expiring soon"><i class="ri-alarm-warning-line"></i> {{ $c->expiry_date->format('d M Y') }}</span>
                                    @else
                                        {{ $c->expiry_date->format('d M Y') }}
                                    @endif
                                </td>
                                <td class="money fw-semibold">{{ money($c->amount) }}</td>
                                <td>
                                    <span class="badge {{ $c->status->badge() }}">{{ $c->status->label() }}</span>
                                    @if ($c->status === ChequeStatus::Cleared)
                                        <div class="fs-11 text-muted mt-1">{{ $c->clearing_method->label() }} → {{ $c->clearedInto?->name }}, {{ $c->cleared_date->format('d M') }}</div>
                                    @elseif (in_array($c->status, [ChequeStatus::Bounced, ChequeStatus::Cancelled]))
                                        <div class="fs-11 text-muted mt-1 text-truncate" style="max-width:180px" title="{{ $c->closed_reason }}">{{ $c->closed_reason }}</div>
                                    @endif
                                    @if ($pendingReq)
                                        <div><span class="badge bg-info-subtle text-info mt-1" title="{{ $pendingReq->summary }}"><i class="ri-hourglass-line"></i> {{ $pendingReq->action->label() }} awaiting approval</span></div>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    @if ($c->status === ChequeStatus::Received && ! $pendingReq)
                                        <button type="button" class="btn btn-sm btn-success" wire:click="$dispatch('cheque-clear', { id: {{ $c->id }} })">
                                            <i class="ri-checkbox-circle-line me-1"></i>Clear
                                        </button>
                                    @endif
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-light icon-btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if ($c->scan_path)
                                                <li><a class="dropdown-item" href="{{ route('files.show', ['cheque', $c->id]) }}" target="_blank"><i class="ri-attachment-2 me-2"></i>View scan</a></li>
                                            @endif
                                            @unless ($pendingReq)
                                                <li><a class="dropdown-item" href="#" wire:click.prevent="$dispatch('cheque-edit', { id: {{ $c->id }} })"><i class="ri-edit-line me-2"></i>Edit</a></li>
                                                @if (in_array($c->status, [ChequeStatus::Received, ChequeStatus::Cleared]))
                                                    <li><a class="dropdown-item text-warning" href="#" wire:click.prevent="$dispatch('cheque-close', { id: {{ $c->id }}, action: 'bounce' })"><i class="ri-arrow-go-back-line me-2"></i>Mark bounced</a></li>
                                                @endif
                                                @if ($c->status === ChequeStatus::Received)
                                                    <li><a class="dropdown-item" href="#" wire:click.prevent="$dispatch('cheque-close', { id: {{ $c->id }}, action: 'cancel' })"><i class="ri-close-circle-line me-2"></i>Cancel cheque</a></li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        x-on:click.prevent="amsConfirm('Delete cheque #{{ $c->cheque_number }}? Its ledger entries will be voided.', 'Delete').then(ok => ok && $wire.delete({{ $c->id }}))">
                                                        <i class="ri-delete-bin-line me-2"></i>Delete
                                                    </a>
                                                </li>
                                            @else
                                                <li><span class="dropdown-item-text fs-12 text-muted">Locked while awaiting approval</span></li>
                                            @endunless
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="$companyId ? 7 : 8" icon="ri-bank-card-line" message="No cheques match these filters." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex flex-wrap align-items-center gap-3">
            <div class="text-muted fs-13 me-auto">
                Showing {{ $this->cheques->firstItem() ?? 0 }}–{{ $this->cheques->lastItem() ?? 0 }} of {{ $this->cheques->total() }}
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="perPage">
                @foreach ([15, 30, 50, 100] as $n)
                    <option value="{{ $n }}">{{ $n }} / page</option>
                @endforeach
            </select>
            {{ $this->cheques->onEachSide(1)->links() }}
        </div>
    </div>
</div>
