<?php

/**
 * Stage 2: clear a pending cheque.
 *   Option A — Bank Deposit into one of my bank accounts
 *   Option B — Over-the-counter Encashment into the Cash Vault
 * Commission (typed per cheque) and bank charges are previewed live.
 *
 * Open with:  $dispatch('cheque-clear', { id: 12 })
 */

use App\Enums\BankAccountType;
use App\Enums\ClearingMethod;
use App\Enums\CommissionType;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\BankAccount;
use App\Models\Cheque;
use App\Services\ChequeService;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['chequeId' => null])->locked();

state([
    'clearing_method' => 'deposit',
    'cleared_into_account_id' => null,
    'cleared_date' => '',
    'commission_type' => '',
    'commission_rate' => '',
    'bank_charges' => '',
    'clearing_reference' => '',
]);

rules(fn () => [
    'clearing_method' => ['required', Rule::enum(ClearingMethod::class)],
    'cleared_into_account_id' => [Rule::requiredIf($this->clearing_method === 'deposit'), 'nullable', 'exists:bank_accounts,id'],
    'cleared_date' => ['required', 'date', 'before_or_equal:today'],
    'commission_type' => ['nullable', Rule::enum(CommissionType::class)],
    'commission_rate' => [Rule::requiredIf(filled($this->commission_type)), 'nullable', 'numeric', 'min:0'],
    'bank_charges' => ['nullable', 'numeric', 'min:0'],
    'clearing_reference' => ['nullable', 'string', 'max:255'],
])->messages([
    'cleared_into_account_id.required' => 'Choose the bank account you deposited into.',
]);

$cheque = computed(fn () => $this->chequeId ? Cheque::with('company', 'department')->find($this->chequeId) : null);
$bankOptions = computed(fn () => Options::bankAccounts('bank'));
$vault = computed(fn () => BankAccount::vault());

/** Live preview of how the cheque will be split. */
$preview = computed(function () {
    $cheque = $this->cheque;
    if (! $cheque) {
        return null;
    }

    $amount = Money::of($cheque->amount);
    $rate = is_numeric($this->commission_rate) ? $this->commission_rate : 0;
    $commission = match ($this->commission_type) {
        'percent' => Money::percent($amount, $rate),
        'fixed' => Money::of($rate),
        default => '0.00',
    };
    $charges = is_numeric($this->bank_charges) ? Money::of($this->bank_charges) : '0.00';

    $account = $this->clearing_method === 'encashment' ? $this->vault : BankAccount::find($this->cleared_into_account_id);

    return [
        'amount' => $amount,
        'commission' => $commission,
        'charges' => $charges,
        'toCompany' => Money::sub($amount, $commission),
        'toAccount' => Money::sub($amount, $charges),
        'account' => $account,
        'accountAfter' => $account ? Money::add($account->current_balance, Money::sub($amount, $charges)) : null,
        'payableAfter' => Money::add($cheque->company->payable_balance, Money::sub($amount, $commission)),
        'invalid' => Money::cmp($commission, $amount) > 0 || Money::cmp($charges, $amount) >= 0,
    ];
});

on(['cheque-clear' => function (int $id) {
    $this->resetErrorBag();
    $this->fill(['commission_type' => '', 'commission_rate' => '', 'bank_charges' => '', 'clearing_reference' => '', 'cleared_into_account_id' => null]);
    $this->chequeId = $id;
    $this->clearing_method = 'deposit';
    $this->cleared_date = now()->toDateString();
    // Pre-select the only bank account, if there is just one.
    $banks = BankAccount::active()->banks()->pluck('id');
    $this->cleared_into_account_id = $banks->count() === 1 ? $banks->first() : null;
    unset($this->cheque);
    $this->showModal('clearChequeModal');
}]);

$setMethod = function (string $method) {
    $this->clearing_method = ClearingMethod::from($method)->value;
    $this->resetErrorBag('cleared_into_account_id');
};

$save = function () {
    $data = $this->validate();
    $data['cleared_into_account_id'] = $this->clearing_method === 'encashment' ? $this->vault?->id : $data['cleared_into_account_id'];

    $cheque = Cheque::findOrFail($this->chequeId);

    $ok = $this->attempt(function () use ($cheque, $data) {
        $outcome = app(ChequeService::class)->clear($cheque, $data, auth()->user());
        $this->toastOutcome($outcome, "Cheque #{$cheque->cheque_number} cleared — ".money($this->preview['toCompany'])." credited to {$cheque->company->name}.", 'Clearing');
    });

    if ($ok !== false) {
        $this->hideModal('clearChequeModal');
        $this->broadcastChange();
    }
};

?>

