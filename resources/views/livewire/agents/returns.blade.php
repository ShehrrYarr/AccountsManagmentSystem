<?php

/**
 * Money an agent sends back to a company. The agent records it here; it waits for the admin's
 * approval and only then counts. The admin sees the same list (read-only) on the agent's page.
 *
 * Open the form with: $dispatch('agent-return-create')
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

state(['agentId' => null])->locked();
state(['from_account_id' => null, 'from_company_id' => null, 'to_account_id' => null, 'amount' => '', 'date' => '', 'reference' => '', 'notes' => '']);

mount(function (int $agentId) {
    abort_unless(auth()->user()->isAdmin() || auth()->id() === $agentId, 403);
    $this->agentId = $agentId;
});

rules(fn () => [
    'from_account_id' => ['required', 'exists:accounts,id'],
    'from_company_id' => ['required', 'exists:companies,id'],
    'to_account_id' => ['required', 'exists:accounts,id'],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'reference' => ['nullable', 'string', 'max:255'],
    'notes' => ['nullable', 'string', 'max:2000'],
])->messages([
    'from_account_id.required' => 'Choose the account the money leaves.',
    'from_company_id.required' => 'Choose the company the money goes back to.',
    'to_account_id.required' => 'Choose where the money goes.',
])->attributes(['from_company_id' => 'company']);

$isAgent = computed(fn () => auth()->id() === $this->agentId);

// Every advance and return of this agent, including returns waiting for (or refused) approval.
$rows = computed(fn () => Transfer::query()->forAgent($this->agentId)
    ->with(['fromAccount', 'toAccount', 'fromCompany', 'decider'])
    ->orderByRaw("status = 'pending' desc")->orderByDesc('date')->orderByDesc('id')
    ->paginate(10, pageName: 'retPage'));

$myAccounts = computed(fn () => Options::agentAccounts($this->agentId, $this->from_account_id));
$companyOptions = computed(fn () => Options::companies());
$toAccounts = computed(fn () => $this->from_company_id ? Options::accounts((int) $this->from_company_id, null, $this->to_account_id) : []);
$owes = computed(fn () => $this->from_company_id ? Balances::agentOwed($this->agentId, (int) $this->from_company_id) : null);

$updated = function ($property) {
    if ($property === 'from_company_id') {
        $this->to_account_id = null;
    }
};

on(['transaction-updated' => function () {
    unset($this->rows, $this->myAccounts, $this->owes);
}, 'approval-updated' => function () {
    unset($this->rows);
}]);

on(['agent-return-create' => function () {
    abort_unless($this->isAgent, 403);
    $this->resetErrorBag();
    $this->fill([
        'from_account_id' => Account::where('agent_id', $this->agentId)->cash()->value('id'), 'from_company_id' => null, 'to_account_id' => null,
        'amount' => '', 'date' => now()->toDateString(), 'reference' => '', 'notes' => '',
    ]);
    // Only one company owes anything: start there.
    $owing = Balances::agents(null, $this->agentId)->filter(fn ($r) => Money::isPositive($r->owed));
    if ($owing->count() === 1) {
        $this->from_company_id = $owing->first()->company_id;
    }
    $this->showModal('returnModal');
}]);

$save = function () {
    abort_unless($this->isAgent, 403);
    $data = $this->validate();
    $ok = $this->attempt(function () use ($data) {
        $t = app(TransferService::class)->requestReturn($data, auth()->user());
        $this->toast('success', 'Return of '.money($t->amount).' sent to the admin for approval.');
    });
    if ($ok !== false) {
        $this->hideModal('returnModal');
        unset($this->rows);
        $this->dispatch('approval-updated');
    }
};

$withdraw = function (int $id) {
    abort_unless($this->isAgent, 403);
    $t = Transfer::forAgent($this->agentId)->findOrFail($id);
    if ($this->attempt(fn () => app(TransferService::class)->withdraw($t, auth()->user())) !== false) {
        $this->toast('success', 'Return withdrawn.');
        unset($this->rows);
        $this->dispatch('approval-updated');
    }
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <h5 class="card-title mb-0 me-auto">{{ $this->isAgent ? 'My returns & advances' : 'Advances & returns' }}</h5>
            @if ($this->isAgent)
                <button type="button" class="btn btn-sm btn-success" wire:click="$dispatch('agent-return-create')"><i class="ri-user-received-line me-1"></i>Return money</button>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 ams-table fs-13">
                <thead class="table-light"><tr><th>Date</th><th>Movement</th><th class="d-none d-md-table-cell">Company</th><th class="money">Amount</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse ($this->rows as $t)
                        <tr wire:key="ret-{{ $t->id }}">
                            <td class="text-nowrap">{{ $t->date->format('d M Y') }}</td>
                            <td>
                                <span class="badge {{ $t->isAdvance() ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info' }}">{{ $t->isAdvance() ? 'Received' : 'Returned' }}</span>
                                {{ $t->fromAccount?->shortLabel() }} <i class="ri-arrow-right-line text-muted"></i> {{ $t->toAccount?->shortLabel() }}
                                @if ($t->reference)<div class="fs-11 text-muted">Ref {{ $t->reference }}</div>@endif
                            </td>
                            <td class="d-none d-md-table-cell">{{ $t->fromCompany?->name }}</td>
                            <td class="money fw-semibold">{{ money($t->amount) }}</td>
                            <td class="text-nowrap">
                                @if ($t->isPending())
                                    <span class="badge bg-warning-subtle text-warning">Waiting for approval</span>
                                    @if ($this->isAgent)
                                        <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-1 fs-12"
                                            x-on:click="amsConfirm(@js('Withdraw this return of '.money($t->amount).'?'), 'Withdraw').then(ok => ok && $wire.withdraw({{ $t->id }}))">Withdraw</button>
                                    @endif
                                @elseif ($t->status === Transfer::REJECTED)
                                    <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                    @if ($t->decision_note)<div class="fs-11 text-muted">“{{ $t->decision_note }}”</div>@endif
                                @else
                                    <span class="badge bg-success-subtle text-success">{{ $t->decided_at ? 'Approved' : 'Recorded' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <x-empty-row :colspan="5" icon="ri-exchange-funds-line" message="No advances or returns yet." />
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($this->rows->hasPages())
            <div class="card-footer">{{ $this->rows->onEachSide(1)->links() }}</div>
        @endif
    </div>

    @if ($this->isAgent)
        <x-modal id="returnModal" title="Return Money" icon="ri-user-received-line" size="lg">
            <form wire:submit="save">
                <div class="modal-body">
                    <p class="fs-13 text-muted">Money you give back to a company. It waits for the admin's approval, then lowers what you owe that company.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">From my account <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="from_account_id" :options="$this->myAccounts" placeholder="Select account" :invalid="$errors->has('from_account_id')" />
                            @error('from_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model.live="from_company_id" :options="$this->companyOptions" placeholder="Whose money" :invalid="$errors->has('from_company_id')" />
                            @error('from_company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">To <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="to_account_id" :options="$this->toAccounts" :placeholder="$from_company_id ? 'Company bank or admin cash in hand' : 'Select a company first'" :disabled="! $from_company_id" :invalid="$errors->has('to_account_id')" />
                            @error('to_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        @if ($this->owes !== null)
                            <div class="col-12">
                                <div class="alert alert-light border py-2 mb-0 fs-13"><i class="ri-scales-3-line me-1"></i>You owe this company <strong>{{ money($this->owes) }}</strong>.</div>
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
                            <input type="text" class="form-control" wire:model="reference" placeholder="Slip / IBFT ID">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="save"><i class="ri-send-plane-line me-1"></i>Send for approval</button>
                </div>
            </form>
        </x-modal>
    @endif
</div>
