<?php

/**
 * Spend for a department: hand over cash, send a bank transfer, or buy goods from a supplier
 * (paid now or on credit). Also edits an existing payment.
 *
 * Open with:  $dispatch('payment-create', { companyId: 1, departmentId: 2, method: 'cash' })   (all optional)
 *             $dispatch('payment-edit', { id: 9 })
 */

use App\Enums\PaymentMethod;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Supplier;
use App\Services\Balances;
use App\Services\PaymentService;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class]);
usesFileUploads();

state(['paymentId' => null])->locked();

state([
    'company_id' => null,
    'department_id' => null,
    'method' => 'cash',
    'account_id' => null,
    'supplier_id' => null,
    'on_credit' => '0',
    'amount' => '',
    'date' => '',
    'reference' => '',
    'received_by' => '',
    'item_description' => '',
    'notes' => '',
    'receipt' => null,
    'existingReceipt' => false,
    'newDepartment' => '',
    'addingDepartment' => false,
    'newSupplier' => '',
    'addingSupplier' => false,
]);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'department_id' => ['required', 'exists:departments,id'],
    'method' => ['required', Rule::enum(PaymentMethod::class)],
    'account_id' => [Rule::requiredIf($this->method === 'bank_transfer' || ($this->method === 'goods' && ! $this->on_credit)), 'nullable', 'exists:accounts,id'],
    'supplier_id' => [Rule::requiredIf($this->method === 'goods'), 'nullable', 'exists:suppliers,id'],
    'on_credit' => ['boolean'],
    'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'reference' => ['nullable', 'string', 'max:255'],
    'received_by' => ['nullable', 'string', 'max:255'],
    'item_description' => [Rule::requiredIf($this->method === 'goods'), 'nullable', 'string', 'max:2000'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'receipt' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
])->messages([
    'account_id.required' => 'Choose the account the money is paid from.',
    'supplier_id.required' => 'Choose the supplier.',
    'item_description.required' => 'Describe what was bought.',
    'department_id.required' => 'Choose the department.',
]);

$companyOptions = computed(fn () => Options::companies($this->company_id));
$departmentOptions = computed(fn () => Options::departments($this->department_id));
$supplierOptions = computed(fn () => Options::suppliers($this->supplier_id));
$accountOptions = computed(fn () => $this->company_id
    ? Options::accounts((int) $this->company_id, $this->method === 'bank_transfer' ? 'bank' : null, $this->account_id)
    : []);

$cashAccount = computed(fn () => $this->company_id ? Account::where('company_id', $this->company_id)->cash()->first() : null);

$deptBalance = computed(fn () => $this->company_id && $this->department_id
    ? Balances::departmentBalance((int) $this->department_id, (int) $this->company_id)
    : null);

$supplierOwed = computed(fn () => $this->company_id && $this->supplier_id
    ? Balances::supplierOwed((int) $this->supplier_id, (int) $this->company_id)
    : null);

$updatedCompanyId = function () {
    $this->account_id = null;
    unset($this->accountOptions, $this->cashAccount);
};

$updatedMethod = function () {
    // Keep the account only if it is still valid for the new method.
    unset($this->accountOptions);
    if (! collect($this->accountOptions)->contains('value', $this->account_id)) {
        $this->account_id = null;
    }
    $this->resetErrorBag();
};

$resetForm = function () {
    $this->fill([
        'company_id' => null, 'department_id' => null, 'method' => 'cash', 'account_id' => null, 'supplier_id' => null,
        'on_credit' => '0', 'amount' => '', 'reference' => '', 'received_by' => '', 'item_description' => '', 'notes' => '',
        'receipt' => null, 'existingReceipt' => false, 'newDepartment' => '', 'addingDepartment' => false,
        'newSupplier' => '', 'addingSupplier' => false,
    ]);
    $this->paymentId = null;
    $this->date = now()->toDateString();
    $this->resetErrorBag();
};

