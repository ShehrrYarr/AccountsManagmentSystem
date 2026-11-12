<?php

/**
 * Enter a government cheque for a department: it is deposited into the company's bank in the
 * same step. Also used to edit one.
 *
 * Open with:  $dispatch('cheque-create')  or  $dispatch('cheque-create', { companyId: 5, departmentId: 2 })
 *             $dispatch('cheque-edit', { id: 12 })
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Cheque;
use App\Models\Department;
use App\Services\Balances;
use App\Services\ChequeService;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class]);
usesFileUploads();

state(['chequeId' => null])->locked();

state([
    'company_id' => null,
    'department_id' => null,
    'cheque_number' => '',
    'issuing_bank' => '',
    'issuing_branch' => '',
    'amount' => '',
    'cheque_date' => '',
    'date' => '',
    'deposit_account_id' => null,
    'bank_charges' => '',
    'deposit_reference' => '',
    'notes' => '',
    'scan' => null,
    'existingScan' => false,
    'newDepartment' => '',
    'addingDepartment' => false,
]);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'department_id' => ['required', 'exists:departments,id'],
    'cheque_number' => [
        'required', 'string', 'max:50',
        Rule::unique('cheques')->where('issuing_bank', $this->issuing_bank)->whereNull('deleted_at')->ignore($this->chequeId),
    ],
    'issuing_bank' => ['required', 'string', 'max:255'],
    'issuing_branch' => ['nullable', 'string', 'max:255'],
    'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
    'cheque_date' => ['required', 'date'],
    'date' => ['required', 'date', 'after_or_equal:cheque_date', 'before_or_equal:today'],
    'deposit_account_id' => ['required', 'exists:accounts,id'],
    'bank_charges' => ['nullable', 'numeric', 'min:0'],
    'deposit_reference' => ['nullable', 'string', 'max:255'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'scan' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
])->messages([
    'cheque_number.unique' => 'This cheque number is already entered for that issuing bank.',
    'date.after_or_equal' => 'A cheque cannot be deposited before its cheque date.',
    'department_id.required' => 'Choose the department this cheque is for.',
    'deposit_account_id.required' => 'Choose the bank account it was deposited into.',
]);

$companyOptions = computed(fn () => Options::companies($this->company_id));
$departmentOptions = computed(fn () => Options::departments($this->department_id));
$bankOptions = computed(fn () => $this->company_id ? Options::accounts((int) $this->company_id, 'bank', $this->deposit_account_id) : []);

// Where the department stands with this company before this cheque.
$position = computed(function () {
    if (! $this->company_id || ! $this->department_id) {
        return null;
    }
    $balance = Balances::departmentBalance((int) $this->department_id, (int) $this->company_id);
    if ($this->chequeId && ($old = Cheque::find($this->chequeId)) && $old->company_id == $this->company_id && $old->department_id == $this->department_id) {
        $balance = Money::add($balance, $old->amount); // show it without the cheque being edited
    }

    return $balance;
});

$expiry = computed(function () {
    if (! $this->cheque_date || strtotime($this->cheque_date) === false) {
        return null;
    }
    $expiry = Cheque::expiryFor($this->cheque_date);
    $on = $this->date && strtotime($this->date) !== false ? \Illuminate\Support\Carbon::parse($this->date) : now();

    return ['date' => $expiry, 'expired' => $on->startOfDay()->gt($expiry)];
});

$net = computed(fn () => is_numeric($this->amount) ? Money::sub($this->amount, is_numeric($this->bank_charges) ? $this->bank_charges : 0) : null);

$updatedCompanyId = function () {
    unset($this->bankOptions);
    $this->deposit_account_id = count($this->bankOptions) === 1 ? $this->bankOptions[0]['value'] : null;
};

$resetForm = function () {
    $this->fill([
        'company_id' => null, 'department_id' => null, 'cheque_number' => '', 'issuing_bank' => '', 'issuing_branch' => '',
        'amount' => '', 'deposit_account_id' => null, 'bank_charges' => '', 'deposit_reference' => '', 'notes' => '',
        'scan' => null, 'existingScan' => false, 'newDepartment' => '', 'addingDepartment' => false,
    ]);
    $this->chequeId = null;
    $this->cheque_date = now()->toDateString();
    $this->date = now()->toDateString();
    $this->resetErrorBag();
};

on(['cheque-create' => function (?int $companyId = null, ?int $departmentId = null) {
    $this->resetForm();
    $this->company_id = $companyId;
    $this->department_id = $departmentId;
    if ($companyId) {
        $this->updatedCompanyId();
    }
    $this->showModal('chequeFormModal');
}]);

on(['cheque-edit' => function (int $id) {
    $this->resetForm();
    $cheque = Cheque::findOrFail($id);
    $this->chequeId = $cheque->id;
    $this->fill([
        'company_id' => $cheque->company_id,
        'department_id' => $cheque->department_id,
        'cheque_number' => $cheque->cheque_number,
        'issuing_bank' => $cheque->issuing_bank,
        'issuing_branch' => $cheque->issuing_branch,
        'amount' => $cheque->amount,
        'cheque_date' => $cheque->cheque_date->toDateString(),
        'date' => $cheque->date->toDateString(),
        'deposit_account_id' => $cheque->deposit_account_id,
        'bank_charges' => Money::isPositive($cheque->bank_charges) ? $cheque->bank_charges : '',
        'deposit_reference' => $cheque->deposit_reference ?? '',
        'notes' => $cheque->notes,
        'existingScan' => (bool) $cheque->scan_path,
    ]);
    unset($this->bankOptions);
    $this->showModal('chequeFormModal');
}]);

$addDepartment = function () {
    $this->validate(['newDepartment' => ['required', 'string', 'max:255', 'unique:departments,name']], [], ['newDepartment' => 'department name']);
    $dept = Department::create(['name' => trim($this->newDepartment), 'is_active' => true]);
    unset($this->departmentOptions);
    $this->department_id = $dept->id;
    $this->fill(['newDepartment' => '', 'addingDepartment' => false]);
};

$save = function () {
    $data = $this->validate();
    $data['scan_path'] = $this->storeUpload($this->scan, 'cheques');
    unset($data['scan']);

    $ok = $this->attempt(function () use ($data) {
        $cheque = app(ChequeService::class)->save($this->chequeId ? Cheque::findOrFail($this->chequeId) : null, $data, auth()->user());
        $this->toast('success', $this->chequeId
            ? "Cheque #{$cheque->cheque_number} updated."
            : "Cheque #{$cheque->cheque_number}: ".money($cheque->netDeposit()).' deposited into '.$cheque->depositAccount->shortLabel().' for '.$cheque->department->name.'.');
    });

    if ($ok !== false) {
        $this->hideModal('chequeFormModal');
        $this->broadcastChange();
        $this->resetForm();
    }
};

?>

<div>
    <x-modal id="chequeFormModal" :title="$chequeId ? 'Edit Government Cheque' : 'Deposit Government Cheque'" icon="ri-bank-card-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('company_id')" />
                        @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label d-flex justify-content-between">
                            <span>For department <span class="text-danger">*</span></span>
                            <a href="#" class="fs-12" wire:click.prevent="$toggle('addingDepartment')">{{ $addingDepartment ? 'Cancel' : '+ New department' }}</a>
                        </label>
                        @if ($addingDepartment)
                            <div class="input-group has-validation">
                                <input type="text" class="form-control @error('newDepartment') is-invalid @enderror" wire:model="newDepartment" placeholder="e.g. District Health Office" wire:keydown.enter.prevent="addDepartment">
                                <button type="button" class="btn btn-primary" wire:click="addDepartment">Add</button>
                                @error('newDepartment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <x-searchable-select wire:model.live="department_id" :options="$this->departmentOptions" placeholder="Select department" :invalid="$errors->has('department_id')" />
                            @error('department_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @endif
                    </div>

                    @if ($this->position !== null)
                        <div class="col-12">
                            <div class="alert alert-light border mb-0 py-2 fs-13 ams-balance">
                                <i class="ri-scales-3-line me-1"></i>
                                Department balance with this company{{ $chequeId ? ' (without this cheque)' : '' }}:
                                @if (Money::isPositive($this->position))
                                    <strong class="text-danger">owes you {{ money($this->position) }}</strong>
                                @elseif (Money::isNegative($this->position))
                                    <strong class="text-success">you hold {{ money(Money::sub(0, $this->position)) }}</strong>
                                @else
                                    <strong>settled</strong>
                                @endif
                                @if (is_numeric($amount) && $amount > 0)
                                    @php($after = Money::sub($this->position, $amount))
                                    → after this cheque:
                                    <strong>{{ Money::isNegative($after) ? 'you hold '.money(Money::sub(0, $after)) : (Money::isZero($after) ? 'settled' : 'owes you '.money($after)) }}</strong>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="col-12"><h6 class="fs-13 text-uppercase text-muted mb-0 mt-1">Cheque</h6></div>
                    <div class="col-md-4">
                        <label class="form-label">Cheque number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('cheque_number') is-invalid @enderror" wire:model.blur="cheque_number" placeholder="e.g. 12345678">
                        @error('cheque_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Drawn on bank <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('issuing_bank') is-invalid @enderror" wire:model.blur="issuing_bank" placeholder="e.g. National Bank of Pakistan" list="issuing-banks">
                        <datalist id="issuing-banks">
                            @foreach (['National Bank of Pakistan', 'State Bank of Pakistan', 'Bank of Punjab', 'Sindh Bank', 'Bank of Khyber', 'HBL', 'MCB', 'UBL', 'Allied Bank', 'Meezan Bank'] as $b)
                                <option value="{{ $b }}">
                            @endforeach
                        </datalist>
                        @error('issuing_bank') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Branch</label>
                        <input type="text" class="form-control" wire:model="issuing_branch" placeholder="Branch / code">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model.live.debounce.400ms="amount" placeholder="0.00">
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cheque date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('cheque_date') is-invalid @enderror" wire:model.live="cheque_date">
                        @error('cheque_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($this->expiry && ! $errors->has('cheque_date'))
                            <div class="form-text {{ $this->expiry['expired'] ? 'text-danger' : '' }}">
                                <i class="ri-time-line"></i>
                                {{ $this->expiry['expired'] ? 'Expired on' : 'Valid until' }} {{ $this->expiry['date']->format('d M Y') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12"><h6 class="fs-13 text-uppercase text-muted mb-0 mt-1">Deposit</h6></div>
                    <div class="col-md-6">
                        <label class="form-label">Deposited into <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model="deposit_account_id" :options="$this->bankOptions"
                            :placeholder="! $company_id ? 'Select a company first' : (count($this->bankOptions) ? 'Select bank account' : 'This company has no bank account')"
                            :disabled="! $company_id" :invalid="$errors->has('deposit_account_id')" />
                        @error('deposit_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @if ($company_id && ! count($this->bankOptions))
                            <div class="form-text"><a href="{{ route('accounts.index') }}">Add a bank account</a> for this company first.</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Deposit date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model.live="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bank charges</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('bank_charges') is-invalid @enderror" wire:model.live.debounce.400ms="bank_charges" placeholder="0.00">
                            @error('bank_charges') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Deposit slip / bank reference</label>
                        <input type="text" class="form-control" wire:model="deposit_reference" placeholder="Optional">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cheque scan / photo</label>
                        <input type="file" class="form-control @error('scan') is-invalid @enderror" wire:model="scan" accept=".jpg,.jpeg,.png,.pdf">
                        <div wire:loading wire:target="scan" class="form-text"><i class="ri-loader-4-line"></i> Uploading…</div>
                        @error('scan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($existingScan && ! $scan)
                            <div class="form-text"><a href="{{ route('files.show', ['cheque', $chequeId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current scan</a> — upload a new file to replace it.</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes" placeholder="Bill / invoice reference, remarks…"></textarea>
                    </div>
                </div>

                @if ($this->net !== null && Money::isPositive($amount))
                    <div class="d-flex justify-content-between border-top mt-3 pt-3 fs-14">
                        <span class="text-muted">Amount reaching the bank</span>
                        <strong class="text-success ams-balance">{{ money($this->net) }}</strong>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,scan">
                    <span wire:loading.remove wire:target="save"><i class="ri-save-3-line me-1"></i>{{ $chequeId ? 'Save changes' : 'Save & deposit' }}</span>
                    <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </form>
    </x-modal>
</div>
