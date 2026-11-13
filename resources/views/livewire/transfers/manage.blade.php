<?php

/**
 * Transfers: cash & bank moves (bank → admin cash, admin cash → bank, bank to bank), between my
 * companies, advances to agents and returns from agents. List + modal; embeddable on a company page.
 * The admin's cash belongs to no company: moving bank money into it takes it out of the company.
 *
 * Open the form with: $dispatch('transfer-create', { companyId: 1, mode: 'own' | 'intercompany' | 'advance' | 'return', agentId: 7 })  (all optional)
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Company;
use App\Models\Transfer;
use App\Services\Balances;
use App\Services\TransferService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, mount, on, rules, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['companyId' => null, 'recordId' => null, 'modalOnly' => false])->locked();

// Locked props aren't filled in from the tag on their own; assign them here.
mount(function (?int $companyId = null, bool $modalOnly = false) {
    $this->fill(['companyId' => $companyId, 'modalOnly' => $modalOnly]);
});
state(['filterKind' => '', 'filterCompany' => null, 'from' => '', 'to' => '']);
state([
    'mode' => 'own', 'agentId' => null, 'from_company_id' => null, 'from_account_id' => null, 'to_company_id' => null, 'to_account_id' => null,
    'amount' => '', 'date' => '', 'reference' => '', 'notes' => '',
]);

rules(fn () => [
    'from_company_id' => [$this->mode === 'own' ? 'nullable' : 'required', 'exists:companies,id'],
    'to_company_id' => [$this->mode === 'intercompany' ? 'required' : 'nullable', 'exists:companies,id', $this->mode === 'intercompany' ? 'different:from_company_id' : 'nullable'],
    'from_account_id' => ['required', 'exists:accounts,id'],
    'to_account_id' => ['required', 'exists:accounts,id', 'different:from_account_id'],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'reference' => ['nullable', 'string', 'max:255'],
    'notes' => ['nullable', 'string', 'max:2000'],
])->messages([
    'to_company_id.different' => 'Choose a different company to receive the money.',
    'to_account_id.different' => 'Choose two different accounts.',
    'from_account_id.required' => 'Choose the account the money leaves.',
    'to_account_id.required' => 'Choose the account the money goes to.',
]);

$updated = function ($property) {
    if (in_array($property, ['filterKind', 'filterCompany', 'from', 'to'], true)) {
        $this->resetPage('trPage');
    }
    if ($property === 'from_company_id' && $this->mode !== 'own') {
        // In a return the agent's account is the "from" side; only the company account changes.
        if ($this->mode !== 'return') {
            $this->from_account_id = null;
        }
        if (in_array($this->mode, ['own', 'return'], true)) {
            $this->to_account_id = null;
        }
    }
    if ($property === 'to_company_id') {
        $this->to_account_id = null;
    }
    if ($property === 'mode') {
        $this->fill(['to_company_id' => null, 'to_account_id' => null, 'from_account_id' => null]);
        $this->resetErrorBag();
    }
};

$baseQuery = computed(function () {
    $company = $this->companyId ?? $this->filterCompany;

    $agentAccounts = fn () => Account::withTrashed()->whereNotNull('agent_id')->select('id');

    return Transfer::query()->posted()
        ->when($company, fn ($q) => $q->where(fn ($q) => $q->where('from_company_id', $company)->orWhere('to_company_id', $company)))
        ->when($this->filterKind === 'own', fn ($q) => $q
            ->where(fn ($q) => $q->whereNull('from_company_id')->orWhereNull('to_company_id')->orWhereColumn('from_company_id', 'to_company_id'))
            ->whereNotIn('from_account_id', $agentAccounts())->whereNotIn('to_account_id', $agentAccounts()))
        ->when($this->filterKind === 'intercompany', fn ($q) => $q->whereNotNull('from_company_id')->whereNotNull('to_company_id')
            ->whereColumn('from_company_id', '<>', 'to_company_id'))
        ->when($this->filterKind === 'agent', fn ($q) => $q->where(fn ($q) => $q->whereIn('from_account_id', $agentAccounts())->orWhereIn('to_account_id', $agentAccounts())))
        ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
        ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to));
});

$rows = computed(fn () => (clone $this->baseQuery)->with(['fromAccount.agent', 'toAccount.agent', 'fromCompany', 'toCompany', 'creator', 'decider'])
    ->orderByDesc('date')->orderByDesc('id')->paginate(15, pageName: 'trPage'));

$companyOptions = computed(fn () => Options::companies());
// Cash & bank moves: the admin's cash and every company bank (on a company page, its banks and the cash).
// Between companies: banks only. Advance / return: the chosen company's banks and the admin's cash.
$fromAccounts = computed(fn () => match (true) {
    $this->mode === 'own' => Options::accounts($this->companyId, null, $this->from_account_id),
    $this->mode === 'return' => Options::agentAccounts($this->agentId, $this->from_account_id),
    (bool) $this->from_company_id => Options::accounts((int) $this->from_company_id, $this->mode === 'intercompany' ? 'bank' : null, $this->from_account_id),
    default => [],
});
$toAccounts = computed(function () {
    return match (true) {
        $this->mode === 'own' => Options::accounts($this->companyId, null, $this->to_account_id),
        $this->mode === 'advance' => Options::agentAccounts($this->agentId, $this->to_account_id),
        $this->mode === 'return' => $this->from_company_id ? Options::accounts((int) $this->from_company_id, null, $this->to_account_id) : [],
        default => $this->to_company_id ? Options::accounts((int) $this->to_company_id, 'bank', $this->to_account_id) : [],
    };
});

// Advance / return: what the agent owes this company right now (before this transfer).
$agentOwes = computed(function () {
    $accountId = match ($this->mode) { 'advance' => $this->to_account_id, 'return' => $this->from_account_id, default => null };
    $account = $accountId ? Account::with('agent')->find($accountId) : null;
    if (! $account?->agent_id || ! $this->from_company_id) {
        return null;
    }
    $owed = Balances::agentOwed($account->agent_id, (int) $this->from_company_id);
    if ($this->recordId && ($old = Transfer::find($this->recordId)) && $old->isAgentMove() && (int) $old->agentAccount()?->agent_id === $account->agent_id && $old->from_company_id == $this->from_company_id) {
        $owed = $old->isAdvance() ? Money::sub($owed, $old->amount) : Money::add($owed, $old->amount);
    }

    return ['owed' => $owed, 'agent' => $account->agent?->name, 'company' => Company::find($this->from_company_id)?->name];
});

// What the receiving company already owes the sending one (positive) — before this transfer.
$owed = computed(function () {
    if ($this->mode !== 'intercompany' || ! $this->from_company_id || ! $this->to_company_id || $this->from_company_id == $this->to_company_id) {
        return null;
    }
    $owed = Balances::owedBetween((int) $this->from_company_id, (int) $this->to_company_id);
    if ($this->recordId && ($old = Transfer::with(['fromAccount', 'toAccount'])->find($this->recordId)) && $old->isInterCompany()) {
        $owed = $old->from_company_id == $this->from_company_id ? Money::sub($owed, $old->amount) : Money::add($owed, $old->amount);
    }

    return ['owed' => $owed, 'from' => Company::find($this->from_company_id)?->name, 'to' => Company::find($this->to_company_id)?->name];
});

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->rows, $this->fromAccounts, $this->toAccounts, $this->owed, $this->agentOwes);
}]);

on(['transfer-create' => function (?int $companyId = null, ?string $mode = null, ?int $agentId = null) {
    $this->resetErrorBag();
    $this->recordId = null;
    $mode = in_array($mode, ['intercompany', 'advance', 'return'], true) ? $mode : 'own';
    $this->fill([
        'mode' => $mode, 'agentId' => $agentId, 'from_company_id' => $companyId ?? $this->companyId, 'from_account_id' => null,
        'to_company_id' => null, 'to_account_id' => null, 'amount' => '', 'date' => now()->toDateString(), 'reference' => '', 'notes' => '',
    ]);
    // One agent named: start on their cash in hand.
    if ($agentId && ($cash = Account::where('agent_id', $agentId)->cash()->value('id'))) {
        $this->fill([$mode === 'return' ? 'from_account_id' : 'to_account_id' => $cash]);
    }
    $this->showModal('transferModal');
}]);

$edit = function (int $id) {
    $this->resetErrorBag();
    $t = Transfer::with(['fromAccount', 'toAccount'])->findOrFail($id);
    $this->recordId = $t->id;
    $this->fill([
        'mode' => match (true) { $t->isAdvance() => 'advance', $t->isAgentReturn() => 'return', $t->isInterCompany() => 'intercompany', default => 'own' },
        'agentId' => null,
        'from_company_id' => $t->from_company_id, 'from_account_id' => $t->from_account_id,
        'to_company_id' => $t->isInterCompany() ? $t->to_company_id : null, 'to_account_id' => $t->to_account_id,
        'amount' => $t->amount, 'date' => $t->date->toDateString(), 'reference' => $t->reference ?? '', 'notes' => $t->notes ?? '',
    ]);
    $this->showModal('transferModal');
};

$save = function () {
    $data = $this->validate();
    $ok = $this->attempt(function () use ($data) {
        $t = app(TransferService::class)->save($this->recordId ? Transfer::findOrFail($this->recordId) : null, $data);
        $this->toast('success', $t->kind().' of '.money($t->amount).' saved.');
    });
    if ($ok !== false) {
        $this->hideModal('transferModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $t = Transfer::findOrFail($id);
    if ($this->attempt(fn () => app(TransferService::class)->delete($t)) !== false) {
        $this->toast('success', 'Transfer deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    @unless ($modalOnly)
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <select class="form-select form-select-sm w-auto" wire:model.live="filterKind" aria-label="Kind">
                <option value="">All transfers</option>
                <option value="own">Cash &amp; bank moves</option>
                <option value="intercompany">Between companies</option>
                <option value="agent">With agents</option>
            </select>
            @unless ($companyId)
                <div style="min-width:190px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
            @endunless
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
            <div class="ms-auto d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" wire:click="$dispatch('transfer-create', { mode: 'own' })"><i class="ri-arrow-left-right-line me-1"></i>Cash &amp; bank</button>
                <button type="button" class="btn btn-sm btn-info" wire:click="$dispatch('transfer-create', { mode: 'intercompany' })"><i class="ri-building-2-line me-1"></i>Between companies</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-success" wire:click="$dispatch('transfer-create', { mode: 'advance' })"><i class="ri-user-shared-line me-1"></i>Advance to agent</button>
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">More</span></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button type="button" class="dropdown-item" wire:click="$dispatch('transfer-create', { mode: 'return' })"><i class="ri-user-received-line me-1"></i>Return from agent</button></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Transfer</th><th class="d-none d-md-table-cell">Reference</th><th class="money">Amount</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $t)
                            <tr wire:key="tr-{{ $t->id }}">
                                <td class="fs-13 text-nowrap">{{ $t->date->format('d M Y') }}</td>
                                <td class="fs-13">
                                    <span class="badge {{ $t->isAgentMove() ? 'bg-success-subtle text-success' : ($t->isInterCompany() ? 'bg-info-subtle text-info' : 'bg-primary-subtle text-primary') }}">{{ $t->kind() }}</span>
                                    @if ($t->creator && $t->creator->isAgent())<span class="badge bg-light text-body ms-1" title="Sent by the agent, approved by {{ $t->decider?->name }}">by agent</span>@endif
                                    <div class="mt-1">
                                        @if ($t->isInterCompany())<span class="fw-medium">{{ $t->fromCompany?->name }}</span> · @endif{{ $t->fromAccount->isAgentAccount() || ($t->kind() === 'Cash deposit') ? $t->fromAccount->label() : $t->fromAccount->shortLabel() }}
                                        <i class="ri-arrow-right-line text-muted"></i>
                                        @if ($t->isInterCompany())<span class="fw-medium">{{ $t->toCompany?->name }}</span> · @endif{{ $t->toAccount->isAgentAccount() || ($t->kind() === 'Cash deposit') ? $t->toAccount->label() : $t->toAccount->shortLabel() }}
                                    </div>
                                    @if (! $t->isInterCompany() && ! $companyId && ($t->fromCompany ?? $t->toCompany))<div class="fs-12 text-muted">{{ ($t->fromCompany ?? $t->toCompany)->name }}</div>@endif
                                </td>
                                <td class="fs-13 d-none d-md-table-cell">{{ $t->reference ?: '—' }}</td>
                                <td class="money fw-semibold">{{ money($t->amount) }}</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $t->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete this transfer of '.money($t->amount).'?'), 'Delete').then(ok => ok && $wire.delete({{ $t->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="5" icon="ri-arrow-left-right-line" message="No transfers yet." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->rows->onEachSide(1)->links() }}</div>
    </div>
    @endunless

    <x-modal id="transferModal" :title="$recordId ? 'Edit Transfer' : 'New Transfer'" icon="ri-arrow-left-right-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="btn-group w-100 mb-3 flex-wrap" role="group" aria-label="Transfer type">
                    <input type="radio" class="btn-check" id="tr-own" value="own" wire:model.live="mode">
                    <label class="btn btn-outline-primary btn-sm" for="tr-own"><i class="ri-arrow-left-right-line me-1"></i>Cash &amp; bank</label>
                    <input type="radio" class="btn-check" id="tr-ic" value="intercompany" wire:model.live="mode">
                    <label class="btn btn-outline-info btn-sm" for="tr-ic"><i class="ri-building-2-line me-1"></i>Between companies</label>
                    <input type="radio" class="btn-check" id="tr-adv" value="advance" wire:model.live="mode">
                    <label class="btn btn-outline-success btn-sm" for="tr-adv"><i class="ri-user-shared-line me-1"></i>Advance to agent</label>
                    <input type="radio" class="btn-check" id="tr-ret" value="return" wire:model.live="mode">
                    <label class="btn btn-outline-success btn-sm" for="tr-ret"><i class="ri-user-received-line me-1"></i>Return from agent</label>
                </div>
                <p class="fs-13 text-muted">
                    {{ match ($mode) {
                        'own' => 'Bank → admin cash in hand (the money leaves the company: "moved to cash"), cash in hand → a bank (it comes into that bank’s company), or bank to bank. The cash in hand belongs to no company.',
                        'intercompany' => 'Money sent from one of your companies’ banks to another’s. The receiving company will owe the sender until it is sent back.',
                        'advance' => 'Money given to an agent (into their bank account or cash in hand) for a company. The agent owes it to that company until they return it or pay departments with it.',
                        default => 'Money an agent gives back to a company bank or your cash in hand. It lowers what the agent owes that company.',
                    } }}
                </p>

                <div class="row g-3">
                    @if ($mode === 'return')
                        <div class="col-12">
                            <label class="form-label">From agent account <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model.live="from_account_id" :options="$this->fromAccounts" placeholder="Agent · account" :invalid="$errors->has('from_account_id')" />
                            @error('from_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    @endif
                    @if ($mode !== 'own')
                    <div class="{{ in_array($mode, ['advance', 'return'], true) ? 'col-12' : 'col-md-6' }}">
                        <label class="form-label">{{ match ($mode) { 'advance' => 'For company', 'return' => 'Company the money goes back to', default => 'From company' } }} <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="from_company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('from_company_id')" />
                        @error('from_company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    @endif
                    @if ($mode === 'intercompany')
                        <div class="col-md-6">
                            <label class="form-label">To company <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model.live="to_company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('to_company_id')" />
                            @error('to_company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    @endif
                    @if ($mode !== 'return')
                        <div class="col-md-6">
                            <label class="form-label">From account <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model.live="from_account_id" :options="$this->fromAccounts" :placeholder="$from_company_id || $mode === 'own' ? 'Money leaves…' : 'Select a company first'" :disabled="! $from_company_id && $mode !== 'own'" :invalid="$errors->has('from_account_id')" />
                            @error('from_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    @endif
                    <div class="{{ $mode === 'return' ? 'col-12' : 'col-md-6' }}">
                        <label class="form-label">{{ $mode === 'advance' ? 'To agent account' : 'To account' }} <span class="text-danger">*</span></label>
                        @php($toReady = match ($mode) { 'return' => $from_company_id, 'own', 'advance' => true, default => $to_company_id })
                        <x-searchable-select wire:model.live="to_account_id" :options="$this->toAccounts" :placeholder="$toReady ? ($mode === 'advance' ? 'Agent · account' : 'Money arrives…') : 'Select a company first'" :disabled="! $toReady" :invalid="$errors->has('to_account_id')" />
                        @error('to_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    @if ($a = $this->agentOwes)
                        <div class="col-12">
                            <div class="alert alert-light border py-2 mb-0 fs-13 ams-balance">
                                <i class="ri-user-star-line me-1"></i>
                                @if (Money::isPositive($a['owed']))
                                    {{ $a['agent'] }} owes {{ $a['company'] }} <strong>{{ money($a['owed']) }}</strong> right now.
                                @else
                                    {{ $a['agent'] }} owes {{ $a['company'] }} nothing right now.
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($o = $this->owed)
                        <div class="col-12">
                            <div class="alert alert-light border py-2 mb-0 fs-13 ams-balance">
                                <i class="ri-scales-3-line me-1"></i>
                                @if (Money::isPositive($o['owed']))
                                    {{ $o['to'] }} already owes {{ $o['from'] }} <strong>{{ money($o['owed']) }}</strong>.
                                @elseif (Money::isNegative($o['owed']))
                                    {{ $o['from'] }} owes {{ $o['to'] }} <strong>{{ money(Money::sub(0, $o['owed'])) }}</strong> — this transfer pays it back.
                                @else
                                    Nothing is owed between {{ $o['from'] }} and {{ $o['to'] }} right now.
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="col-md-4">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model="amount" placeholder="0.00">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Reference</label>
                        <input type="text" class="form-control" wire:model="reference" placeholder="ATM slip / IBFT ID">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save"><i class="ri-save-3-line me-1"></i>Save transfer</button>
            </div>
        </form>
    </x-modal>
</div>
