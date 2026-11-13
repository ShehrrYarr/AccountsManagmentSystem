<?php

/**
 * Opening balances carried over from before the system: banks (on the account itself), the
 * admin's cash in hand (no company), and department / supplier / agent balances per company.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\OpeningBalance;
use App\Services\DealService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['recordId' => null])->locked();
state(['filterCompany' => null]);
state(['company_id' => null, 'party' => 'department', 'department_id' => null, 'supplier_id' => null, 'agent_account_id' => null, 'direction' => 'owes', 'amount' => '', 'date' => '', 'notes' => '']);

rules(fn () => [
    'company_id' => [$this->party === 'cash' ? 'nullable' : 'required', 'exists:companies,id'],
    'department_id' => [$this->party === 'department' ? 'required' : 'nullable', 'exists:departments,id'],
    'supplier_id' => [$this->party === 'supplier' ? 'required' : 'nullable', 'exists:suppliers,id'],
    'agent_account_id' => [$this->party === 'agent' ? 'required' : 'nullable', 'exists:accounts,id'],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date'],
    'notes' => ['nullable', 'string', 'max:255'],
]);

// Company bank accounts (their opening lives on the account). Cash openings are rows below.
$accounts = computed(fn () => Account::with('company')->banks()->whereHas('company')
    ->when($this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->orderBy('company_id')->orderBy('name')->get());

$openings = computed(fn () => OpeningBalance::with(['company', 'department', 'supplier', 'account'])
    ->when($this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->orderBy('company_id')->orderByDesc('account_id')->orderByDesc('department_id')->get());

$companyOptions = computed(fn () => Options::companies());

on(['transaction-updated' => function () {
    unset($this->accounts, $this->openings);
}]);

$create = function (string $party = 'department') {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->fill(['company_id' => $this->filterCompany, 'party' => $party, 'department_id' => null, 'supplier_id' => null, 'agent_account_id' => null,
        'direction' => 'owes', 'amount' => '', 'date' => now()->toDateString(), 'notes' => '']);
    $this->showModal('openingModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $o = OpeningBalance::findOrFail($id);
    $this->recordId = $o->id;
    $this->fill([
        'company_id' => $o->company_id, 'party' => $o->isAgent() ? 'agent' : ($o->account_id ? 'cash' : ($o->department_id ? 'department' : 'supplier')),
        'department_id' => $o->department_id, 'supplier_id' => $o->supplier_id, 'agent_account_id' => $o->isAgent() ? $o->account_id : null,
        'direction' => Money::isNegative($o->amount) ? 'held' : 'owes',
        'amount' => Money::isNegative($o->amount) ? Money::sub(0, $o->amount) : $o->amount,
        'date' => $o->date->toDateString(), 'notes' => $o->notes ?? '',
    ]);
    $this->showModal('openingModal');
};

$save = function () {
    $data = $this->validate();
    $amount = Money::of($data['amount']);
    $data['amount'] = $this->party === 'department' && $this->direction === 'held' ? Money::sub(0, $amount) : $amount;
    $data['department_id'] = $this->party === 'department' ? $data['department_id'] : null;
    $data['supplier_id'] = $this->party === 'supplier' ? $data['supplier_id'] : null;
    $data['company_id'] = $this->party === 'cash' ? null : $data['company_id'];
    $data['account_id'] = match ($this->party) {
        'cash' => Account::adminCash()->id,
        'agent' => $data['agent_account_id'],
        default => null,
    };

    $ok = $this->attempt(function () use ($data) {
        $o = app(DealService::class)->saveOpening($this->recordId ? OpeningBalance::findOrFail($this->recordId) : null, $data);
        $this->toast('success', 'Opening balance for '.$o->partyName().' saved.');
    }, 'amount');
    if ($ok !== false) {
        $this->hideModal('openingModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    if ($this->attempt(fn () => app(DealService::class)->deleteOpening(OpeningBalance::findOrFail($id))) !== false) {
        $this->toast('success', 'Opening balance removed.');
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
        <div style="min-width:220px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
        <div class="ms-auto d-flex gap-2">
            <button type="button" class="btn btn-sm btn-success" wire:click="create('cash')"><i class="ri-wallet-3-line me-1"></i>Cash in hand</button>
            <button type="button" class="btn btn-sm btn-primary" wire:click="create('department')"><i class="ri-government-line me-1"></i>Department balance</button>
            <button type="button" class="btn btn-sm btn-primary" wire:click="create('supplier')"><i class="ri-truck-line me-1"></i>Supplier balance</button>
            <button type="button" class="btn btn-sm btn-info" wire:click="create('agent')"><i class="ri-user-shared-line me-1"></i>Held by agent</button>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-5">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Bank opening balances</h5></div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 ams-table">
                        <thead class="table-light"><tr><th>Account</th><th class="money">Opening</th><th></th></tr></thead>
                        <tbody>
                            @forelse ($this->accounts as $a)
                                <tr wire:key="oa-{{ $a->id }}">
                                    <td><span class="fw-medium">{{ $a->shortLabel() }}</span><div class="fs-12 text-muted">{{ $a->company->name }}</div></td>
                                    <td class="money">{{ money($a->opening_balance) }}<div class="fs-11 text-muted">{{ $a->opening_date?->format('d M Y') }}</div></td>
                                    <td class="text-end"><button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('account-edit', { id: {{ $a->id }} })"><i class="ri-edit-line"></i></button></td>
                                </tr>
                            @empty
                                <x-empty-row :colspan="3" icon="ri-safe-2-line" message="No bank accounts yet." />
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card h-100 mb-0">
                <div class="card-header"><h5 class="card-title mb-0">Cash, agent, department &amp; supplier opening balances</h5></div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 ams-table">
                        <thead class="table-light"><tr><th>Party</th><th class="d-none d-md-table-cell">Company</th><th class="money">Balance</th><th></th></tr></thead>
                        <tbody>
                            @forelse ($this->openings as $o)
                                <tr wire:key="ob-{{ $o->id }}">
                                    <td>
                                        @php([$badge, $kind] = match (true) {
                                            $o->isAgent() => ['bg-primary-subtle text-primary', 'Agent'],
                                            (bool) $o->account_id => ['bg-success-subtle text-success', 'Admin cash'],
                                            (bool) $o->department_id => ['bg-info-subtle text-info', 'Department'],
                                            default => ['bg-warning-subtle text-warning', 'Supplier'],
                                        })
                                        <span class="badge {{ $badge }}">{{ $kind }}</span>
                                        <span class="fw-medium">{{ $o->partyName() }}</span>
                                        <div class="fs-12 text-muted d-md-none">{{ $o->company?->name ?? 'No company' }}</div>
                                        @if ($o->notes)<div class="fs-12 text-muted">{{ $o->notes }}</div>@endif
                                    </td>
                                    <td class="fs-13 d-none d-md-table-cell">{{ $o->company?->name ?? '—' }}</td>
                                    <td class="money">
                                        {{ money(Money::isNegative($o->amount) ? Money::sub(0, $o->amount) : $o->amount) }}
                                        <div class="fs-11 text-muted">
                                            {{ $o->isAgent() ? 'agent holds, owes you' : ($o->account_id ? 'cash in hand, no company' : ($o->supplier_id ? 'you owe them' : (Money::isNegative($o->amount) ? 'you hold' : 'owes you'))) }} · {{ $o->date->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="text-end text-nowrap">
                                        <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $o->id }})"><i class="ri-edit-line"></i></button>
                                        <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                            x-on:click="amsConfirm(@js('Remove the opening balance for '.$o->partyName().'?'), 'Remove').then(ok => ok && $wire.delete({{ $o->id }}))"><i class="ri-delete-bin-line"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <x-empty-row :colspan="4" icon="ri-flag-line" message="No cash, agent, department or supplier opening balances." />
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="openingModal" :title="($recordId ? 'Edit ' : 'Add ').match ($party) { 'cash' => 'Cash in Hand', 'agent' => 'Agent', 'department' => 'Department', default => 'Supplier' }.' Opening Balance'" icon="ri-flag-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    @if ($party !== 'cash')
                        <div class="col-12">
                            <label class="form-label">Company <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('company_id')" />
                            @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    @endif
                    @if ($party === 'cash')
                        <div class="col-12">
                            <div class="form-text mt-0"><i class="ri-wallet-3-line"></i> Cash in the <strong>admin cash in hand</strong> on the opening date. The cash belongs to no company.</div>
                        </div>
                    @elseif ($party === 'agent')
                        <div class="col-12">
                            <label class="form-label">Agent account <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="agent_account_id" :options="Options::agentAccounts(null, $agent_account_id)" placeholder="Select the agent's account" :invalid="$errors->has('agent_account_id')" />
                            @error('agent_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <div class="form-text">This company's money the agent already held in this account on the opening date. It counts as what the agent owes.</div>
                        </div>
                    @elseif ($party === 'department')
                        <div class="col-12">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="department_id" :options="Options::departments($department_id)" placeholder="Select department" :invalid="$errors->has('department_id')" />
                            @error('department_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" id="ob-owes" value="owes" wire:model.live="direction">
                                <label class="btn btn-outline-danger" for="ob-owes">Department owes me</label>
                                <input type="radio" class="btn-check" id="ob-held" value="held" wire:model.live="direction">
                                <label class="btn btn-outline-success" for="ob-held">I hold their money</label>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <label class="form-label">Supplier <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="supplier_id" :options="Options::suppliers($supplier_id)" placeholder="Select supplier" :invalid="$errors->has('supplier_id')" />
                            @error('supplier_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <div class="form-text">Amount the company owed this supplier on the opening date.</div>
                        </div>
                    @endif
                    <div class="col-sm-6">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model="amount">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">As of date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <input type="text" class="form-control" wire:model="notes">
                    </div>
                    @error('party') <div class="col-12"><div class="alert alert-danger mb-0 py-2">{{ $message }}</div></div> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
