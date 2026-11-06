<?php

/**
 * Manage a company's bank accounts (destinations for bank transfers).
 * Open with: $dispatch('company-accounts', { companyId: 5 })
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Company;
use App\Models\CompanyBankAccount;
use App\Models\DisbursementLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['companyId' => null, 'accountId' => null])->locked();
state(['bank_name' => '', 'branch' => '', 'account_title' => '', 'account_number' => '', 'iban' => '', 'is_default' => false, 'is_active' => true, 'editing' => false]);

rules(fn () => [
    'bank_name' => ['required', 'string', 'max:255'],
    'branch' => ['nullable', 'string', 'max:255'],
    'account_title' => ['required', 'string', 'max:255'],
    'account_number' => ['required', 'string', 'max:50', Rule::unique('company_bank_accounts')->where('company_id', $this->companyId)->ignore($this->accountId)],
    'iban' => ['nullable', 'string', 'max:34'],
    'is_default' => ['boolean'],
    'is_active' => ['boolean'],
]);

$company = computed(fn () => $this->companyId ? Company::withTrashed()->find($this->companyId) : null);
$accounts = computed(fn () => $this->companyId
    ? CompanyBankAccount::where('company_id', $this->companyId)->withCount('lines as used_count')->orderByDesc('is_default')->orderBy('bank_name')->get()
    : collect());

on(['company-accounts' => function (int $companyId) {
    $this->companyId = $companyId;
    $this->cancel();
    unset($this->company, $this->accounts);
    $this->showModal('companyAccountsModal');
}]);

$cancel = function () {
    $this->resetErrorBag();
    $this->fill(['bank_name' => '', 'branch' => '', 'account_title' => '', 'account_number' => '', 'iban' => '', 'is_default' => false, 'is_active' => true, 'editing' => false]);
    $this->accountId = null;
};

$add = function () {
    $this->cancel();
    $this->account_title = $this->company?->name ?? '';
    $this->editing = true;
};

$edit = function (int $id) {
    $this->cancel();
    $a = CompanyBankAccount::where('company_id', $this->companyId)->findOrFail($id);
    $this->accountId = $a->id;
    $this->fill($a->only(['bank_name', 'branch', 'account_title', 'account_number', 'iban', 'is_default', 'is_active']));
    $this->editing = true;
};

$save = function () {
    $data = $this->validate();

    DB::transaction(function () use ($data) {
        if ($data['is_default']) {
            CompanyBankAccount::where('company_id', $this->companyId)->update(['is_default' => false]);
        }
        $this->accountId
            ? CompanyBankAccount::where('company_id', $this->companyId)->findOrFail($this->accountId)->update($data)
            : CompanyBankAccount::create(array_merge($data, ['company_id' => $this->companyId]));
    });

    $this->toast('success', 'Bank account saved.');
    $this->cancel();
    unset($this->accounts);
};

$delete = function (int $id) {
    $a = CompanyBankAccount::where('company_id', $this->companyId)->findOrFail($id);
    if (DisbursementLine::where('company_bank_account_id', $a->id)->exists()) {
        $a->update(['is_active' => false]);
        $this->toast('info', 'This account has transfers on record, so it was deactivated instead of deleted.');
    } else {
        $a->delete();
        $this->toast('success', 'Bank account removed.');
    }
    unset($this->accounts);
};

?>

<div>
    <x-modal id="companyAccountsModal" :title="'Bank accounts — '.($this->company?->name ?? '')" icon="ri-bank-line" size="lg" :static="false">
        <div class="modal-body">
            <div class="table-responsive mb-3">
                <table class="table table-sm align-middle mb-0">
                    <thead class="table-light"><tr><th>Bank</th><th>Title</th><th>Account # / IBAN</th><th>Status</th><th class="text-end"></th></tr></thead>
                    <tbody>
                        @forelse ($this->accounts as $a)
                            <tr wire:key="cba-{{ $a->id }}">
                                <td>{{ $a->bank_name }} @if ($a->branch)<div class="fs-11 text-muted">{{ $a->branch }}</div>@endif</td>
                                <td>{{ $a->account_title }}</td>
                                <td class="fs-13">{{ $a->account_number }} @if ($a->iban)<div class="fs-11 text-muted">{{ $a->iban }}</div>@endif</td>
                                <td>
                                    @if ($a->is_default)<span class="badge bg-primary-subtle text-primary">Default</span>@endif
                                    @unless ($a->is_active)<span class="badge bg-secondary-subtle text-secondary">Inactive</span>@endunless
                                    @if ($a->used_count)<div class="fs-11 text-muted">{{ $a->used_count }} transfer(s)</div>@endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $a->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" x-on:click="amsConfirm('Remove this bank account?', 'Remove').then(ok => ok && $wire.delete({{ $a->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No bank accounts yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($editing)
                <form wire:submit="save" class="border rounded-3 p-3 bg-light-subtle">
                    <h6 class="mb-3">{{ $accountId ? 'Edit account' : 'Add account' }}</h6>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label fs-12">Bank *</label>
                            <input class="form-control form-control-sm @error('bank_name') is-invalid @enderror" wire:model="bank_name">
                            @error('bank_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fs-12">Branch</label>
                            <input class="form-control form-control-sm" wire:model="branch">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fs-12">Account title *</label>
                            <input class="form-control form-control-sm @error('account_title') is-invalid @enderror" wire:model="account_title">
                            @error('account_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fs-12">Account number *</label>
                            <input class="form-control form-control-sm @error('account_number') is-invalid @enderror" wire:model="account_number">
                            @error('account_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fs-12">IBAN</label>
                            <input class="form-control form-control-sm" wire:model="iban" placeholder="PK00XXXX0000000000000000">
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-end gap-1">
                            <div class="form-check form-check-sm"><input class="form-check-input" type="checkbox" id="cba-def" wire:model="is_default"><label class="form-check-label fs-12" for="cba-def">Default</label></div>
                            <div class="form-check form-check-sm"><input class="form-check-input" type="checkbox" id="cba-act" wire:model="is_active"><label class="form-check-label fs-12" for="cba-act">Active</label></div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-sm btn-light" wire:click="cancel">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save account</button>
                    </div>
                </form>
            @else
                <button type="button" class="btn btn-sm btn-primary" wire:click="add"><i class="ri-add-line me-1"></i>Add bank account</button>
            @endif
        </div>
    </x-modal>
</div>
