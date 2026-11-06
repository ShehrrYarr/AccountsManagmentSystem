<?php

/**
 * Disbursements register (cash payouts, bank transfers, vendor purchases).
 */

use App\Enums\ApprovalStatus;
use App\Enums\DisbursementType;
use App\Enums\RecordStatus;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Disbursement;
use App\Services\DisbursementService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null])->locked();

state([
    'search' => '',
    'type' => '',
    'status' => '',
    'filterCompany' => null,
    'from' => '',
    'to' => '',
    'perPage' => 15,
    'sortField' => 'date',
    'sortDir' => 'desc',
]);

$updated = function ($property) {
    if (in_array($property, ['search', 'type', 'status', 'filterCompany', 'from', 'to', 'perPage'], true)) {
        $this->resetPage('payoutsPage');
    }
};

$sortBy = function (string $field) {
    abort_unless(in_array($field, ['date', 'amount', 'type', 'status'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

$baseQuery = computed(fn () => Disbursement::query()
    ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->type, fn ($q) => $q->where('type', $this->type))
    ->when($this->status, fn ($q) => $q->where('status', $this->status))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, function ($q) {
        $s = '%'.trim($this->search).'%';
        $q->where(fn ($q) => $q->where('reference', 'like', $s)
            ->orWhere('received_by', 'like', $s)
            ->orWhere('item_description', 'like', $s)
            ->orWhereHas('company', fn ($c) => $c->where('name', 'like', $s))
            ->orWhereHas('vendor', fn ($v) => $v->where('name', 'like', $s)));
    }));

$rows = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'sourceAccount', 'vendor', 'creator', 'lines.companyBankAccount',
        'approvalRequests' => fn ($q) => $q->where('status', ApprovalStatus::Pending)])
    ->orderBy($this->sortField, $this->sortDir)->orderByDesc('id')
    ->paginate($this->perPage, pageName: 'payoutsPage'));

$totals = computed(function () {
    $posted = (clone $this->baseQuery)->where('status', RecordStatus::Posted);

    return [
        'total' => Money::of((clone $posted)->sum('amount')),
        'byType' => (clone $posted)->selectRaw('type, SUM(amount) as total')->groupBy('type')->pluck('total', 'type'),
        'pending' => (clone $this->baseQuery)->where('status', RecordStatus::PendingApproval)->count(),
    ];
});

$companyOptions = computed(fn () => Options::companies(false));

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->rows, $this->totals);
}]);

$delete = function (int $id) {
    $d = Disbursement::findOrFail($id);
    $ok = $this->attempt(function () use ($d) {
        $outcome = app(DisbursementService::class)->delete($d, auth()->user());
        $this->toastOutcome($outcome, 'Disbursement deleted and its ledger entries voided.', 'The delete request');
    });
    if ($ok !== false) {
        $this->broadcastChange();
    }
};

$clearFilters = function () {
    $this->fill(['search' => '', 'type' => '', 'status' => '', 'filterCompany' => null, 'from' => '', 'to' => '']);
    $this->resetPage('payoutsPage');
};

?>

