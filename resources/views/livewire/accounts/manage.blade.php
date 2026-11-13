<?php

/**
 * Cash & bank accounts, with balances and statements.
 *
 *   Admin (default): the admin's single cash in hand, every company's bank accounts, and every
 *                    agent's cash in hand + bank accounts (admin may add / edit any of them).
 *   companyId      : one company's bank accounts (company page).
 *   mine           : the signed-in agent's own accounts ("My Accounts"). Accounts the admin added
 *                    for them are read-only; the agent may add / edit / delete their own banks.
 *
 * Open the form with: $dispatch('account-create', { companyId: 1 }) / { agentId: 7 }  or  $dispatch('account-edit', { id: 3 })
 */

use App\Enums\AccountType;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Company;
use App\Models\User;
use App\Services\MasterDataService;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, mount, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['companyId' => null, 'accountId' => null, 'modalOnly' => false, 'mine' => false])->locked();
state(['showInactive' => false]);
state([
    'holder' => 'company', 'company_id' => null, 'agent_id' => null,
    'type' => 'bank', 'name' => '', 'bank_name' => '', 'branch' => '', 'account_title' => '',
    'account_number' => '', 'iban' => '', 'opening_balance' => '0', 'opening_date' => '', 'is_active' => true,
]);

// Volt hands props to mount() when one is defined, so they are assigned here.
mount(function (?int $companyId = null, bool $modalOnly = false, bool $mine = false) {
    $this->fill(['companyId' => $companyId, 'modalOnly' => $modalOnly, 'mine' => $mine]);
    abort_unless($mine ? auth()->user()->isAgent() : auth()->user()->isAdmin(), 403);
});

rules(fn () => [
    'holder' => ['required', Rule::in(['company', 'agent'])],
    'company_id' => [$this->holder === 'company' ? 'required' : 'nullable', 'exists:companies,id'],
    'agent_id' => [$this->holder === 'agent' ? 'required' : 'nullable', 'exists:users,id'],
    'name' => ['required', 'string', 'max:255', Rule::unique('accounts', 'name')
        ->where($this->holder === 'agent' ? 'agent_id' : 'company_id', $this->holder === 'agent' ? $this->agent_id : $this->company_id)
        ->whereNull('deleted_at')->ignore($this->accountId)],
    'bank_name' => [$this->type === 'bank' ? 'required' : 'nullable', 'string', 'max:255'],
    'branch' => ['nullable', 'string', 'max:255'],
    'account_title' => ['nullable', 'string', 'max:255'],
    'account_number' => ['nullable', 'string', 'max:50'],
    'iban' => ['nullable', 'string', 'max:34'],
    'opening_balance' => ['nullable', 'numeric', 'min:0'],
    'opening_date' => [$this->holder === 'company' ? 'required' : 'nullable', 'date'],
    'is_active' => ['boolean'],
])->messages(['name.unique' => 'There is already an account with that name.'])->attributes(['agent_id' => 'agent', 'company_id' => 'company']);

$active = fn ($q) => $q->when(! $this->showInactive, fn ($q) => $q->where('is_active', true))->orderBy('type')->orderBy('name');

$adminCash = computed(fn () => $this->modalOnly || $this->companyId || $this->mine ? null : Account::adminCash());

$groups = computed(fn () => $this->modalOnly || $this->mine ? collect() : Company::query()
    ->when($this->companyId, fn ($q, $id) => $q->whereKey($id))
    ->when(! $this->companyId, fn ($q) => $q->where('is_active', true))
    ->with(['accounts' => fn ($q) => $this->active($q->banks())])
    ->orderBy('name')->get());

$agents = computed(fn () => $this->modalOnly || $this->companyId ? collect() : User::query()
    ->where('role', 'agent')
    ->when($this->mine, fn ($q) => $q->whereKey(auth()->id()))
    ->when(! $this->showInactive && ! $this->mine, fn ($q) => $q->where('is_active', true))
    ->with(['agentAccounts' => fn ($q) => $this->active($q)->with('creator')])
    ->orderBy('name')->get());

$companyOptions = computed(fn () => Options::companies($this->company_id));
$agentOptions = computed(fn () => Options::agents($this->agent_id));

/** May the signed-in user change this account? */
$canChange = function (Account $a): bool {
    if ($a->isAdminCash()) {
        return false;
    }
    if ($this->mine) {
        return $a->agent_id === auth()->id() && $a->created_by === auth()->id() && ! $a->isCash();
    }

    return auth()->user()->isAdmin();
};

on(['transaction-updated' => function () {
    unset($this->groups, $this->agents, $this->adminCash);
}]);

