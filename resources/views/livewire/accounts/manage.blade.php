<?php

/**
 * Cash & bank accounts of all my companies (or one company), with balances and statements.
 * Bank accounts can be added / edited here; each company's cash in hand is created with the company.
 *
 * Open the form with: $dispatch('account-create', { companyId: 1 })  or  $dispatch('account-edit', { id: 3 })
 */

use App\Enums\AccountType;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Company;
use App\Services\MasterDataService;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['companyId' => null, 'accountId' => null, 'modalOnly' => false])->locked();
state(['showInactive' => false]);
state([
    'company_id' => null, 'type' => 'bank', 'name' => '', 'bank_name' => '', 'branch' => '', 'account_title' => '',
    'account_number' => '', 'iban' => '', 'opening_balance' => '0', 'opening_date' => '', 'is_active' => true,
]);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'name' => ['required', 'string', 'max:255', Rule::unique('accounts', 'name')->where('company_id', $this->company_id)->whereNull('deleted_at')->ignore($this->accountId)],
    'bank_name' => [$this->type === 'bank' ? 'required' : 'nullable', 'string', 'max:255'],
    'branch' => ['nullable', 'string', 'max:255'],
    'account_title' => ['nullable', 'string', 'max:255'],
    'account_number' => ['nullable', 'string', 'max:50'],
    'iban' => ['nullable', 'string', 'max:34'],
    'opening_balance' => ['nullable', 'numeric', 'min:0'],
    'opening_date' => ['required', 'date'],
    'is_active' => ['boolean'],
])->messages(['name.unique' => 'This company already has an account with that name.']);

$groups = computed(fn () => $this->modalOnly ? collect() : Company::query()
    ->when($this->companyId, fn ($q, $id) => $q->whereKey($id))
    ->when(! $this->companyId, fn ($q) => $q->where('is_active', true))
    ->with(['accounts' => fn ($q) => $q->when(! $this->showInactive, fn ($q) => $q->where('is_active', true))->orderBy('type')->orderBy('name')])
    ->orderBy('name')->get());

$companyOptions = computed(fn () => Options::companies($this->company_id));

on(['transaction-updated' => function () {
    unset($this->groups);
}]);

on(['account-create' => function (?int $companyId = null) {
    $this->resetErrorBag();
    $this->accountId = null;
    $this->fill(['company_id' => $companyId ?? $this->companyId, 'type' => 'bank', 'name' => '', 'bank_name' => '', 'branch' => '',
        'account_title' => '', 'account_number' => '', 'iban' => '', 'opening_balance' => '0', 'opening_date' => now()->toDateString(), 'is_active' => true]);
    $this->showModal('accountModal');
}]);

on(['account-edit' => function (int $id) {
    $this->resetErrorBag();
    $a = Account::findOrFail($id);
    $this->accountId = $a->id;
    $this->fill($a->only(['company_id', 'name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban', 'opening_balance', 'is_active'])
        + ['type' => $a->type->value, 'opening_date' => $a->opening_date?->toDateString() ?? $a->created_at->toDateString()]);
    $this->showModal('accountModal');
}]);

