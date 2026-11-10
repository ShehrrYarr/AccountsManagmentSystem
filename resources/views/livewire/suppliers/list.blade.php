<?php

/**
 * Suppliers: what my companies owe each one, plus create / edit.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Supplier;
use App\Services\Balances;
use App\Support\Money;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['recordId' => null])->locked();
state(['search' => '', 'filter' => 'active']);
state(['name' => '', 'contact_person' => '', 'phone' => '', 'ntn' => '', 'address' => '', 'is_active' => true]);

rules(fn () => [
    'name' => ['required', 'string', 'max:255', Rule::unique('suppliers', 'name')->ignore($this->recordId)],
    'contact_person' => ['nullable', 'string', 'max:255'],
    'phone' => ['nullable', 'string', 'max:30'],
    'ntn' => ['nullable', 'string', 'max:50'],
    'address' => ['nullable', 'string', 'max:1000'],
    'is_active' => ['boolean'],
]);

$rows = computed(function () {
    $balances = Balances::suppliers()->groupBy('supplier_id');

    return Supplier::query()
        ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', "%{$this->search}%")
            ->orWhere('contact_person', 'like', "%{$this->search}%")->orWhere('phone', 'like', "%{$this->search}%")))
        ->where('is_active', $this->filter !== 'inactive')
        ->orderBy('name')->get()
        ->map(function (Supplier $s) use ($balances) {
            $b = $balances->get($s->id, collect());

            return (object) [
                'supplier' => $s,
                'purchased' => Money::add(...$b->pluck('purchased')->all()),
                'paid' => Money::add(...$b->pluck('paid')->all()),
                'owed' => Money::add(...$b->pluck('owed')->all()),
            ];
        })
        ->when($this->filter === 'owed', fn ($c) => $c->filter(fn ($r) => Money::isPositive($r->owed)))
        ->values();
});

on(['transaction-updated' => function () {
    unset($this->rows);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->fill(['name' => '', 'contact_person' => '', 'phone' => '', 'ntn' => '', 'address' => '', 'is_active' => true]);
    $this->showModal('supplierModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $s = Supplier::findOrFail($id);
    $this->recordId = $s->id;
    $this->fill($s->only(['name', 'contact_person', 'phone', 'ntn', 'address', 'is_active']));
    $this->showModal('supplierModal');
};

$save = function () {
    $data = $this->validate();
    $s = $this->recordId ? tap(Supplier::findOrFail($this->recordId))->update($data) : Supplier::create($data);
    $this->toast('success', "{$s->name} saved.");
    $this->hideModal('supplierModal');
    unset($this->rows);
};

$delete = function (int $id) {
    $s = Supplier::findOrFail($id);
    if ($s->ledgerEntries()->exists() || $s->payments()->withTrashed()->exists() || $s->supplierPayments()->withTrashed()->exists()) {
        $s->update(['is_active' => false]);
        $this->toast('info', "{$s->name} has history, so it was deactivated instead of deleted.");
    } else {
        $s->delete();
        $this->toast('success', 'Supplier deleted.');
    }
    unset($this->rows);
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <input type="search" class="form-control form-control-sm" style="max-width:280px" placeholder="Search name, contact, phone…" aria-label="Search suppliers" wire:model.live.debounce.350ms="search">
            <div class="btn-group btn-group-sm" role="group">
                @foreach (['active' => 'Active', 'owed' => 'I owe them', 'inactive' => 'Inactive'] as $key => $label)
                    <button type="button" class="btn {{ $filter === $key ? 'btn-primary' : 'btn-light' }}" wire:click="$set('filter', '{{ $key }}')">{{ $label }}</button>
                @endforeach
            </div>
            <div class="ms-auto d-flex gap-2">
                <button type="button" class="btn btn-sm btn-success" x-data x-on:click="Livewire.dispatch('supplier-payment-create')"><i class="ri-money-dollar-circle-line me-1"></i>Pay supplier</button>
                <button type="button" class="btn btn-sm btn-primary" wire:click="create"><i class="ri-add-line me-1"></i>New supplier</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Supplier</th><th class="money d-none d-md-table-cell">Purchased</th><th class="money d-none d-md-table-cell">Paid</th><th class="money">You owe</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $r)
                            <tr wire:key="sup-{{ $r->supplier->id }}">
                                <td>
                                    <a href="{{ route('suppliers.show', $r->supplier) }}" class="fw-semibold text-body">{{ $r->supplier->name }}</a>
                                    <div class="fs-12 text-muted">{{ collect([$r->supplier->contact_person, $r->supplier->phone])->filter()->implode(' · ') }}</div>
                                </td>
                                <td class="money d-none d-md-table-cell">{{ money($r->purchased) }}</td>
                                <td class="money d-none d-md-table-cell">{{ money($r->paid) }}</td>
                                <td class="money fw-semibold {{ Money::isPositive($r->owed) ? 'text-warning' : 'text-muted' }}">{{ money($r->owed) }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('suppliers.show', $r->supplier) }}" class="btn btn-sm btn-light" title="Open ledger"><i class="ri-book-open-line"></i><span class="d-none d-xl-inline ms-1">Ledger</span></a>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $r->supplier->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete '.$r->supplier->name.'?'), 'Delete').then(ok => ok && $wire.delete({{ $r->supplier->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="5" icon="ri-truck-line" message="No suppliers here." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal id="supplierModal" :title="$recordId ? 'Edit Supplier' : 'New Supplier'" icon="ri-truck-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Supplier name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6"><label class="form-label">Contact person</label><input type="text" class="form-control" wire:model="contact_person"></div>
                    <div class="col-sm-6"><label class="form-label">Phone</label><input type="text" class="form-control" wire:model="phone"></div>
                    <div class="col-sm-6"><label class="form-label">NTN</label><input type="text" class="form-control" wire:model="ntn"></div>
                    <div class="col-12"><label class="form-label">Address</label><input type="text" class="form-control" wire:model="address"></div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="sup-active" wire:model="is_active">
                            <label class="form-check-label" for="sup-active">Active (shown in dropdowns)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