on(['account-create' => function (?int $companyId = null, ?int $agentId = null) {
    $this->resetErrorBag();
    $this->accountId = null;
    $agentId = $this->mine ? auth()->id() : $agentId;
    $this->fill([
        'holder' => $agentId ? 'agent' : 'company', 'company_id' => $agentId ? null : ($companyId ?? $this->companyId), 'agent_id' => $agentId,
        'type' => 'bank', 'name' => '', 'bank_name' => '', 'branch' => '', 'account_title' => '', 'account_number' => '', 'iban' => '',
        'opening_balance' => '0', 'opening_date' => now()->toDateString(), 'is_active' => true,
    ]);
    $this->showModal('accountModal');
}]);

on(['account-edit' => function (int $id) {
    $this->resetErrorBag();
    $a = Account::findOrFail($id);
    abort_unless($this->canChange($a), 403);
    $this->accountId = $a->id;
    $this->fill($a->only(['company_id', 'agent_id', 'name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban', 'opening_balance', 'is_active'])
        + ['holder' => $a->agent_id ? 'agent' : 'company', 'type' => $a->type->value, 'opening_date' => $a->opening_date?->toDateString() ?? $a->created_at->toDateString()]);
    $this->showModal('accountModal');
}]);

$save = function () {
    if ($this->mine) {
        $this->fill(['holder' => 'agent', 'agent_id' => auth()->id(), 'type' => 'bank']);
    }
    $data = $this->validate() + ['type' => $this->type];
    $data[$this->holder === 'agent' ? 'company_id' : 'agent_id'] = null;

    $existing = $this->accountId ? Account::findOrFail($this->accountId) : null;
    abort_if($existing && ! $this->canChange($existing), 403);

    $ok = $this->attempt(function () use ($data, $existing) {
        $a = app(MasterDataService::class)->saveAccount($existing, $data, auth()->user());
        $this->toast('success', $a->label().' saved.');
    });
    if ($ok !== false) {
        $this->hideModal('accountModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $a = Account::findOrFail($id);
    abort_unless($this->canChange($a), 403);
    if ($this->attempt(fn () => app(MasterDataService::class)->deleteAccount($a)) !== false) {
        $this->toast('success', 'Account deleted.');
        $this->broadcastChange();
    }
};

?>

@php
    $details = fn ($a) => $a->isCash()
        ? '<span class="text-muted">Physical cash</span>'
        : e($a->account_title ?: '—').'<div class="fs-12 text-muted">'.e(collect([$a->bank_name, $a->account_number ? 'A/c '.$a->account_number : null, $a->branch, $a->iban])->filter()->implode(' · ')).'</div>';
@endphp

<div>
    @unless ($modalOnly)
        @if (! $companyId && ! $mine)
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                <div class="form-check form-switch mb-0 me-auto">
                    <input class="form-check-input" type="checkbox" id="acc-inactive" wire:model.live="showInactive">
                    <label class="form-check-label fs-13" for="acc-inactive">Show inactive accounts and agents</label>
                </div>
                <button type="button" class="btn btn-sm btn-primary" wire:click="$dispatch('account-create')"><i class="ri-add-line me-1"></i>New company bank account</button>
            </div>
        @endif

        {{-- The admin's cash in hand --}}
        @if ($cash = $this->adminCash)
            <div class="card border-success-subtle" wire:key="acc-admin-cash">
                <div class="card-header d-flex flex-wrap align-items-center gap-2">
                    <h5 class="card-title mb-0 me-auto"><i class="ri-wallet-3-line text-success me-1"></i>Admin cash in hand</h5>
                    <span class="fs-13 text-muted">Balance <strong class="text-body ams-balance">{{ money($cash->current_balance) }}</strong></span>
                    <a href="{{ route('accounts.show', $cash) }}" class="btn btn-sm btn-light"><i class="ri-file-list-3-line me-1"></i>Cash statement</a>
                </div>
                <div class="card-body py-2 fs-13 text-muted">
                    One cash in hand for the admin: a single pot that belongs to no company. Money moved in from a company bank counts as leaving that company; cash payments and expenses have no company.
                    Set the starting cash on <a href="{{ route('opening-balances.index') }}">Opening Balances</a>.
                </div>
            </div>
        @endif

        {{-- Company bank accounts --}}
        @unless ($mine)
            @forelse ($this->groups as $company)
                <div class="card" wire:key="accgrp-{{ $company->id }}">
                    <div class="card-header d-flex align-items-center gap-2">
                        <h5 class="card-title mb-0 me-auto"><a href="{{ route('companies.show', $company) }}" class="text-body">{{ $company->name }}</a></h5>
                        <span class="fs-13 text-muted">Banks <strong class="text-body ams-balance">{{ money($company->accounts->sum('current_balance')) }}</strong></span>
                        <button type="button" class="btn btn-sm btn-light" wire:click="$dispatch('account-create', { companyId: {{ $company->id }} })"><i class="ri-add-line"></i><span class="d-none d-sm-inline ms-1">Bank account</span></button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 ams-table">
                                <thead class="table-light">
                                    <tr><th>Account</th><th class="d-none d-md-table-cell">Details</th><th class="money d-none d-sm-table-cell">Opening</th><th class="money">Balance</th><th></th></tr>
                                </thead>
                                <tbody>
                                    @forelse ($company->accounts as $a)
                                        <tr wire:key="acc-{{ $a->id }}">
                                            <td>
                                                <a href="{{ route('accounts.show', $a) }}" class="fw-semibold text-body"><i class="{{ $a->type->icon() }} me-1 text-primary"></i>{{ $a->shortLabel() }}</a>
                                                @unless ($a->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                                                <div class="fs-12 text-muted">{{ $a->type->label() }}</div>
                                            </td>
                                            <td class="fs-13 d-none d-md-table-cell">{!! $details($a) !!}</td>
                                            <td class="money d-none d-sm-table-cell text-muted fs-13">{{ money($a->opening_balance) }}<div class="fs-11">{{ $a->opening_date?->format('d M Y') }}</div></td>
                                            <td class="money fw-semibold">{{ money($a->current_balance) }}</td>
                                            <td class="text-end text-nowrap">
                                                <a href="{{ route('accounts.show', $a) }}" class="btn btn-sm btn-light" title="Statement"><i class="ri-file-list-3-line"></i><span class="d-none d-xl-inline ms-1">Statement</span></a>
                                                <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('account-edit', { id: {{ $a->id }} })"><i class="ri-edit-line"></i></button>
                                                <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                                    x-on:click="amsConfirm(@js('Delete '.$a->shortLabel().'? Only possible when it has no transactions.'), 'Delete').then(ok => ok && $wire.delete({{ $a->id }}))"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <x-empty-row :colspan="5" icon="ri-bank-line" message="No bank accounts yet." />
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                @unless ($companyId)
                    <div class="card"><div class="card-body text-center text-muted py-4">No companies yet. Add one on the Companies page, then its bank accounts here.</div></div>
                @endunless
            @endforelse
        @endunless

        {{-- Agents' accounts --}}
        @if ($this->agents->isNotEmpty() || $mine)
            @unless ($mine)
                <h5 class="mt-4 mb-3"><i class="ri-user-star-line me-1"></i>Agents</h5>
            @endunless
            @foreach ($this->agents as $agent)
                <div class="card" id="agent-{{ $agent->id }}" wire:key="accagent-{{ $agent->id }}">
                    <div class="card-header d-flex align-items-center gap-2">
                        <h5 class="card-title mb-0 me-auto">
                            @if ($mine)
                                My cash &amp; bank accounts
                            @else
                                <a href="{{ route('agents.show', $agent) }}" class="text-body">{{ $agent->name }}</a>
                            @endif
                            @unless ($agent->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1 fs-11">Inactive</span>@endunless
                        </h5>
                        <span class="fs-13 text-muted">Owes <strong class="text-body ams-balance">{{ money(\App\Services\Balances::agentOwed($agent->id)) }}</strong></span>
                        <a href="{{ $mine ? route('my-ledger') : route('agents.show', $agent) }}" class="btn btn-sm btn-light"><i class="ri-book-open-line"></i><span class="d-none d-sm-inline ms-1">Ledger</span></a>
                        <button type="button" class="btn btn-sm btn-light" wire:click="$dispatch('account-create', { agentId: {{ $agent->id }} })"><i class="ri-add-line"></i><span class="d-none d-sm-inline ms-1">Bank account</span></button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 ams-table">
                                <thead class="table-light"><tr><th>Account</th><th class="d-none d-md-table-cell">Details</th><th>Added by</th><th class="money">Balance</th><th></th></tr></thead>
                                <tbody>
                                    @forelse ($agent->agentAccounts as $a)
                                        <tr wire:key="acc-{{ $a->id }}">
                                            <td>
                                                <a href="{{ $mine ? route('my-accounts.show', $a) : route('accounts.show', $a) }}" class="fw-semibold text-body"><i class="{{ $a->type->icon() }} me-1 text-{{ $a->isCash() ? 'success' : 'primary' }}"></i>{{ $a->shortLabel() }}</a>
                                                @unless ($a->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                                                <div class="fs-12 text-muted">{{ $a->type->label() }}</div>
                                            </td>
                                            <td class="fs-13 d-none d-md-table-cell">{!! $details($a) !!}</td>
                                            <td class="fs-13">
                                                @if ($a->isCash())
                                                    <span class="text-muted">Automatic</span>
                                                @elseif ($a->addedByAdmin())
                                                    <span class="badge bg-primary-subtle text-primary">Admin</span>
                                                @else
                                                    <span class="badge bg-info-subtle text-info">{{ $mine ? 'You' : 'Agent' }}</span>
                                                @endif
                                            </td>
                                            <td class="money fw-semibold">{{ money($a->current_balance) }}</td>
                                            <td class="text-end text-nowrap">
                                                <a href="{{ $mine ? route('my-accounts.show', $a) : route('accounts.show', $a) }}" class="btn btn-sm btn-light" title="Statement"><i class="ri-file-list-3-line"></i><span class="d-none d-xl-inline ms-1">Statement</span></a>
                                                @if ($this->canChange($a))
                                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('account-edit', { id: {{ $a->id }} })"><i class="ri-edit-line"></i></button>
                                                    @unless ($a->isCash())
                                                        <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                                            x-on:click="amsConfirm(@js('Delete '.$a->shortLabel().'?'), 'Delete').then(ok => ok && $wire.delete({{ $a->id }}))"><i class="ri-delete-bin-line"></i></button>
                                                    @endunless
                                                @elseif ($mine && $a->addedByAdmin())
                                                    <span class="fs-12 text-muted" title="Added by the admin; ask the admin to change it"><i class="ri-lock-line"></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <x-empty-row :colspan="5" icon="ri-bank-line" message="No accounts yet." />
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($mine)
                        <div class="card-footer fs-12 text-muted">Accounts marked <strong>Admin</strong> were added by the admin on your behalf and can only be changed by the admin.</div>
                    @endif
                </div>
            @endforeach
        @endif
    @endunless

    <x-modal id="accountModal" :title="($accountId ? 'Edit ' : 'New ').($type === 'cash' ? 'Cash in Hand' : 'Bank Account')" :icon="$type === 'cash' ? 'ri-wallet-3-line' : 'ri-bank-line'" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    @unless ($mine)
                        <div class="col-md-6">
                            <label class="form-label">Belongs to <span class="text-danger">*</span></label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" id="holder-company" value="company" wire:model.live="holder" @disabled($accountId)>
                                <label class="btn btn-outline-primary btn-sm" for="holder-company"><i class="ri-building-2-line me-1"></i>A company</label>
                                <input type="radio" class="btn-check" id="holder-agent" value="agent" wire:model.live="holder" @disabled($accountId)>
                                <label class="btn btn-outline-primary btn-sm" for="holder-agent"><i class="ri-user-star-line me-1"></i>An agent</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($holder === 'agent')
                                <label class="form-label">Agent <span class="text-danger">*</span></label>
                                <x-searchable-select wire:model="agent_id" :options="$this->agentOptions" placeholder="Select agent" :disabled="(bool) $accountId" :invalid="$errors->has('agent_id')" />
                                @error('agent_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            @else
                                <label class="form-label">Company <span class="text-danger">*</span></label>
                                <x-searchable-select wire:model="company_id" :options="$this->companyOptions" placeholder="Select company" :disabled="(bool) $accountId" :invalid="$errors->has('company_id')" />
                                @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            @endif
                        </div>
                    @endunless
                    <div class="col-md-6">
                        <label class="form-label">Account name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="{{ $type === 'cash' ? 'Cash in hand' : 'e.g. HBL Current' }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @if ($type === 'bank')
                        <div class="col-md-6">
                            <label class="form-label">Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bank_name') is-invalid @enderror" wire:model="bank_name" list="bank-names" placeholder="e.g. HBL">
                            <datalist id="bank-names">@foreach (['HBL', 'MCB', 'UBL', 'Allied Bank', 'Meezan Bank', 'Bank Alfalah', 'National Bank of Pakistan', 'Bank of Punjab', 'Askari Bank', 'Faysal Bank', 'JS Bank', 'Easypaisa', 'JazzCash'] as $b)<option value="{{ $b }}">@endforeach</datalist>
                            @error('bank_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Branch</label><input type="text" class="form-control" wire:model="branch"></div>
                        <div class="col-md-6"><label class="form-label">Account title</label><input type="text" class="form-control" wire:model="account_title"></div>
                        <div class="col-md-6"><label class="form-label">Account number</label><input type="text" class="form-control" wire:model="account_number"></div>
                        <div class="col-md-6"><label class="form-label">IBAN</label><input type="text" class="form-control" wire:model="iban" maxlength="34"></div>
                    @endif
                    @if ($holder === 'company')
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
                    @endif
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="acc-active" wire:model="is_active">
                            <label class="form-check-label" for="acc-active">Active</label>
                        </div>
                        @if ($holder === 'agent')
                            <div class="form-text"><i class="ri-information-line"></i> The admin sends advances to agent accounts from Transfers; what an agent holds there is owed back to the companies.</div>
                        @endif
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
