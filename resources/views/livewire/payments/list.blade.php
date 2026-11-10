<?php

/**
 * Money spent for departments: cash, bank transfers and goods. Embeddable on company,
 * department and supplier pages through the locked ids.
 */

use App\Enums\PaymentMethod;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null, 'departmentId' => null, 'supplierId' => null])->locked();

state([
    'search' => '',
    'method' => '',
    'filterCompany' => null,
    'filterDepartment' => null,
    'from' => '',
    'to' => '',
    'perPage' => 15,
]);

$updated = function ($property) {
    if ($property !== 'page') {
        $this->resetPage('paymentsPage');
    }
};

$baseQuery = computed(fn () => Payment::query()
    ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->departmentId ?? $this->filterDepartment, fn ($q, $id) => $q->where('department_id', $id))
    ->when($this->supplierId, fn ($q, $id) => $q->where('supplier_id', $id))
    ->when($this->method, fn ($q) => $q->where('method', $this->method))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, function ($q) {
        $s = '%'.trim($this->search).'%';
        $q->where(fn ($q) => $q->where('reference', 'like', $s)
            ->orWhere('item_description', 'like', $s)
            ->orWhere('received_by', 'like', $s)
            ->orWhere('notes', 'like', $s)
            ->orWhereHas('department', fn ($d) => $d->where('name', 'like', $s))
            ->orWhereHas('supplier', fn ($d) => $d->where('name', 'like', $s)));
    }));

$payments = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'department', 'account', 'supplier'])
    ->orderByDesc('date')->orderByDesc('id')
    ->paginate($this->perPage, pageName: 'paymentsPage'));

$totals = computed(fn () => (clone $this->baseQuery)
    ->selectRaw('method, SUM(amount) as total, COUNT(*) as n')->groupBy('method')->get()->keyBy(fn ($r) => $r->method->value));

$companyOptions = computed(fn () => Options::companies());
$departmentOptions = computed(fn () => Options::departments());

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->payments, $this->totals);
}]);

$delete = function (int $id) {
    $payment = Payment::findOrFail($id);
    if ($this->attempt(fn () => app(PaymentService::class)->delete($payment)) !== false) {
        $this->toast('success', 'Payment deleted and its ledger entries voided.');
        $this->broadcastChange();
    }
};

$clearFilters = function () {
    $this->fill(['search' => '', 'method' => '', 'filterCompany' => null, 'filterDepartment' => null, 'from' => '', 'to' => '']);
};

