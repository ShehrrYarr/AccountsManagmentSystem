<?php

/**
 * Taxes: the names used on bank payments, with how much was paid on each (filter by period and
 * company). Add, rename, turn off; a tax that was never used can be deleted.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Tax;
use App\Services\Balances;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['recordId' => null])->locked();
state(['search' => '', 'filter' => 'active', 'from' => '', 'to' => '', 'companyId' => '']);
state(['name' => '', 'is_active' => true]);

rules(fn () => [
    'name' => ['required', 'string', 'max:255', Rule::unique('taxes', 'name')->ignore($this->recordId)],
    'is_active' => ['boolean'],
]);

$paid = computed(fn () => Balances::taxes($this->companyId ? (int) $this->companyId : null, $this->from ?: null, $this->to ?: null));

$rows = computed(fn () => Tax::query()
    ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
    ->where('is_active', $this->filter !== 'inactive')
    ->orderBy('name')->get());

$total = computed(fn () => Money::add('0', ...$this->paid->pluck('paid')->all()));

$companyOptions = computed(fn () => Options::companies());

on(['transaction-updated' => function () {
    unset($this->paid, $this->total);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->fill(['name' => '', 'is_active' => true]);
    $this->showModal('taxModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $tax = Tax::findOrFail($id);
    $this->recordId = $tax->id;
    $this->fill(['name' => $tax->name, 'is_active' => $tax->is_active]);
    $this->showModal('taxModal');
};

$save = function () {
    $data = $this->validate();
    $data['name'] = trim($data['name']);
    $tax = $this->recordId ? tap(Tax::findOrFail($this->recordId))->update($data) : Tax::create($data);
    $this->toast('success', ($this->recordId ? 'Saved ' : 'Added ').$tax->name.'.');
    $this->hideModal('taxModal');
    unset($this->rows);
};

$toggle = function (int $id) {
    $tax = Tax::findOrFail($id);
    $tax->update(['is_active' => ! $tax->is_active]);
    $this->toast('success', $tax->name.($tax->is_active ? ' turned on.' : ' turned off: it is no longer offered on new payments.'));
    unset($this->rows);
};

// A tax that was paid on any payment is kept (turned off) so the books still name it.
$delete = function (int $id) {
    $tax = Tax::findOrFail($id);
    if ($tax->paymentTaxes()->exists()) {
        $tax->update(['is_active' => false]);
        $this->toast('success', $tax->name.' was used on payments, so it was turned off instead.');
    } else {
        $tax->delete();
        $this->toast('success', $tax->name.' deleted.');
    }
    unset($this->rows);
};

?>

<div>
    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-xl-4">
            <x-stat-card label="Taxes paid{{ $from || $to ? ' in the period' : '' }}" :value="money($this->total)" icon="ri-percent-line" color="danger"
                hint="Paid from banks on top of payments; the company's cost" />
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:180px">
                <input type="search" class="form-control form-control-sm" placeholder="Search taxes…" aria-label="Search taxes" wire:model.live.debounce.350ms="search">
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="companyId" aria-label="Company">
                <option value="">All companies</option>
                @foreach ($this->companyOptions as $c)
                    <option value="{{ $c['value'] }}">{{ $c['label'] }}</option>
                @endforeach
            </select>
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
            <div class="btn-group btn-group-sm" role="group">
                <input type="radio" class="btn-check" id="tax-f-active" value="active" wire:model.live="filter">
                <label class="btn btn-outline-secondary" for="tax-f-active">Active</label>
                <input type="radio" class="btn-check" id="tax-f-inactive" value="inactive" wire:model.live="filter">
                <label class="btn btn-outline-secondary" for="tax-f-inactive">Turned off</label>
            </div>
            <button type="button" class="btn btn-sm btn-primary" wire:click="create"><i class="ri-add-line me-1"></i>Add tax</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Tax</th><th class="d-none d-md-table-cell">Times paid</th><th class="money">Paid</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $tax)
                            @php($p = $this->paid->get($tax->id))
                            <tr wire:key="tax-{{ $tax->id }}">
                                <td>
                                    <a href="{{ route('taxes.show', $tax) }}" class="fw-medium text-body">{{ $tax->name }}</a>
                                    @unless ($tax->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Turned off</span>@endunless
                                </td>
                                <td class="fs-13 d-none d-md-table-cell">{{ $p?->times ?? 0 }}</td>
                                <td class="money fw-semibold">{{ money($p?->paid ?? 0) }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('taxes.show', $tax) }}" class="btn btn-sm btn-light icon-btn-sm" title="Payments"><i class="ri-list-check-2"></i></a>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Rename" wire:click="edit({{ $tax->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="{{ $tax->is_active ? 'Turn off' : 'Turn on' }}" wire:click="toggle({{ $tax->id }})"><i class="{{ $tax->is_active ? 'ri-toggle-fill text-success' : 'ri-toggle-line' }}"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete '.$tax->name.'? If it was used on payments it is turned off instead.'), 'Delete').then(ok => ok && $wire.delete({{ $tax->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="4" icon="ri-percent-line" message="No taxes yet. Add one here, or with + New tax on the Pay Department / Pay Supplier pages." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal id="taxModal" :title="$recordId ? 'Rename Tax' : 'Add Tax'" icon="ri-percent-line" size="sm">
        <form wire:submit="save">
            <div class="modal-body">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="e.g. Withholding tax" maxlength="255">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="tax-active" wire:model="is_active">
                    <label class="form-check-label" for="tax-active">Offered on new payments</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