on(['payment-create' => function (?int $companyId = null, ?int $departmentId = null, ?string $method = null) {
    $this->resetForm();
    $this->company_id = $companyId;
    $this->department_id = $departmentId;
    $this->method = PaymentMethod::tryFrom((string) $method)?->value ?? 'cash';
    $this->showModal('paymentModal');
}]);

on(['payment-edit' => function (int $id) {
    $this->resetForm();
    $p = Payment::findOrFail($id);
    $this->paymentId = $p->id;
    $this->fill([
        'company_id' => $p->company_id, 'department_id' => $p->department_id, 'method' => $p->method->value,
        'account_id' => $p->account_id, 'supplier_id' => $p->supplier_id, 'on_credit' => $p->on_credit ? '1' : '0',
        'amount' => $p->amount, 'date' => $p->date->toDateString(), 'reference' => $p->reference ?? '',
        'received_by' => $p->received_by ?? '', 'item_description' => $p->item_description ?? '', 'notes' => $p->notes ?? '',
        'existingReceipt' => (bool) $p->receipt_path,
    ]);
    $this->showModal('paymentModal');
}]);

$addDepartment = function () {
    $this->validate(['newDepartment' => ['required', 'string', 'max:255', 'unique:departments,name']], [], ['newDepartment' => 'department name']);
    $this->department_id = Department::create(['name' => trim($this->newDepartment), 'is_active' => true])->id;
    unset($this->departmentOptions);
    $this->fill(['newDepartment' => '', 'addingDepartment' => false]);
};

$addSupplier = function () {
    $this->validate(['newSupplier' => ['required', 'string', 'max:255', 'unique:suppliers,name']], [], ['newSupplier' => 'supplier name']);
    $this->supplier_id = Supplier::create(['name' => trim($this->newSupplier), 'is_active' => true])->id;
    unset($this->supplierOptions);
    $this->fill(['newSupplier' => '', 'addingSupplier' => false]);
};

$save = function () {
    $data = $this->validate();
    $data['receipt_path'] = $this->storeUpload($this->receipt, 'receipts');
    unset($data['receipt']);

    $ok = $this->attempt(function () use ($data) {
        $payment = app(PaymentService::class)->savePayment($this->paymentId ? Payment::findOrFail($this->paymentId) : null, $data);
        $this->toast('success', ($this->paymentId ? 'Updated: ' : 'Saved: ').$payment->describe().' — '.money($payment->amount));
    });

    if ($ok !== false) {
        $this->hideModal('paymentModal');
        $this->broadcastChange();
        $this->resetForm();
    }
};

?>

