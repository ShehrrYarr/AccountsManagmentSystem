<?php

/**
 * Internal transfers between my own accounts (e.g. withdraw cash from bank into the vault).
 */

use App\Enums\ApprovalStatus;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\BankAccount;
use App\Models\InternalTransfer;
use App\Services\InternalTransferService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, rules, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['transferId' => null])->locked();
state([
    'from_account_id' => null,
    'to_account_id' => null,
    'amount' => '',
    'date' => '',
    'reference' => '',
    'notes' => '',
    'search' => '',
]);

rules([
    'from_account_id' => ['required', 'exists:bank_accounts,id'],
    'to_account_id' => ['required', 'different:from_account_id', 'exists:bank_accounts,id'],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'reference' => ['nullable', 'string', 'max:255'],
    'notes' => ['nullable', 'string', 'max:1000'],
])->messages(['to_account_id.different' => 'Choose a different account to transfer into.']);

$accountOptions = computed(fn () => Options::bankAccounts());

$fromAccount = computed(fn () => $this->from_account_id ? BankAccount::find($this->from_account_id) : null);

$transfers = computed(fn () => InternalTransfer::query()
    ->with(['fromAccount', 'toAccount', 'creator', 'approvalRequests' => fn ($q) => $q->where('status', ApprovalStatus::Pending)])
    ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('reference', 'like', "%{$this->search}%")->orWhere('notes', 'like', "%{$this->search}%")))
    ->latest('date')->latest('id')
    ->paginate(15));

$updatedSearch = fn () => $this->resetPage();

on(['transaction-updated' => function () {
    unset($this->transfers, $this->accountOptions, $this->fromAccount);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->fill(['from_account_id' => null, 'to_account_id' => null, 'amount' => '', 'reference' => '', 'notes' => '']);
    $this->transferId = null;
    $this->date = now()->toDateString();
    $this->showModal('transferModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $t = InternalTransfer::findOrFail($id);
    $this->transferId = $t->id;
    $this->fill($t->only(['from_account_id', 'to_account_id', 'amount', 'reference', 'notes']) + ['date' => $t->date->toDateString()]);
    $this->showModal('transferModal');
};

$swap = function () {
    [$this->from_account_id, $this->to_account_id] = [$this->to_account_id, $this->from_account_id];
};

$save = function () {
    $data = $this->validate();
    $service = app(InternalTransferService::class);

    $ok = $this->attempt(function () use ($service, $data) {
        if ($this->transferId) {
            $outcome = $service->update(InternalTransfer::findOrFail($this->transferId), $data, auth()->user());
            $this->toastOutcome($outcome, 'Transfer updated.', 'Your edit');
        } else {
            $t = $service->create($data, auth()->user());
            $this->toast('success', 'Moved '.money($t->amount)." from {$t->fromAccount->name} to {$t->toAccount->name}.");
        }
    });

    if ($ok !== false) {
        $this->hideModal('transferModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $ok = $this->attempt(function () use ($id) {
        $outcome = app(InternalTransferService::class)->delete(InternalTransfer::findOrFail($id), auth()->user());
        $this->toastOutcome($outcome, 'Transfer deleted.', 'The delete request');
    });
    if ($ok !== false) {
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <h5 class="card-title mb-0 me-auto">Transfers between my accounts</h5>
            <input type="search" class="form-control form-control-sm w-auto" placeholder="Search reference / notes" wire:model.live.debounce.350ms="search">
            <button type="button" class="btn btn-sm btn-primary" wire:click="create"><i class="ri-arrow-left-right-line me-1"></i>New Transfer</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Date</th><th>From</th><th></th><th>To</th><th class="money">Amount</th><th>Reference</th><th>By</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->transfers as $t)
                            @php($pendingReq = $t->approvalRequests->first())
                            <tr wire:key="tr-{{ $t->id }}">
                                <td class="fs-13">{{ $t->date->format('d M Y') }}</td>
                                <td>{{ $t->fromAccount->name }}</td>
                                <td class="text-muted"><i class="ri-arrow-right-line"></i></td>
                                <td>{{ $t->toAccount->name }}</td>
                                <td class="money fw-semibold">{{ money($t->amount) }}</td>
                                <td class="fs-13">{{ $t->reference ?? '—' }} @if ($t->notes)<div class="fs-11 text-muted">{{ $t->notes }}</div>@endif</td>
                                <td class="fs-13">{{ $t->creator?->name }}</td>
                                <td class="text-end text-nowrap">
                                    @if ($pendingReq)
                                        <span class="badge bg-info-subtle text-info"><i class="ri-hourglass-line"></i> {{ $pendingReq->action->label() }} pending</span>
                                    @else
                                        <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $t->id }})" title="Edit"><i class="ri-edit-line"></i></button>
                                        <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                            x-on:click="amsConfirm('Delete this transfer of {{ money($t->amount) }}?', 'Delete').then(ok => ok && $wire.delete({{ $t->id }}))"><i class="ri-delete-bin-line"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="8" icon="ri-arrow-left-right-line" message="No internal transfers yet." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->transfers->links() }}</div>
    </div>

    <x-modal id="transferModal" :title="$transferId ? 'Edit Transfer' : 'Move Money Between My Accounts'" icon="ri-arrow-left-right-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <div class="mb-3">
                    <label class="form-label">From <span class="text-danger">*</span></label>
                    <x-searchable-select wire:model.live="from_account_id" :options="$this->accountOptions" placeholder="Source account" :invalid="$errors->has('from_account_id')" />
                    @error('from_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="text-center my-2">
                    <button type="button" class="btn btn-sm btn-light rounded-circle icon-btn-sm" wire:click="swap" title="Swap"><i class="ri-arrow-up-down-line"></i></button>
                </div>
                <div class="mb-3">
                    <label class="form-label">To <span class="text-danger">*</span></label>
                    <x-searchable-select wire:model.live="to_account_id" :options="$this->accountOptions" placeholder="Destination account" :invalid="$errors->has('to_account_id')" />
                    @error('to_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model.live.debounce.400ms="amount">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($this->fromAccount)
                            <div class="form-text">Available: {{ money($this->fromAccount->current_balance) }}</div>
                        @endif
                    </div>
                    <div class="col-6">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Reference</label>
                        <input type="text" class="form-control" wire:model="reference" placeholder="Cheque # / withdrawal slip">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                    </div>
                </div>
                @if ($transferId && auth()->user()->needsApproval())
                    <div class="alert alert-info fs-13 mt-3 mb-0">Edits by staff are applied after admin approval.</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Save transfer</button>
            </div>
        </form>
    </x-modal>
</div>
