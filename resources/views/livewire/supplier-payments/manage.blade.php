<?php

/**
 * Paying suppliers for goods bought on credit. List + modal; embeddable on a supplier or company page.
 * Paid from a company bank (it pays that company's debt) or the cash in hand (no company).
 *
 * Open the form with: $dispatch('supplier-payment-create', { companyId: 1, supplierId: 3 })  (both optional)
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\SupplierPayment;
use App\Services\Balances;
use App\Services\PaymentService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, mount, on, rules, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null, 'supplierId' => null, 'recordId' => null, 'modalOnly' => false])->locked();

// Locked props aren't filled in from the tag on their own; assign them here.
mount(function (?int $companyId = null, ?int $supplierId = null, bool $modalOnly = false) {
    $this->fill(['companyId' => $companyId, 'supplierId' => $supplierId, 'modalOnly' => $modalOnly]);
});
state(['search' => '', 'from' => '', 'to' => '']);
state(['company_id' => null, 'supplier_id' => null, 'account_id' => null, 'amount' => '', 'date' => '', 'reference' => '', 'notes' => '']);

rules(fn () => [
    'supplier_id' => ['required', 'exists:suppliers,id'],
    'account_id' => ['required', 'exists:accounts,id'],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'reference' => ['nullable', 'string', 'max:255'],
    'notes' => ['nullable', 'string', 'max:2000'],
])->messages(['account_id.required' => 'Choose the account paid from.']);

$updated = function ($property) {
    if (in_array($property, ['search', 'from', 'to'], true)) {
        $this->resetPage('spPage');
    }
};

$rows = computed(fn () => SupplierPayment::query()
    ->with(['company', 'supplier', 'account'])
    ->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->supplierId, fn ($q, $id) => $q->where('supplier_id', $id))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('reference', 'like', "%{$this->search}%")
        ->orWhereHas('supplier', fn ($s) => $s->where('name', 'like', "%{$this->search}%"))))
    ->orderByDesc('date')->orderByDesc('id')
    ->paginate(15, pageName: 'spPage'));

$companyOptions = computed(fn () => Options::companies($this->company_id));
$supplierOptions = computed(fn () => Options::suppliers($this->supplier_id));
$accountOptions = computed(fn () => Options::accounts($this->companyId, null, $this->account_id));
$paidFrom = computed(fn () => $this->account_id ? Account::with('company')->find($this->account_id) : null);

// What the bank's company owes the supplier (cash: what is owed in total), before this payment.
$owed = computed(function () {
    if (! $this->paidFrom || ! $this->supplier_id) {
        return null;
    }
    $company = $this->paidFrom->company_id;
    $owed = Balances::supplierOwed((int) $this->supplier_id, $company);
    if ($this->recordId && ($old = SupplierPayment::find($this->recordId)) && ($company === null || $old->company_id == $company) && $old->supplier_id == $this->supplier_id) {
        $owed = Money::add($owed, $old->amount);
    }

    return $owed;
});

on(['transaction-updated' => function () {
    unset($this->rows, $this->owed, $this->accountOptions, $this->paidFrom);
}]);

on(['supplier-payment-create' => function (?int $companyId = null, ?int $supplierId = null) {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->fill(['company_id' => $companyId ?? $this->companyId, 'supplier_id' => $supplierId ?? $this->supplierId, 'account_id' => null,
        'amount' => '', 'date' => now()->toDateString(), 'reference' => '', 'notes' => '']);
    $this->showModal('supplierPaymentModal');
}]);

$edit = function (int $id) {
    $this->resetErrorBag();
    $p = SupplierPayment::findOrFail($id);
    $this->recordId = $p->id;
    $this->fill(['company_id' => $p->company_id, 'supplier_id' => $p->supplier_id, 'account_id' => $p->account_id, 'amount' => $p->amount,
        'date' => $p->date->toDateString(), 'reference' => $p->reference ?? '', 'notes' => $p->notes ?? '']);
    $this->showModal('supplierPaymentModal');
};

$payAll = function () {
    if ($this->owed && Money::isPositive($this->owed)) {
        $this->amount = $this->owed;
    }
};

$save = function () {
    $data = $this->validate();
    $ok = $this->attempt(function () use ($data) {
        $p = app(PaymentService::class)->saveSupplierPayment($this->recordId ? SupplierPayment::findOrFail($this->recordId) : null, $data);
        $this->toast('success', 'Paid '.money($p->amount).' to '.$p->supplier->name.'.');
    });
    if ($ok !== false) {
        $this->hideModal('supplierPaymentModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $p = SupplierPayment::findOrFail($id);
    if ($this->attempt(fn () => app(PaymentService::class)->delete($p)) !== false) {
        $this->toast('success', 'Supplier payment deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    @unless ($modalOnly)
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
                                <td class="fs-13 d-none d-md-table-cell">{{ $p->reference ?: '—' }}</td>
                                <td class="money fw-semibold">{{ money($p->amount) }}</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $p->id }})"><i class="ri-edit-line"></i></button>
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
    @endunless

    <x-modal id="supplierPaymentModal" :title="$recordId ? 'Edit Supplier Payment' : 'Pay a Supplier'" icon="ri-store-2-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Paid from <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="account_id" :options="$this->accountOptions" placeholder="Cash in hand or a company bank" :invalid="$errors->has('account_id')" />
                        @error('account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @if ($this->paidFrom)
                            <div class="form-text">{!! $this->paidFrom->isAdminCash() ? '<i class="ri-wallet-3-line"></i> Cash in hand belongs to no company: this is not counted for any company.' : '<i class="ri-building-2-line"></i> Counts for <strong>'.e($this->paidFrom->company?->name).'</strong>.' !!}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label">Supplier <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="supplier_id" :options="$this->supplierOptions" placeholder="Select supplier" :invalid="$errors->has('supplier_id')" />
                        @error('supplier_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @if ($this->owed !== null)
                            <div class="form-text ams-balance">
                                {{ $this->paidFrom?->company_id ? 'Owed by '.$this->paidFrom->company?->name : 'Owed in total' }}: <strong>{{ money($this->owed) }}</strong>
                                @if (Money::isPositive($this->owed)) · <a href="#" wire:click.prevent="payAll">pay it all</a>@endif
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model="amount" placeholder="0.00">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Reference</label>
                        <input type="text" class="form-control" wire:model="reference" placeholder="Cheque no. / transfer ID / receipt">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
