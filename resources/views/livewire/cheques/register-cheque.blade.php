<?php

/**
 * Stage 1: receive a government cheque on behalf of a company (also used to edit one).
 *
 * Open with:  $dispatch('cheque-create')  or  $dispatch('cheque-create', { companyId: 5 })
 *             $dispatch('cheque-edit', { id: 12 })
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\GovernmentDepartment;
use App\Services\ChequeService;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class]);
usesFileUploads();

state(['chequeId' => null])->locked();

state([
    'company_id' => null,
    'government_department_id' => null,
    'cheque_number' => '',
    'issuing_bank' => '',
    'issuing_branch' => '',
    'amount' => '',
    'cheque_date' => '',
    'received_date' => '',
    'notes' => '',
    'scan' => null,
    'existingScan' => false,
    'newDepartment' => '',
    'addingDepartment' => false,
]);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'government_department_id' => ['nullable', 'exists:government_departments,id'],
    'cheque_number' => [
        'required', 'string', 'max:50',
        Rule::unique('cheques')->where('issuing_bank', $this->issuing_bank)->whereNull('deleted_at')->ignore($this->chequeId),
    ],
    'issuing_bank' => ['required', 'string', 'max:255'],
    'issuing_branch' => ['nullable', 'string', 'max:255'],
    'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
    'cheque_date' => ['required', 'date'],
    'received_date' => ['required', 'date', 'after_or_equal:cheque_date', 'before_or_equal:today'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'scan' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
])->messages([
    'cheque_number.unique' => 'This cheque number is already registered for that issuing bank.',
    'received_date.after_or_equal' => 'Received date cannot be before the cheque date.',
]);

$companyOptions = computed(fn () => Options::companies(include: $this->company_id));
$departmentOptions = computed(fn () => Options::departments());

$company = computed(fn () => $this->company_id ? Company::find($this->company_id) : null);

$expiry = computed(function () {
    if (! $this->cheque_date || strtotime($this->cheque_date) === false) {
        return null;
    }
    $date = \Illuminate\Support\Carbon::parse(Cheque::expiryFor($this->cheque_date));

    return ['date' => $date, 'expired' => $date->isPast(), 'soon' => ! $date->isPast() && $date->lte(now()->addDays(Cheque::EXPIRY_WARNING_DAYS))];
});

$resetForm = function () {
    $this->reset(['company_id', 'government_department_id', 'cheque_number', 'issuing_bank', 'issuing_branch',
        'amount', 'notes', 'scan', 'existingScan', 'newDepartment', 'addingDepartment']);
    $this->chequeId = null;
    $this->cheque_date = now()->toDateString();
    $this->received_date = now()->toDateString();
    $this->resetErrorBag();
};

on(['cheque-create' => function (?int $companyId = null) {
    $this->resetForm();
    $this->company_id = $companyId;
    $this->showModal('chequeFormModal');
}]);

on(['cheque-edit' => function (int $id) {
    $this->resetForm();
    $cheque = Cheque::findOrFail($id);
    $this->chequeId = $cheque->id;
    $this->fill([
        'company_id' => $cheque->company_id,
        'government_department_id' => $cheque->government_department_id,
        'cheque_number' => $cheque->cheque_number,
        'issuing_bank' => $cheque->issuing_bank,
        'issuing_branch' => $cheque->issuing_branch,
        'amount' => $cheque->amount,
        'cheque_date' => $cheque->cheque_date->toDateString(),
        'received_date' => $cheque->received_date->toDateString(),
        'notes' => $cheque->notes,
        'existingScan' => (bool) $cheque->scan_path,
    ]);
    $this->showModal('chequeFormModal');
}]);

$addDepartment = function () {
    $this->validate(['newDepartment' => ['required', 'string', 'max:255', 'unique:government_departments,name']], [], ['newDepartment' => 'department name']);
    $dept = GovernmentDepartment::create(['name' => trim($this->newDepartment), 'is_active' => true]);
    unset($this->departmentOptions);
    $this->government_department_id = $dept->id;
    $this->newDepartment = '';
    $this->addingDepartment = false;
};

$save = function () {
    $data = $this->validate();
    $data['scan_path'] = $this->storeUpload($this->scan, 'cheques');
    unset($data['scan']);

    $service = app(ChequeService::class);

    $ok = $this->attempt(function () use ($service, $data) {
        if ($this->chequeId) {
            $cheque = Cheque::findOrFail($this->chequeId);
            if (! $data['scan_path']) {
                unset($data['scan_path']); // keep existing scan
            }
            $outcome = $service->update($cheque, $data, auth()->user());
            $this->toastOutcome($outcome, "Cheque #{$data['cheque_number']} updated.", 'Your edit');
        } else {
            $cheque = $service->register($data, auth()->user());
            $this->toast('success', "Cheque #{$cheque->cheque_number} for ".money($cheque->amount).' registered as pending clearing.');
        }
    });

    if ($ok !== false) {
        $this->hideModal('chequeFormModal');
        $this->broadcastChange();
        $this->resetForm();
    }
};

?>

<div>
    <x-modal id="chequeFormModal" :title="$chequeId ? 'Edit Government Cheque' : 'Receive Government Cheque'" icon="ri-bank-card-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror

                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('company_id')" />
                        @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Company position</label>
                        @if ($this->company)
                            <div class="form-control bg-light-subtle ams-balance fs-13">
                                Payable <strong class="text-success">{{ money($this->company->payable_balance) }}</strong>
                                @if (\App\Support\Money::isPositive($this->company->receivable_balance))
                                    · Receivable <strong class="text-danger">{{ money($this->company->receivable_balance) }}</strong>
                                @endif
                            </div>
                        @else
                            <div class="form-control bg-light-subtle text-muted fs-13">Select a company</div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <label class="form-label d-flex justify-content-between">
                            <span>Issuing government department</span>
                            <a href="#" class="fs-12" wire:click.prevent="$toggle('addingDepartment')">{{ $addingDepartment ? 'Cancel' : '+ New department' }}</a>
                        </label>
                        @if ($addingDepartment)
                            <div class="input-group has-validation">
                                <input type="text" class="form-control @error('newDepartment') is-invalid @enderror" wire:model="newDepartment" placeholder="e.g. Accountant General Punjab" wire:keydown.enter.prevent="addDepartment">
                                <button type="button" class="btn btn-primary" wire:click="addDepartment">Add</button>
                                @error('newDepartment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <x-searchable-select wire:model="government_department_id" :options="$this->departmentOptions" placeholder="Select department (optional)" />
                        @endif
                    </div>

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

                    <div class="col-md-4">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model.blur="amount" placeholder="0.00">
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cheque date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('cheque_date') is-invalid @enderror" wire:model.live="cheque_date">
                        @error('cheque_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($this->expiry)
                            <div class="form-text {{ $this->expiry['expired'] ? 'text-danger' : ($this->expiry['soon'] ? 'text-warning' : '') }}">
                                <i class="ri-time-line"></i>
                                {{ $this->expiry['expired'] ? 'Expired on' : 'Valid until' }} {{ $this->expiry['date']->format('d M Y') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Received on <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('received_date') is-invalid @enderror" wire:model="received_date" max="{{ now()->toDateString() }}">
                        @error('received_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

                @if ($chequeId && auth()->user()->needsApproval())
                    <div class="alert alert-info mt-4 mb-0 fs-13"><i class="ri-information-line me-1"></i>Edits by staff are sent to an administrator for approval before they take effect.</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,scan">
                    <span wire:loading.remove wire:target="save"><i class="ri-save-3-line me-1"></i>{{ $chequeId ? 'Save changes' : 'Register cheque' }}</span>
                    <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </form>
    </x-modal>
</div>