$save = function () {
    $data = $this->validate() + ['type' => $this->type];
    $ok = $this->attempt(function () use ($data) {
        $a = app(MasterDataService::class)->saveAccount($this->accountId ? Account::findOrFail($this->accountId) : null, $data);
        $this->toast('success', $a->label().' saved.');
    });
    if ($ok !== false) {
        $this->hideModal('accountModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    if ($this->attempt(fn () => app(MasterDataService::class)->deleteAccount(Account::findOrFail($id))) !== false) {
        $this->toast('success', 'Account deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    @unless ($modalOnly)
    @unless ($companyId)
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <div class="form-check form-switch mb-0 me-auto">
                <input class="form-check-input" type="checkbox" id="acc-inactive" wire:model.live="showInactive">
                <label class="form-check-label fs-13" for="acc-inactive">Show inactive accounts</label>
            </div>
            <button type="button" class="btn btn-sm btn-primary" wire:click="$dispatch('account-create')"><i class="ri-add-line me-1"></i>New bank account</button>
        </div>
    @endunless

    @forelse ($this->groups as $company)
        <div class="card" wire:key="accgrp-{{ $company->id }}">
            <div class="card-header d-flex align-items-center gap-2">
                <h5 class="card-title mb-0 me-auto"><a href="{{ route('companies.show', $company) }}" class="text-body">{{ $company->name }}</a></h5>
                <span class="fs-13 text-muted">Total <strong class="text-body ams-balance">{{ money($company->accounts->sum('current_balance')) }}</strong></span>
                <button type="button" class="btn btn-sm btn-light" wire:click="$dispatch('account-create', { companyId: {{ $company->id }} })"><i class="ri-add-line"></i><span class="d-none d-sm-inline ms-1">Bank account</span></button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 ams-table">
                        <thead class="table-light">
                            <tr><th>Account</th><th class="d-none d-md-table-cell">Details</th><th class="money d-none d-sm-table-cell">Opening</th><th class="money">Balance</th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach ($company->accounts as $a)
                                <tr wire:key="acc-{{ $a->id }}">
                                    <td>
                                        <a href="{{ route('accounts.show', $a) }}" class="fw-semibold text-body"><i class="{{ $a->type->icon() }} me-1 text-{{ $a->isCash() ? 'success' : 'primary' }}"></i>{{ $a->shortLabel() }}</a>
                                        @unless ($a->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                                        <div class="fs-12 text-muted">{{ $a->type->label() }}</div>
                                    </td>
                                    <td class="fs-13 d-none d-md-table-cell">
                                        @if ($a->isCash())
                                            <span class="text-muted">Physical cash</span>
                                        @else
                                            {{ $a->account_title ?: '—' }}
                                            <div class="fs-12 text-muted">{{ collect([$a->account_number ? 'A/c '.$a->account_number : null, $a->branch, $a->iban])->filter()->implode(' · ') }}</div>
                                        @endif
                                    </td>
                                    <td class="money d-none d-sm-table-cell text-muted fs-13">{{ money($a->opening_balance) }}<div class="fs-11">{{ $a->opening_date?->format('d M Y') }}</div></td>
                                    <td class="money fw-semibold">{{ money($a->current_balance) }}</td>
                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('accounts.show', $a) }}" class="btn btn-sm btn-light" title="Statement"><i class="ri-file-list-3-line"></i><span class="d-none d-xl-inline ms-1">Statement</span></a>
                                        <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('account-edit', { id: {{ $a->id }} })"><i class="ri-edit-line"></i></button>
                                        @unless ($a->isCash())
                                            <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                                x-on:click="amsConfirm(@js('Delete '.$a->shortLabel().'? Only possible when it has no transactions.'), 'Delete').then(ok => ok && $wire.delete({{ $a->id }}))"><i class="ri-delete-bin-line"></i></button>
                                        @endunless
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="card"><div class="card-body text-center text-muted py-5">Create a company first — its cash in hand is added automatically.</div></div>
    @endforelse
    @endunless

    <x-modal id="accountModal" :title="$accountId ? ($type === 'cash' ? 'Edit Cash in Hand' : 'Edit Bank Account') : 'New Bank Account'" :icon="$type === 'cash' ? 'ri-wallet-3-line' : 'ri-bank-line'" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model="company_id" :options="$this->companyOptions" placeholder="Select company" :disabled="(bool) $accountId" :invalid="$errors->has('company_id')" />
                        @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Account name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="{{ $type === 'cash' ? 'Cash in hand' : 'e.g. HBL Current' }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @if ($type === 'bank')
                        <div class="col-md-6">
                            <label class="form-label">Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bank_name') is-invalid @enderror" wire:model="bank_name" list="bank-names" placeholder="e.g. HBL">
                            <datalist id="bank-names">@foreach (['HBL', 'MCB', 'UBL', 'Allied Bank', 'Meezan Bank', 'Bank Alfalah', 'National Bank of Pakistan', 'Bank of Punjab', 'Askari Bank', 'Faysal Bank'] as $b)<option value="{{ $b }}">@endforeach</datalist>
                            @error('bank_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Branch</label><input type="text" class="form-control" wire:model="branch"></div>
                        <div class="col-md-6"><label class="form-label">Account title</label><input type="text" class="form-control" wire:model="account_title"></div>
                        <div class="col-md-6"><label class="form-label">Account number</label><input type="text" class="form-control" wire:model="account_number"></div>
                        <div class="col-12"><label class="form-label">IBAN</label><input type="text" class="form-control" wire:model="iban" maxlength="34"></div>
                    @endif
                    <div class="col-md-6">
                        <label class="form-label">Opening balance</label>
                        <div class="input-group has-validation"><span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('opening_balance') is-invalid @enderror" wire:model="opening_balance">
                            @error('opening_balance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Opening date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('opening_date') is-invalid @enderror" wire:model="opening_date">
                        @error('opening_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="acc-active" wire:model="is_active">
                            <label class="form-check-label" for="acc-active">Active (shown in dropdowns)</label>
                        </div>
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
