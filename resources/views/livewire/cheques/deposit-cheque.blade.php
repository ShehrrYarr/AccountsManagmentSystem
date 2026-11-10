<?php

/**
 * Deposit a cheque into one of the same company's bank accounts (one step: deposited = cleared).
 * Also edits an existing deposit.
 *
 * Open with: $dispatch('cheque-deposit', { id: 12 })
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Cheque;
use App\Services\ChequeService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['chequeId' => null])->locked();
state(['deposit_account_id' => null, 'deposited_date' => '', 'bank_charges' => '', 'deposit_reference' => '']);

rules(fn () => [
    'deposit_account_id' => ['required', 'exists:accounts,id'],
    'deposited_date' => ['required', 'date', 'before_or_equal:today'],
    'bank_charges' => ['nullable', 'numeric', 'min:0'],
    'deposit_reference' => ['nullable', 'string', 'max:255'],
])->messages(['deposit_account_id.required' => 'Choose the bank account the cheque was deposited into.']);

$cheque = computed(fn () => $this->chequeId ? Cheque::with(['company', 'department'])->find($this->chequeId) : null);

$bankOptions = computed(fn () => $this->cheque ? Options::accounts($this->cheque->company_id, 'bank', $this->cheque->deposit_account_id) : []);

$net = computed(fn () => $this->cheque ? Money::sub($this->cheque->amount, is_numeric($this->bank_charges) ? $this->bank_charges : 0) : null);

on(['cheque-deposit' => function (int $id) {
    $this->resetErrorBag();
    $this->chequeId = $id;
    unset($this->cheque, $this->bankOptions);
    $c = $this->cheque;
    $this->fill([
        'deposit_account_id' => $c->deposit_account_id ?? (count($this->bankOptions) === 1 ? $this->bankOptions[0]['value'] : null),
        'deposited_date' => $c->deposited_date?->toDateString() ?? now()->toDateString(),
        'bank_charges' => $c->isDeposited() && Money::isPositive($c->bank_charges) ? $c->bank_charges : '',
        'deposit_reference' => $c->deposit_reference ?? '',
    ]);
    $this->showModal('chequeDepositModal');
}]);

$save = function () {
    $data = $this->validate();
    $cheque = Cheque::findOrFail($this->chequeId);

    $ok = $this->attempt(function () use ($cheque, $data) {
        $cheque = app(ChequeService::class)->deposit($cheque, $data);
        $this->toast('success', "Cheque #{$cheque->cheque_number}: ".money($cheque->netDeposit()).' now in '.$cheque->depositAccount->shortLabel().'.');
    });

    if ($ok !== false) {
        $this->hideModal('chequeDepositModal');
        $this->broadcastChange();
    }
};

?>

<div>
    <x-modal id="chequeDepositModal" :title="$this->cheque?->isDeposited() ? 'Edit Deposit' : 'Deposit Cheque'" icon="ri-bank-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                @if ($c = $this->cheque)
                    <div class="d-flex justify-content-between align-items-start p-3 rounded bg-body-tertiary mb-3">
                        <div>
                            <div class="fw-semibold">#{{ $c->cheque_number }} · {{ $c->issuing_bank }}</div>
                            <div class="fs-13 text-muted">{{ $c->department->name }} → {{ $c->company->name }}</div>
                            <div class="fs-12 text-muted">Received {{ $c->received_date->format('d M Y') }} · valid until {{ $c->expiry_date->format('d M Y') }}</div>
                        </div>
                        <div class="fs-5 fw-semibold text-nowrap">{{ money($c->amount) }}</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Deposited into <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="deposit_account_id" :options="$this->bankOptions" placeholder="{{ count($this->bankOptions) ? 'Select '.$c->company->name.' bank account' : 'This company has no bank account yet' }}" :invalid="$errors->has('deposit_account_id')" />
                            @error('deposit_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            @if (! count($this->bankOptions))
                                <div class="form-text"><a href="{{ route('accounts.index') }}">Add a bank account</a> for {{ $c->company->name }} first.</div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Deposit date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('deposited_date') is-invalid @enderror" wire:model="deposited_date" min="{{ $c->received_date->toDateString() }}" max="{{ now()->toDateString() }}">
                            @error('deposited_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Bank charges</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">Rs.</span>
                                <input type="number" step="0.01" min="0" class="form-control @error('bank_charges') is-invalid @enderror" wire:model.live.debounce.400ms="bank_charges" placeholder="0.00">
                                @error('bank_charges') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deposit slip / bank reference</label>
                            <input type="text" class="form-control" wire:model="deposit_reference" placeholder="Optional">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-top mt-3 pt-3 fs-14">
                        <span class="text-muted">Amount reaching the bank</span>
                        <strong class="text-success ams-balance">{{ money($this->net) }}</strong>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="save">
                    <i class="ri-checkbox-circle-line me-1"></i>{{ $this->cheque?->isDeposited() ? 'Save deposit' : 'Deposit' }}
                </button>
            </div>
        </form>
    </x-modal>
</div>
