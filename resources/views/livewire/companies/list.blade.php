<?php

/**
 * Companies (clients): list with live balances + create / edit modal.
 * Opening balances can only be set or changed by administrators.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Company;
use App\Services\MasterDataService;
use App\Support\Money;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['search' => '', 'filter' => 'active', 'sortField' => 'name', 'sortDir' => 'asc'])->url(except: '');
state(['companyId' => null])->locked();
state([
    'name' => '', 'registration_no' => '', 'ntn' => '', 'contact_person' => '', 'phone' => '', 'email' => '',
    'address' => '', 'opening_payable' => '0', 'opening_receivable' => '0', 'notes' => '', 'is_active' => true,
]);

rules(fn () => [
    'name' => ['required', 'string', 'max:255', Rule::unique('companies', 'name')->ignore($this->companyId)],
    'registration_no' => ['nullable', 'string', 'max:100'],
    'ntn' => ['nullable', 'string', 'max:50'],
    'contact_person' => ['nullable', 'string', 'max:255'],
    'phone' => ['nullable', 'string', 'max:30'],
    'email' => ['nullable', 'email', 'max:255'],
    'address' => ['nullable', 'string', 'max:1000'],
    'opening_payable' => ['nullable', 'numeric', 'min:0'],
    'opening_receivable' => ['nullable', 'numeric', 'min:0'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'is_active' => ['boolean'],
]);

$updatedSearch = fn () => $this->resetPage();
$updatedFilter = fn () => $this->resetPage();

$sortBy = function (string $field) {
    abort_unless(in_array($field, ['name', 'payable_balance', 'receivable_balance', 'created_at'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

$companies = computed(fn () => Company::query()
    ->withCount(['cheques as pending_cheques_count' => fn ($q) => $q->pending()])
    ->withSum(['cheques as pending_cheques_sum' => fn ($q) => $q->pending()], 'amount')
    ->when($this->filter === 'active', fn ($q) => $q->where('is_active', true))
    ->when($this->filter === 'inactive', fn ($q) => $q->where('is_active', false))
    ->when($this->filter === 'owed', fn ($q) => $q->where('payable_balance', '>', 0))
    ->when($this->filter === 'owing', fn ($q) => $q->where('receivable_balance', '>', 0))
    ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', "%{$this->search}%")
        ->orWhere('contact_person', 'like', "%{$this->search}%")
        ->orWhere('ntn', 'like', "%{$this->search}%")
        ->orWhere('phone', 'like', "%{$this->search}%")))
    ->orderBy($this->sortField, $this->sortDir)
    ->paginate(20));

$totals = computed(fn () => [
    'payable' => Money::of(Company::sum('payable_balance')),
    'receivable' => Money::of(Company::sum('receivable_balance')),
]);

on(['transaction-updated' => function () {
    unset($this->companies, $this->totals);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->reset(['name', 'registration_no', 'ntn', 'contact_person', 'phone', 'email', 'address', 'opening_payable', 'opening_receivable', 'notes', 'is_active']);
    $this->companyId = null;
    $this->showModal('companyModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $c = Company::findOrFail($id);
    $this->companyId = $c->id;
    $this->fill($c->only(['name', 'registration_no', 'ntn', 'contact_person', 'phone', 'email', 'address', 'opening_payable', 'opening_receivable', 'notes', 'is_active']));
    $this->showModal('companyModal');
};

$save = function () {
    $data = $this->validate();
    $company = $this->companyId ? Company::findOrFail($this->companyId) : null;

    // Opening balances affect the ledger: staff cannot set or change them.
    if (! auth()->user()->isAdmin()) {
        $data['opening_payable'] = $company?->opening_payable ?? 0;
        $data['opening_receivable'] = $company?->opening_receivable ?? 0;
    }

    $ok = $this->attempt(function () use ($company, $data) {
        $saved = app(MasterDataService::class)->saveCompany($company, $data);
        $this->toast('success', "{$saved->name} saved.");
    });

    if ($ok !== false) {
        $this->hideModal('companyModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    abort_unless(auth()->user()->isAdmin(), 403);
    $ok = $this->attempt(fn () => app(MasterDataService::class)->deleteCompany(Company::findOrFail($id)));
    if ($ok !== false) {
        $this->toast('success', 'Company deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <x-stat-card label="Total payable to companies" :value="money($this->totals['payable'])" icon="ri-arrow-right-up-line" color="success" hint="Cleared cheque money you still hold for clients" />
        </div>
        <div class="col-md-6">
            <x-stat-card label="Total receivable from companies" :value="money($this->totals['receivable'])" icon="ri-arrow-left-down-line" color="danger" hint="Money companies owe you" />
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <input type="search" class="form-control form-control-sm flex-grow-1" style="max-width:320px" placeholder="Search name, contact, NTN, phone…" wire:model.live.debounce.350ms="search">
            <div class="btn-group btn-group-sm" role="group">
                @foreach (['active' => 'Active', 'owed' => 'I owe them', 'owing' => 'They owe me', 'inactive' => 'Inactive', 'all' => 'All'] as $key => $label)
                    <button type="button" class="btn {{ $filter === $key ? 'btn-primary' : 'btn-light' }}" wire:click="$set('filter', '{{ $key }}')">{{ $label }}</button>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-primary ms-auto" wire:click="create"><i class="ri-add-line me-1"></i>New Company</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,filter,sortBy,gotoPage,nextPage,previousPage">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <x-sort-th field="name" :sort="$sortField" :dir="$sortDir">Company</x-sort-th>
                            <th>Contact</th>
                            <th class="money">Cheques pending</th>
                            <x-sort-th field="payable_balance" :sort="$sortField" :dir="$sortDir" class="money">Payable (I owe)</x-sort-th>
                            <x-sort-th field="receivable_balance" :sort="$sortField" :dir="$sortDir" class="money">Receivable (they owe)</x-sort-th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->companies as $c)
                            <tr wire:key="co-{{ $c->id }}">
                                <td>
                                    <a href="{{ route('companies.show', $c) }}" class="fw-semibold text-body">{{ $c->name }}</a>
                                    @unless ($c->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                                    <div class="fs-12 text-muted">{{ collect([$c->registration_no, $c->ntn ? 'NTN '.$c->ntn : null])->filter()->implode(' · ') ?: '—' }}</div>
                                </td>
                                <td class="fs-13">
                                    {{ $c->contact_person ?? '—' }}
                                    @if ($c->phone)<div class="fs-12 text-muted">{{ $c->phone }}</div>@endif
                                </td>
                                <td class="money fs-13">
                                    @if ($c->pending_cheques_count)
                                        {{ money($c->pending_cheques_sum) }} <div class="fs-11 text-muted">{{ $c->pending_cheques_count }} cheque(s)</div>
                                    @else <span class="text-muted">—</span> @endif
                                </td>
                                <td class="money fw-semibold {{ Money::isPositive($c->payable_balance) ? 'text-success' : 'text-muted' }}">{{ money($c->payable_balance) }}</td>
                                <td class="money fw-semibold {{ Money::isPositive($c->receivable_balance) ? 'text-danger' : 'text-muted' }}">{{ money($c->receivable_balance) }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('companies.show', $c) }}" class="btn btn-sm btn-light icon-btn-sm" title="Statement"><i class="ri-file-list-3-line"></i></a>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="$dispatch('company-accounts', { companyId: {{ $c->id }} })" title="Bank accounts"><i class="ri-bank-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $c->id }})" title="Edit"><i class="ri-edit-line"></i></button>
                                    @can('admin')
                                        <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                            x-on:click="amsConfirm(@js('Delete '.$c->name.'? Only possible when it has no cheques or payments.'), 'Delete').then(ok => ok && $wire.delete({{ $c->id }}))"><i class="ri-delete-bin-line"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="6" icon="ri-building-2-line" message="No companies found." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->companies->links() }}</div>
    </div>

    <x-modal id="companyModal" :title="$companyId ? 'Edit Company' : 'New Company'" icon="ri-building-2-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Company name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Registration #</label>
                        <input type="text" class="form-control" wire:model="registration_no">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">NTN</label>
                        <input type="text" class="form-control" wire:model="ntn">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Contact person</label>
                        <input type="text" class="form-control" wire:model="contact_person">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" wire:model="phone">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" wire:model="address">
                    </div>

                    <div class="col-12"><hr class="my-1"><h6 class="mb-0">Opening balances <span class="text-muted fw-normal fs-12">— carried over from before this system</span></h6></div>
                    <div class="col-md-6">
                        <label class="form-label">I owe this company (payable)</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('opening_payable') is-invalid @enderror" wire:model="opening_payable" @disabled(! auth()->user()->isAdmin())>
                            @error('opening_payable') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">This company owes me (receivable)</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('opening_receivable') is-invalid @enderror" wire:model="opening_receivable" @disabled(! auth()->user()->isAdmin())>
                            @error('opening_receivable') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    @unless (auth()->user()->isAdmin())
                        <div class="col-12"><div class="form-text">Only administrators can set opening balances.</div></div>
                    @endunless

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="co-active" wire:model="is_active">
                            <label class="form-check-label" for="co-active">Active (shown in dropdowns)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Save company</button>
            </div>
        </form>
    </x-modal>
</div>
