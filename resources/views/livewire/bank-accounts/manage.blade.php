<?php

/**
 * My bank accounts and the single Cash Vault. Admins create / edit; everyone can view balances.
 */

use App\Enums\BankAccountType;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\BankAccount;
use App\Services\MasterDataService;
use App\Support\Money;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['accountId' => null])->locked();
state([
    'name' => '', 'type' => 'bank', 'bank_name' => '', 'branch' => '', 'account_title' => '',
    'account_number' => '', 'iban' => '', 'opening_balance' => '0', 'is_active' => true,
]);

rules(fn () => [
    'name' => ['required', 'string', 'max:255', Rule::unique('bank_accounts', 'name')->ignore($this->accountId)],
    'type' => ['required', Rule::enum(BankAccountType::class)],
    'bank_name' => [Rule::requiredIf($this->type === 'bank'), 'nullable', 'string', 'max:255'],
    'branch' => ['nullable', 'string', 'max:255'],
    'account_title' => ['nullable', 'string', 'max:255'],
    'account_number' => ['nullable', 'string', 'max:50'],
    'iban' => ['nullable', 'string', 'max:34'],
    'opening_balance' => ['nullable', 'numeric', 'min:0'],
    'is_active' => ['boolean'],
]);

$accounts = computed(fn () => BankAccount::orderBy('type', 'desc')->orderBy('name')->get());
$hasVault = computed(fn () => BankAccount::where('type', BankAccountType::Cash)->exists());

on(['transaction-updated' => function () {
    unset($this->accounts, $this->hasVault);
}]);

$create = function (string $type = 'bank') {
    abort_unless(auth()->user()->isAdmin(), 403);
    $this->resetErrorBag();
    $this->reset(['name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban', 'opening_balance', 'is_active']);
    $this->accountId = null;
    $this->type = $type === 'cash' ? 'cash' : 'bank';
    if ($this->type === 'cash') {
        $this->name = 'Cash Vault';
    }
    $this->showModal('accountModal');
};

$edit = function (int $id) {
    abort_unless(auth()->user()->isAdmin(), 403);
    $this->resetErrorBag();
    $a = BankAccount::findOrFail($id);
    $this->accountId = $a->id;
    $this->fill($a->only(['name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban', 'opening_balance', 'is_active']) + ['type' => $a->type->value]);
    $this->showModal('accountModal');
};

$save = function () {
    abort_unless(auth()->user()->isAdmin(), 403);
    $data = $this->validate();

    $ok = $this->attempt(function () use ($data) {
        $a = app(MasterDataService::class)->saveBankAccount($this->accountId ? BankAccount::findOrFail($this->accountId) : null, $data);
        $this->toast('success', "{$a->name} saved.");
    });

    if ($ok !== false) {
        $this->hideModal('accountModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    abort_unless(auth()->user()->isAdmin(), 403);
    $ok = $this->attempt(fn () => app(MasterDataService::class)->deleteBankAccount(BankAccount::findOrFail($id)));
    if ($ok !== false) {
        $this->toast('success', 'Account deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    @php($all = $this->accounts)
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <x-stat-card label="Total liquidity" :value="money($all->sum('current_balance'))" icon="ri-wallet-3-line" color="primary" />
        </div>
        <div class="col-md-4">
            <x-stat-card label="In banks" :value="money($all->where('type', BankAccountType::Bank)->sum('current_balance'))" icon="ri-bank-line" color="info" />
        </div>
        <div class="col-md-4">
            <x-stat-card label="Cash in vault" :value="money($all->where('type', BankAccountType::Cash)->sum('current_balance'))" icon="ri-safe-2-line" color="success" />
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center gap-2">
            <h5 class="card-title mb-0 me-auto">My accounts</h5>
            @can('admin')
                @unless ($this->hasVault)
                    <button type="button" class="btn btn-sm btn-success" wire:click="create('cash')"><i class="ri-safe-2-line me-1"></i>Create Cash Vault</button>
                @endunless
                <button type="button" class="btn btn-sm btn-primary" wire:click="create('bank')"><i class="ri-add-line me-1"></i>New Bank Account</button>
            @endcan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Account</th><th>Bank / branch</th><th>Account # / IBAN</th><th class="money">Opening</th><th class="money">Current balance</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse ($all as $a)
                            <tr wire:key="ba-{{ $a->id }}">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="avatar avatar-sm rounded bg-{{ $a->isVault() ? 'success' : 'primary' }}-subtle text-{{ $a->isVault() ? 'success' : 'primary' }} d-flex align-items-center justify-content-center"><i class="{{ $a->type->icon() }}"></i></span>
                                        <div>
                                            <div class="fw-semibold">{{ $a->name }}</div>
                                            <div class="fs-12 text-muted">{{ $a->type->label() }} @unless ($a->is_active)· <span class="text-danger">Inactive</span>@endunless</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fs-13">{{ $a->bank_name ?? '—' }} @if ($a->branch)<div class="fs-12 text-muted">{{ $a->branch }}</div>@endif</td>
                                <td class="fs-13">{{ $a->account_number ?? '—' }} @if ($a->iban)<div class="fs-12 text-muted">{{ $a->iban }}</div>@endif</td>
                                <td class="money fs-13 text-muted">{{ money($a->opening_balance) }}</td>
                                <td class="money fw-semibold fs-15">{{ money($a->current_balance) }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-light icon-btn-sm" title="Journal"><i class="ri-book-2-line"></i></a>
                                    @can('admin')
                                        <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $a->id }})" title="Edit"><i class="ri-edit-line"></i></button>
                                        <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                            x-on:click="amsConfirm(@js('Delete '.$a->name.'? Only possible when it has no transactions.'), 'Delete').then(ok => ok && $wire.delete({{ $a->id }}))"><i class="ri-delete-bin-line"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="6" icon="ri-bank-line" message="No accounts yet. Create your Cash Vault and bank accounts to begin." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal id="accountModal" :title="$accountId ? 'Edit Account' : ($type === 'cash' ? 'Create Cash Vault' : 'New Bank Account')" icon="ri-bank-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror
                @error('type') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Display name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="e.g. HBL Main">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Opening balance</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('opening_balance') is-invalid @enderror" wire:model="opening_balance">
                            @error('opening_balance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    @if ($type === 'bank')
                        <div class="col-md-6">
                            <label class="form-label">Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bank_name') is-invalid @enderror" wire:model="bank_name">
                            @error('bank_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Branch</label>
                            <input type="text" class="form-control" wire:model="branch">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Account title</label>
                            <input type="text" class="form-control" wire:model="account_title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Account number</label>
                            <input type="text" class="form-control" wire:model="account_number">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IBAN</label>
                            <input type="text" class="form-control" wire:model="iban">
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="ba-active" wire:model="is_active">
                            <label class="form-check-label" for="ba-active">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Save account</button>
            </div>
        </form>
    </x-modal>
</div>