<div>
    <x-modal id="paymentModal" :title="$paymentId ? 'Edit Department Payment' : 'Pay / Spend for a Department'" icon="ri-hand-coin-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Paid by company <span class="text-danger">*</span></label>
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
                                <input type="text" class="form-control @error('newDepartment') is-invalid @enderror" wire:model="newDepartment" placeholder="Department name" wire:keydown.enter.prevent="addDepartment">
                                <button type="button" class="btn btn-primary" wire:click="addDepartment">Add</button>
                                @error('newDepartment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <x-searchable-select wire:model.live="department_id" :options="$this->departmentOptions" placeholder="Select department" :invalid="$errors->has('department_id')" />
                            @error('department_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @endif
                        @if ($this->deptBalance !== null)
                            <div class="form-text ams-balance">
                                @if (Money::isNegative($this->deptBalance))
                                    <span class="text-success">You hold {{ money(Money::sub(0, $this->deptBalance)) }} of their cheques</span>
                                @elseif (Money::isPositive($this->deptBalance))
                                    <span class="text-danger">They already owe {{ money($this->deptBalance) }}</span>
                                @else
                                    Balance settled
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">How was it given? <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            @foreach (PaymentMethod::cases() as $m)
                                <div class="col-sm-4">
                                    <label class="ams-choice d-flex gap-2 align-items-start mb-0 {{ $method === $m->value ? 'active' : '' }}">
                                        <input type="radio" class="form-check-input mt-1" wire:model.live="method" value="{{ $m->value }}">
                                        <span>
                                            <span class="d-block fw-semibold"><i class="{{ $m->icon() }} me-1"></i>{{ $m->label() }}</span>
                                            <span class="fs-12 text-muted">{{ $m->hint() }}</span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($method === 'goods')
                        <div class="col-md-6">
                            <label class="form-label d-flex justify-content-between">
                                <span>Supplier <span class="text-danger">*</span></span>
                                <a href="#" class="fs-12" wire:click.prevent="$toggle('addingSupplier')">{{ $addingSupplier ? 'Cancel' : '+ New supplier' }}</a>
                            </label>
                            @if ($addingSupplier)
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control @error('newSupplier') is-invalid @enderror" wire:model="newSupplier" placeholder="Supplier name" wire:keydown.enter.prevent="addSupplier">
                                    <button type="button" class="btn btn-primary" wire:click="addSupplier">Add</button>
                                    @error('newSupplier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            @else
                                <x-searchable-select wire:model.live="supplier_id" :options="$this->supplierOptions" placeholder="Select supplier" :invalid="$errors->has('supplier_id')" />
                                @error('supplier_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            @endif
                            @if ($this->supplierOwed !== null && Money::isPositive($this->supplierOwed))
                                <div class="form-text">This company already owes them {{ money($this->supplierOwed) }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment to supplier</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" id="pay-now" wire:model.live="on_credit" value="0" @checked(! $on_credit)>
                                <label class="btn btn-outline-primary" for="pay-now"><i class="ri-money-dollar-circle-line me-1"></i>Paid now</label>
                                <input type="radio" class="btn-check" id="pay-credit" wire:model.live="on_credit" value="1" @checked($on_credit)>
                                <label class="btn btn-outline-warning" for="pay-credit"><i class="ri-time-line me-1"></i>On credit</label>
                            </div>
                            <div class="form-text">{{ $on_credit ? 'Added to what the company owes this supplier.' : 'Paid from cash or bank right away.' }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Items bought <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('item_description') is-invalid @enderror" rows="2" wire:model="item_description" placeholder="e.g. 20 office chairs, 5 printers"></textarea>
                            @error('item_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endif

                    @if ($method === 'cash')
                        <div class="col-md-6">
                            <label class="form-label">Paid from</label>
                            <div class="form-control bg-body-tertiary ams-balance">
                                @if ($this->cashAccount)
                                    Cash in hand · <strong>{{ money($this->cashAccount->current_balance) }}</strong>
                                @else
                                    <span class="text-muted">Select a company</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Received by</label>
                            <input type="text" class="form-control" wire:model="received_by" placeholder="Name of the person who collected the cash">
                        </div>
                    @elseif ($method === 'bank_transfer' || ! $on_credit)
                        <div class="col-md-6">
                            <label class="form-label">Paid from {{ $method === 'bank_transfer' ? 'bank' : 'account' }} <span class="text-danger">*</span></label>
                            <x-searchable-select wire:model="account_id" :options="$this->accountOptions" :placeholder="$company_id ? 'Select account' : 'Select a company first'" :disabled="! $company_id" :invalid="$errors->has('account_id')" />
                            @error('account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    @endif

                    <div class="col-md-6">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rs.</span>
                            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model.blur="amount" placeholder="0.00">
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Reference</label>
                        <input type="text" class="form-control" wire:model="reference" placeholder="{{ $method === 'bank_transfer' ? 'IBFT / transaction ID' : ($method === 'goods' ? 'Invoice / bill number' : 'Voucher / receipt number') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ $method === 'goods' ? 'Invoice / receipt' : 'Receipt' }} (optional)</label>
                        <input type="file" class="form-control @error('receipt') is-invalid @enderror" wire:model="receipt" accept=".jpg,.jpeg,.png,.pdf">
                        @error('receipt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($existingReceipt && ! $receipt)
                            <div class="form-text"><a href="{{ route('files.show', ['payment', $paymentId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current file</a></div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,receipt">
                    <span wire:loading.remove wire:target="save"><i class="ri-save-3-line me-1"></i>{{ $paymentId ? 'Save changes' : 'Save payment' }}</span>
                    <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </form>
    </x-modal>
</div>