<div>
    <x-modal id="clearChequeModal" title="Clear Cheque" icon="ri-checkbox-circle-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                @if ($this->cheque)
                    @php($c = $this->cheque)
                    <div class="p-3 rounded-3 bg-body-tertiary border mb-4 d-flex flex-wrap gap-4 align-items-center">
                        <div>
                            <div class="fs-12 text-muted">Cheque</div>
                            <div class="fw-semibold">#{{ $c->cheque_number }} · {{ $c->issuing_bank }}</div>
                        </div>
                        <div>
                            <div class="fs-12 text-muted">Company</div>
                            <div class="fw-semibold">{{ $c->company->name }}</div>
                        </div>
                        <div>
                            <div class="fs-12 text-muted">Amount</div>
                            <div class="fw-semibold fs-16 text-primary">{{ money($c->amount) }}</div>
                        </div>
                        <div>
                            <div class="fs-12 text-muted">Valid until</div>
                            <div class="fw-semibold {{ $c->isExpired() ? 'text-danger' : ($c->isNearExpiry() ? 'text-warning' : '') }}">{{ $c->expiry_date->format('d M Y') }}</div>
                        </div>
                    </div>

                    @if ($c->isExpired())
                        <div class="alert alert-warning fs-13"><i class="ri-error-warning-line me-1"></i>This cheque passed its 6-month validity date. Make sure the bank will still honour it.</div>
                    @endif

                    @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror

                    <label class="form-label">How was the cheque cleared?</label>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="ams-choice {{ $clearing_method === 'deposit' ? 'active' : '' }}" wire:click="setMethod('deposit')" role="button">
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="ri-bank-line text-primary"></i>
                                    <div>
                                        <div class="fw-semibold">Option A — Bank Deposit</div>
                                        <div class="fs-12 text-muted">Deposited into one of my bank accounts</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ams-choice {{ $clearing_method === 'encashment' ? 'active' : '' }}" wire:click="setMethod('encashment')" role="button">
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="ri-safe-2-line text-success"></i>
                                    <div>
                                        <div class="fw-semibold">Option B — Over-the-Counter Cash</div>
                                        <div class="fs-12 text-muted">Encashed at the bank into the Cash Vault</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        @if ($clearing_method === 'deposit')
                            <div class="col-md-8" wire:key="deposit-account">
                                <label class="form-label">Deposit into <span class="text-danger">*</span></label>
                                <x-searchable-select wire:model.live="cleared_into_account_id" :options="$this->bankOptions" placeholder="Select my bank account" :invalid="$errors->has('cleared_into_account_id')" :clearable="false" />
                                @error('cleared_into_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <div class="col-md-8" wire:key="vault-account">
                                <label class="form-label">Cash goes to</label>
                                @if ($this->vault)
                                    <div class="form-control bg-body-tertiary"><i class="ri-safe-2-line me-1"></i>{{ $this->vault->name }} <span class="text-muted">· {{ money($this->vault->current_balance) }}</span></div>
                                @else
                                    <div class="alert alert-danger mb-0 py-2 fs-13">No Cash Vault exists yet. Create it under My Accounts.</div>
                                @endif
                                @error('clearing_method') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        @endif
                        <div class="col-md-4">
                            <label class="form-label">Cleared on <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('cleared_date') is-invalid @enderror" wire:model="cleared_date" max="{{ now()->toDateString() }}" min="{{ $c->received_date->toDateString() }}">
                            @error('cleared_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">My commission</label>
                            <select class="form-select" wire:model.live="commission_type">
                                <option value="">No commission</option>
                                @foreach (\App\Enums\CommissionType::cases() as $t)
                                    <option value="{{ $t->value }}">{{ $t->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ $commission_type === 'percent' ? 'Rate (%)' : 'Commission (Rs.)' }}</label>
                            <input type="number" step="0.01" min="0" class="form-control @error('commission_rate') is-invalid @enderror"
                                wire:model.live.debounce.400ms="commission_rate" @disabled(! $commission_type) placeholder="{{ $commission_type === 'percent' ? 'e.g. 2.5' : '0.00' }}">
                            @error('commission_rate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bank charges (Rs.)</label>
                            <input type="number" step="0.01" min="0" class="form-control @error('bank_charges') is-invalid @enderror" wire:model.live.debounce.400ms="bank_charges" placeholder="0.00">
                            @error('bank_charges') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deposit slip / bank reference</label>
                            <input type="text" class="form-control" wire:model="clearing_reference" placeholder="Optional">
                        </div>
                    </div>

                    @if ($p = $this->preview)
                        <div class="table-responsive mt-4">
                            <table class="table table-sm align-middle mb-0 border {{ $p['invalid'] ? 'border-danger' : '' }}">
                                <tbody class="fs-13">
                                    <tr><td>Cheque amount</td><td class="text-end fw-medium">{{ money($p['amount']) }}</td></tr>
                                    <tr><td>Less my commission <span class="text-muted">(income)</span></td><td class="text-end text-danger">− {{ money($p['commission']) }}</td></tr>
                                    <tr class="table-light"><td class="fw-semibold">Credited to {{ $c->company->name }}</td><td class="text-end fw-semibold text-success">{{ money($p['toCompany']) }}</td></tr>
                                    <tr><td>Less bank charges <span class="text-muted">(expense)</span></td><td class="text-end text-danger">− {{ money($p['charges']) }}</td></tr>
                                    <tr class="table-light"><td class="fw-semibold">Received into {{ $p['account']?->name ?? '—' }}</td><td class="text-end fw-semibold text-primary">{{ money($p['toAccount']) }}</td></tr>
                                    <tr class="text-muted">
                                        <td>Balances after</td>
                                        <td class="text-end">
                                            Company payable {{ money($p['payableAfter']) }}
                                            @if ($p['accountAfter'] !== null) · {{ $p['account']->name }} {{ money($p['accountAfter']) }} @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if (auth()->user()->needsApproval())
                        <div class="alert alert-info mt-3 mb-0 fs-13"><i class="ri-information-line me-1"></i>Clearing will be sent to an administrator for approval before balances change.</div>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="save" @disabled($this->preview['invalid'] ?? false)>
                    <span wire:loading.remove wire:target="save"><i class="ri-checkbox-circle-line me-1"></i>{{ auth()->user()->needsApproval() ? 'Submit for approval' : 'Confirm clearing' }}</span>
                    <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </form>
    </x-modal>
</div>