?>

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center">
        <div class="flex-grow-1" style="min-width:200px">
            <input type="search" class="form-control form-control-sm" placeholder="Search reference, items, department…" aria-label="Search payments" wire:model.live.debounce.350ms="search">
        </div>
        <select class="form-select form-select-sm w-auto" wire:model.live="method" aria-label="Method">
            <option value="">All methods</option>
            @foreach (PaymentMethod::cases() as $m)
                <option value="{{ $m->value }}">{{ $m->label() }}</option>
            @endforeach
        </select>
        @unless ($companyId)
            <div style="min-width:180px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
        @endunless
        @unless ($departmentId)
            <div style="min-width:180px"><x-searchable-select wire:model.live="filterDepartment" :options="$this->departmentOptions" placeholder="All departments" size="sm" /></div>
        @endunless
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
        <button type="button" class="btn btn-sm btn-light" wire:click="clearFilters" title="Reset filters"><i class="ri-refresh-line"></i></button>
    </div>

    <div class="px-4 py-2 border-bottom d-flex flex-wrap gap-4 fs-13 bg-body-tertiary">
        @foreach (PaymentMethod::cases() as $m)
            @php($t = $this->totals[$m->value] ?? null)
            <span><span class="text-muted">{{ $m->label() }}:</span> <strong>{{ money($t->total ?? 0) }}</strong> <span class="text-muted">({{ $t->n ?? 0 }})</span></span>
        @endforeach
    </div>

    <div class="card-body p-0">
        <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,method,filterCompany,filterDepartment,from,to,gotoPage,nextPage,previousPage,perPage">
            <table class="table table-hover align-middle mb-0 ams-table">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Details</th>
                        <th class="d-none d-md-table-cell">Method</th>
                        <th class="d-none d-lg-table-cell">From / Supplier</th>
                        <th class="money d-none d-md-table-cell">Amount</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->payments as $p)
                        <tr wire:key="pay-{{ $p->id }}">
                            <td class="fs-13 text-nowrap">{{ $p->date->format('d M Y') }}</td>
                            <td class="fs-13 ams-desc-cell">
                                @unless ($departmentId)
                                    <a href="{{ route('departments.show', $p->department_id) }}" class="fw-medium text-body">{{ $p->department->name }}</a>
                                @endunless
                                @unless ($companyId)<div class="fs-12 text-muted">{{ $p->company->name }}</div>@endunless
                                @if ($p->item_description)<div class="text-truncate ams-wrap-sm" title="{{ $p->item_description }}">{{ $p->item_description }}</div>@endif
                                <div class="fs-12 text-muted">{{ collect([$p->reference ? 'Ref '.$p->reference : null, $p->received_by ? 'received by '.$p->received_by : null])->filter()->implode(' · ') }}</div>
                                <div class="d-md-none mt-1">
                                    <span class="badge {{ $p->method->badge() }}">{{ $p->method->label() }}</span>
                                    @if ($p->on_credit)<span class="badge bg-warning-subtle text-warning">On credit</span>@endif
                                    <div class="fw-semibold">{{ money($p->amount) }}</div>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <span class="badge {{ $p->method->badge() }}"><i class="{{ $p->method->icon() }} me-1"></i>{{ $p->method->label() }}</span>
                                @if ($p->on_credit)<div><span class="badge bg-warning-subtle text-warning mt-1">On credit</span></div>@endif
                            </td>
                            <td class="fs-13 d-none d-lg-table-cell">
                                @if ($p->supplier)<a href="{{ route('suppliers.show', $p->supplier_id) }}" class="text-body">{{ $p->supplier->name }}</a>@endif
                                @if ($p->account)<div class="fs-12 text-muted">{{ $p->account->shortLabel() }}</div>@endif
                            </td>
                            <td class="money fw-semibold d-none d-md-table-cell">{{ money($p->amount) }}</td>
                            <td class="text-end text-nowrap">
                                @if ($p->receipt_path)
                                    <a class="btn btn-sm btn-light icon-btn-sm" href="{{ route('files.show', ['payment', $p->id]) }}" target="_blank" title="Receipt"><i class="ri-attachment-2"></i></a>
                                @endif
                                <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('payment-edit', { id: {{ $p->id }} })"><i class="ri-edit-line"></i></button>
                                <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                    x-on:click="amsConfirm(@js('Delete this '.strtolower($p->method->label()).' of '.money($p->amount).'?'), 'Delete').then(ok => ok && $wire.delete({{ $p->id }}))"><i class="ri-delete-bin-line"></i></button>
                            </td>
                        </tr>
                    @empty
                        <x-empty-row :colspan="6" icon="ri-hand-coin-line" message="No payments match these filters." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex flex-wrap align-items-center gap-3">
        <div class="text-muted fs-13 me-auto">Showing {{ $this->payments->firstItem() ?? 0 }}–{{ $this->payments->lastItem() ?? 0 }} of {{ $this->payments->total() }}</div>
        <select class="form-select form-select-sm w-auto" wire:model.live="perPage" aria-label="Rows per page">
            @foreach ([15, 30, 50, 100] as $n)
                <option value="{{ $n }}">{{ $n }} / page</option>
            @endforeach
        </select>
        {{ $this->payments->onEachSide(1)->links() }}
    </div>
</div>