<div>
    @unless ($companyId)
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <x-stat-card label="Paid out (filtered)" :value="money($this->totals['total'])" icon="ri-hand-coin-line" color="primary" />
            </div>
            @foreach (DisbursementType::cases() as $t)
                @if ($loop->index < 2)
                    <div class="col-sm-6 col-xl-3">
                        <x-stat-card :label="$t->label().'s'" :value="money($this->totals['byType'][$t->value] ?? 0)" :icon="$t->icon()" color="{{ $loop->first ? 'success' : 'info' }}" />
                    </div>
                @endif
            @endforeach
            <div class="col-sm-6 col-xl-3">
                <x-stat-card label="Purchases / awaiting approval" :value="money($this->totals['byType']['vendor_purchase'] ?? 0)" icon="ri-shopping-bag-3-line" color="warning"
                    :hint="$this->totals['pending'].' payout(s) awaiting approval'" />
            </div>
        </div>
    @endunless

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:220px">
                <input type="search" class="form-control form-control-sm" placeholder="Search company, vendor, reference, receiver…" wire:model.live.debounce.350ms="search">
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="type">
                <option value="">All types</option>
                @foreach (DisbursementType::cases() as $t)
                    <option value="{{ $t->value }}">{{ $t->label() }}</option>
                @endforeach
            </select>
            <select class="form-select form-select-sm w-auto" wire:model.live="status">
                <option value="">All statuses</option>
                @foreach (RecordStatus::cases() as $s)
                    <option value="{{ $s->value }}">{{ $s->label() }}</option>
                @endforeach
            </select>
            @unless ($companyId)
                <div style="min-width:200px">
                    <x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" />
                </div>
            @endunless
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" title="From">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" title="To">
            <button type="button" class="btn btn-sm btn-light" wire:click="clearFilters" title="Reset filters"><i class="ri-refresh-line"></i></button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,type,status,filterCompany,from,to,sortBy,gotoPage,nextPage,previousPage,perPage">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <x-sort-th field="date" :sort="$sortField" :dir="$sortDir">Date</x-sort-th>
                            <x-sort-th field="type" :sort="$sortField" :dir="$sortDir">Type</x-sort-th>
                            @unless ($companyId)<th>Company</th>@endunless
                            <th>Details</th>
                            <th>From</th>
                            <x-sort-th field="amount" :sort="$sortField" :dir="$sortDir" class="money">Amount</x-sort-th>
                            <x-sort-th field="status" :sort="$sortField" :dir="$sortDir">Status</x-sort-th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $d)
                            @php($pendingReq = $d->approvalRequests->first())
                            <tr wire:key="disb-{{ $d->id }}">
                                <td class="fs-13 text-nowrap">{{ $d->date->format('d M Y') }}</td>
                                <td><span class="badge bg-light text-body"><i class="{{ $d->type->icon() }} me-1"></i>{{ $d->type->label() }}</span></td>
                                @unless ($companyId)
                                    <td><a href="{{ route('companies.show', $d->company_id) }}" class="text-body fw-medium">{{ $d->company->name }}</a></td>
                                @endunless
                                <td class="fs-13" style="max-width:280px">
                                    @switch($d->type)
                                        @case(DisbursementType::CashPayout)
                                            {{ $d->received_by ? 'Received by '.$d->received_by : 'Cash handed over' }}
                                            @break
                                        @case(DisbursementType::BankTransfer)
                                            @foreach ($d->lines as $l)
                                                <div class="text-truncate">{{ $l->companyBankAccount->bank_name }} {{ $l->companyBankAccount->account_number }} — {{ money($l->amount) }}</div>
                                            @endforeach
                                            @break
                                        @case(DisbursementType::VendorPurchase)
                                            <div class="fw-medium">{{ $d->vendor?->name }}</div>
                                            <div class="text-muted text-truncate" title="{{ $d->item_description }}">{{ $d->item_description }}</div>
                                            @break
                                    @endswitch
                                    @if ($d->reference)<div class="fs-11 text-muted">Ref: {{ $d->reference }}</div>@endif
                                </td>
                                <td class="fs-13">{{ $d->sourceAccount->name }}</td>
                                <td class="money fw-semibold">{{ money($d->amount) }}</td>
                                <td>
                                    <span class="badge {{ $d->status->badge() }}">{{ $d->status->label() }}</span>
                                    <div class="fs-11 text-muted mt-1">by {{ $d->creator?->name ?? '—' }}</div>
                                    @if ($pendingReq && $pendingReq->action !== \App\Enums\ApprovalAction::PostDisbursement)
                                        <div><span class="badge bg-info-subtle text-info mt-1"><i class="ri-hourglass-line"></i> {{ $pendingReq->action->label() }} pending</span></div>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    @if ($d->receipt_path)
                                        <a class="btn btn-sm btn-light icon-btn-sm" href="{{ route('files.show', ['disbursement', $d->id]) }}" target="_blank" title="Receipt"><i class="ri-attachment-2"></i></a>
                                    @endif
                                    @if ($d->status !== RecordStatus::Rejected && (! $pendingReq || ($pendingReq->action === \App\Enums\ApprovalAction::PostDisbursement && $d->created_by == auth()->id())))
                                        <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('disbursement-edit', { id: {{ $d->id }} })"><i class="ri-edit-line"></i></button>
                                        <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                            x-on:click="amsConfirm('Delete this {{ strtolower($d->type->label()) }} of {{ money($d->amount) }}?', 'Delete').then(ok => ok && $wire.delete({{ $d->id }}))"><i class="ri-delete-bin-line"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="$companyId ? 7 : 8" icon="ri-hand-coin-line" message="No disbursements match these filters." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex flex-wrap align-items-center gap-3">
            <div class="text-muted fs-13 me-auto">Showing {{ $this->rows->firstItem() ?? 0 }}–{{ $this->rows->lastItem() ?? 0 }} of {{ $this->rows->total() }}</div>
            <select class="form-select form-select-sm w-auto" wire:model.live="perPage">
                @foreach ([15, 30, 50, 100] as $n)
                    <option value="{{ $n }}">{{ $n }} / page</option>
                @endforeach
            </select>
            {{ $this->rows->onEachSide(1)->links() }}
        </div>
    </div>
</div>
