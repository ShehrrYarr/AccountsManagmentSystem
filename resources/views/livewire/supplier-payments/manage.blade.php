<?php

/**
 * The list of supplier payments; embeddable on a supplier or company page. Paying and editing
 * happen in the shared form (supplier-payments.create), as a pop-up here or the Pay Supplier page:
 *     $dispatch('supplier-payment-create', { companyId: 1, supplierId: 3 })  (both optional)
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\SupplierPayment;
use App\Services\PaymentService;

use function Livewire\Volt\{computed, mount, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null, 'supplierId' => null])->locked();

// Locked props aren't filled in from the tag on their own; assign them here.
mount(function (?int $companyId = null, ?int $supplierId = null) {
    $this->fill(['companyId' => $companyId, 'supplierId' => $supplierId]);
});
state(['search' => '', 'from' => '', 'to' => '']);

$updated = function ($property) {
    if (in_array($property, ['search', 'from', 'to'], true)) {
        $this->resetPage('spPage');
    }
};

$rows = computed(fn () => SupplierPayment::query()
    ->with(['company', 'supplier', 'account', 'taxes.tax'])
    ->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->supplierId, fn ($q, $id) => $q->where('supplier_id', $id))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('reference', 'like', "%{$this->search}%")
        ->orWhereHas('supplier', fn ($s) => $s->where('name', 'like', "%{$this->search}%"))))
    ->orderByDesc('date')->orderByDesc('id')
    ->paginate(15, pageName: 'spPage'));

on(['transaction-updated' => function () {
    unset($this->rows);
}]);

$delete = function (int $id) {
    $p = SupplierPayment::findOrFail($id);
    if ($this->attempt(fn () => app(PaymentService::class)->delete($p)) !== false) {
        $this->toast('success', 'Supplier payment deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:200px">
                <input type="search" class="form-control form-control-sm" placeholder="Search supplier or reference…" aria-label="Search supplier payments" wire:model.live.debounce.350ms="search">
            </div>
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
            <button type="button" class="btn btn-sm btn-primary" wire:click="$dispatch('supplier-payment-create')"><i class="ri-add-line me-1"></i>Pay supplier</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Supplier</th><th class="d-none d-md-table-cell">Paid from</th><th class="d-none d-md-table-cell">Reference</th><th class="money">Amount</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $p)
                            <tr wire:key="sp-{{ $p->id }}">
                                <td class="fs-13 text-nowrap">{{ $p->date->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('suppliers.show', $p->supplier_id) }}" class="fw-medium text-body">{{ $p->supplier->name }}</a>
                                    @unless ($companyId)<div class="fs-12 text-muted">{{ $p->company?->name ?? 'No company (cash)' }}</div>@endunless
                                </td>
                                <td class="fs-13 d-none d-md-table-cell">{{ $p->account->shortLabel() }}</td>
                                <td class="fs-13 d-none d-md-table-cell">
                                    {{ $p->reference ?: '—' }}
                                    @if ($p->receipt_path)<a href="{{ route('files.show', ['supplier-payment', $p->id]) }}" target="_blank" class="ms-1" title="Receipt"><i class="ri-image-line"></i></a>@endif
                                </td>
                                <td class="money fw-semibold">{{ money($p->amount) }}
                                    @foreach ($p->taxes as $t)<div class="fs-11 text-muted fw-normal">+ {{ $t->tax?->name }} {{ money($t->amount) }}</div>@endforeach
                                </td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('supplier-payment-edit', { id: {{ $p->id }} })"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete the payment of '.money($p->amount).' to '.$p->supplier->name.'?'), 'Delete').then(ok => ok && $wire.delete({{ $p->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="6" icon="ri-store-2-line" message="No supplier payments yet." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->rows->onEachSide(1)->links() }}</div>
    </div>
</div>
