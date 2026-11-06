<?php

/**
 * Pay out to a company — switch between:
 *   (a) Cash Payout     from the Cash Vault, handed to the company representative
 *   (b) Bank Transfer   from my bank account to one or more of the company's accounts
 *   (c) Direct Purchase goods / services bought from a vendor for the company
 * Live balances (company payable, source account) update as you type.
 *
 * Open with:  $dispatch('disbursement-create', { companyId?: 5, type?: 'bank_transfer' })
 *             $dispatch('disbursement-edit', { id: 9 })
 */

use App\Enums\BankAccountType;
use App\Enums\DisbursementType;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\CompanyBankAccount;
use App\Models\Disbursement;
use App\Models\Vendor;
use App\Services\DisbursementService;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class]);
usesFileUploads();

state(['disbursementId' => null])->locked();

state([
    'type' => 'cash_payout',
    'company_id' => null,
    'source_account_id' => null,
    'vendor_id' => null,
    'amount' => '',
    'date' => '',
    'reference' => '',
    'received_by' => '',
    'item_description' => '',
    'notes' => '',
    'receipt' => null,
    'existingReceipt' => false,
    'lines' => [],
    // inline "add" helpers
    'newVendor' => '',
    'addingVendor' => false,
    'newAccount' => ['bank_name' => '', 'account_title' => '', 'account_number' => '', 'iban' => ''],
    'addingAccount' => false,
]);

rules(fn () => [
    'type' => ['required', Rule::enum(DisbursementType::class)],
    'company_id' => ['required', 'exists:companies,id'],
    'source_account_id' => ['required', 'exists:bank_accounts,id'],
    'vendor_id' => [Rule::requiredIf($this->type === 'vendor_purchase'), 'nullable', 'exists:vendors,id'],
    'amount' => [Rule::requiredIf($this->type !== 'bank_transfer'), 'nullable', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'reference' => ['nullable', 'string', 'max:255'],
    'received_by' => ['nullable', 'string', 'max:255'],
    'item_description' => [Rule::requiredIf($this->type === 'vendor_purchase'), 'nullable', 'string', 'max:2000'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'receipt' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
    'lines' => [Rule::requiredIf($this->type === 'bank_transfer'), 'array'],
    'lines.*.company_bank_account_id' => ['required_if:type,bank_transfer', 'nullable', 'distinct', 'exists:company_bank_accounts,id'],
    'lines.*.amount' => ['required_if:type,bank_transfer', 'nullable', 'numeric', 'gt:0'],
    'lines.*.reference' => ['nullable', 'string', 'max:255'],
])->messages([
    'vendor_id.required' => 'Select the vendor you bought from.',
    'item_description.required' => 'Describe what was purchased.',
    'lines.*.company_bank_account_id.required_if' => 'Choose an account.',
    'lines.*.company_bank_account_id.distinct' => 'Each line needs a different account.',
    'lines.*.amount.required_if' => 'Enter an amount.',
])->attributes(['lines.*.amount' => 'amount']);

$companyOptions = computed(fn () => Options::companies(include: $this->company_id));
$vendorOptions = computed(fn () => Options::vendors());
$companyAccountOptions = computed(fn () => Options::companyBankAccounts($this->company_id));
$sourceOptions = computed(fn () => match ($this->type) {
    'cash_payout' => Options::bankAccounts('cash', $this->source_account_id),
    'bank_transfer' => Options::bankAccounts('bank', $this->source_account_id),
    default => Options::bankAccounts(include: $this->source_account_id),
});

$company = computed(fn () => $this->company_id ? Company::find($this->company_id) : null);
$source = computed(fn () => $this->source_account_id ? BankAccount::find($this->source_account_id) : null);

/** Total being paid (sum of transfer lines for bank transfers). */
$total = computed(function () {
    if ($this->type === 'bank_transfer') {
        return Money::add(...array_map(fn ($l) => is_numeric($l['amount'] ?? null) ? $l['amount'] : 0, $this->lines ?: [['amount' => 0]]));
    }

    return is_numeric($this->amount) ? Money::of($this->amount) : '0.00';
});

/** When editing a posted record, its old amount is already deducted from both balances. */
$alreadyPosted = computed(function () {
    if (! $this->disbursementId) {
        return ['company' => '0.00', 'account' => '0.00'];
    }
    $d = Disbursement::find($this->disbursementId);
    if (! $d?->isPosted()) {
        return ['company' => '0.00', 'account' => '0.00'];
    }

    return [
        'company' => $d->company_id == $this->company_id ? Money::of($d->amount) : '0.00',
        'account' => $d->source_account_id == $this->source_account_id ? Money::of($d->amount) : '0.00',
    ];
});

$check = computed(function () {
    $payable = $this->company ? Money::add($this->company->payable_balance, $this->alreadyPosted['company']) : null;
    $available = $this->source ? Money::add($this->source->current_balance, $this->alreadyPosted['account']) : null;

    return [
        'payable' => $payable,
        'available' => $available,
        'payableAfter' => $payable !== null ? Money::sub($payable, $this->total) : null,
        'availableAfter' => $available !== null ? Money::sub($available, $this->total) : null,
        'overPayable' => $payable !== null && Money::cmp($this->total, $payable) > 0,
        'overAvailable' => $available !== null && Money::cmp($this->total, $available) > 0,
    ];
});

$blankLine = fn () => ['company_bank_account_id' => null, 'amount' => '', 'reference' => ''];

$defaultSource = function () {
    $this->source_account_id = match ($this->type) {
        'cash_payout' => BankAccount::vault()?->id,
        'bank_transfer' => BankAccount::active()->banks()->count() === 1 ? BankAccount::active()->banks()->value('id') : null,
        default => $this->source_account_id,
    };
};

$resetForm = function () {
    $this->fill([
        'company_id' => null, 'vendor_id' => null, 'amount' => '', 'reference' => '', 'received_by' => '',
        'item_description' => '', 'notes' => '', 'receipt' => null, 'existingReceipt' => false,
        'newVendor' => '', 'addingVendor' => false, 'addingAccount' => false, 'source_account_id' => null,
        'newAccount' => ['bank_name' => '', 'account_title' => '', 'account_number' => '', 'iban' => ''],
    ]);
    $this->disbursementId = null;
    $this->type = 'cash_payout';
    $this->date = now()->toDateString();
    $this->lines = [$this->blankLine()];
    $this->resetErrorBag();
};

on(['disbursement-create' => function (?int $companyId = null, ?string $type = null) {
    $this->resetForm();
    $this->company_id = $companyId;
    $this->type = DisbursementType::tryFrom((string) $type)?->value ?? 'cash_payout';
    $this->defaultSource();
    $this->showModal('disbursementModal');
}]);

on(['disbursement-edit' => function (int $id) {
    $this->resetForm();
    $d = Disbursement::with('lines')->findOrFail($id);
    $this->disbursementId = $d->id;
    $this->fill([
        'type' => $d->type->value,
        'company_id' => $d->company_id,
        'source_account_id' => $d->source_account_id,
        'vendor_id' => $d->vendor_id,
        'amount' => $d->amount,
        'date' => $d->date->toDateString(),
        'reference' => $d->reference,
        'received_by' => $d->received_by,
        'item_description' => $d->item_description,
        'notes' => $d->notes,
        'existingReceipt' => (bool) $d->receipt_path,
        'lines' => $d->lines->map(fn ($l) => ['company_bank_account_id' => $l->company_bank_account_id, 'amount' => $l->amount, 'reference' => $l->reference])->all() ?: [$this->blankLine()],
    ]);
    $this->showModal('disbursementModal');
}]);

$setType = function (string $type) {
    $this->type = DisbursementType::from($type)->value;
    $this->defaultSource();
    $this->resetErrorBag();
};

$updatedCompanyId = function () {
    // Company changed: its bank accounts differ, so reset transfer lines.
    $this->lines = [$this->blankLine()];
    $this->addingAccount = false;
};

$addLine = function () {
    $this->lines[] = $this->blankLine();
};

$removeLine = function (int $index) {
    unset($this->lines[$index]);
    $this->lines = array_values($this->lines) ?: [$this->blankLine()];
};

/** Fill the last line with whatever is still owed to the company. */
$fillRemaining = function (int $index) {
    $otherLines = array_values(array_diff_key($this->lines, [$index => 1]));
    $others = Money::add(...array_map(fn ($l) => is_numeric($l['amount'] ?? null) ? $l['amount'] : 0, $otherLines));
    $remaining = Money::sub($this->check['payable'] ?? 0, $others);
    $this->lines[$index]['amount'] = Money::isPositive($remaining) ? $remaining : '';
    unset($this->total, $this->check); // computed during this request before the change
};

$addVendor = function () {
    $this->validate(['newVendor' => ['required', 'string', 'max:255', 'unique:vendors,name']], [], ['newVendor' => 'vendor name']);
    $vendor = Vendor::create(['name' => trim($this->newVendor), 'is_active' => true]);
    unset($this->vendorOptions);
    $this->vendor_id = $vendor->id;
    $this->fill(['newVendor' => '', 'addingVendor' => false]);
};

$addCompanyAccount = function () {
    $this->validate([
        'company_id' => ['required', 'exists:companies,id'],
        'newAccount.bank_name' => ['required', 'string', 'max:255'],
        'newAccount.account_title' => ['required', 'string', 'max:255'],
        'newAccount.account_number' => ['required', 'string', 'max:50', Rule::unique('company_bank_accounts', 'account_number')->where('company_id', $this->company_id)],
        'newAccount.iban' => ['nullable', 'string', 'max:34'],
    ], [], ['newAccount.bank_name' => 'bank', 'newAccount.account_title' => 'account title', 'newAccount.account_number' => 'account number']);

    $account = CompanyBankAccount::create(array_merge($this->newAccount, [
        'company_id' => $this->company_id,
        'is_active' => true,
        'is_default' => ! CompanyBankAccount::where('company_id', $this->company_id)->exists(),
    ]));
    unset($this->companyAccountOptions);

    // Drop it into the first empty line.
    foreach ($this->lines as $i => $line) {
        if (! $line['company_bank_account_id']) {
            $this->lines[$i]['company_bank_account_id'] = $account->id;
            break;
        }
    }
    $this->fill(['newAccount' => ['bank_name' => '', 'account_title' => '', 'account_number' => '', 'iban' => ''], 'addingAccount' => false]);
    $this->toast('success', 'Company bank account added.');
};

$save = function () {
    $data = $this->validate();
    $data['lines'] = $this->type === 'bank_transfer' ? array_values($this->lines) : [];
    $data['amount'] = $this->total;
    $path = $this->storeUpload($this->receipt, 'receipts');
    unset($data['receipt']);

    $service = app(DisbursementService::class);

    $ok = $this->attempt(function () use ($service, $data, $path) {
        if ($this->disbursementId) {
            $d = Disbursement::findOrFail($this->disbursementId);
            $data['receipt_path'] = $path ?? $d->receipt_path;
            $outcome = $service->update($d, $data, auth()->user());
            $this->toastOutcome($outcome, 'Disbursement updated.', 'Your edit');
        } else {
            $data['receipt_path'] = $path;
            [$d, $outcome] = $service->create($data, auth()->user());
            $this->toastOutcome($outcome, DisbursementType::from($this->type)->label().' of '.money($d->amount)." to {$d->company->name} recorded.", 'This payout');
        }
    });

    if ($ok !== false) {
        $this->hideModal('disbursementModal');
        $this->broadcastChange();
        $this->resetForm();
    }
};

?>

<div>
    <x-modal id="disbursementModal" :title="$disbursementId ? 'Edit Disbursement' : 'Pay Out to Company'" icon="ri-hand-coin-line" size="xl">
        <form wire:submit="save">
            <div class="modal-body">
                @error('general') <div class="alert alert-danger">{{ $message }}</div> @enderror

                {{-- Type switcher --}}
                <div class="row g-3 mb-4">
                    @foreach (DisbursementType::cases() as $t)
                        <div class="col-md-4">
                            <div class="ams-choice {{ $type === $t->value ? 'active' : '' }}" wire:click="setType('{{ $t->value }}')" role="button">
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="{{ $t->icon() }} text-primary"></i>
                                    <div>
                                        <div class="fw-semibold">{{ $t->label() }}</div>
                                        <div class="fs-12 text-muted">
                                            @switch($t)
                                                @case(DisbursementType::CashPayout) Hand cash from the vault @break
                                                @case(DisbursementType::BankTransfer) My bank → company account(s) @break
                                                @case(DisbursementType::VendorPurchase) Buy goods / services for them @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row g-3">
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label">Company <span class="text-danger">*</span></label>
                                <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('company_id')" />
                                @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Pay from <span class="text-danger">*</span></label>
                                <x-searchable-select wire:model.live="source_account_id" :options="$this->sourceOptions" placeholder="Select my account" :invalid="$errors->has('source_account_id')" :clearable="false" />
                                @error('source_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            @if ($type === 'vendor_purchase')
                                <div class="col-md-7" wire:key="vendor-field">
                                    <label class="form-label d-flex justify-content-between">
                                        <span>Vendor <span class="text-danger">*</span></span>
                                        <a href="#" class="fs-12" wire:click.prevent="$toggle('addingVendor')">{{ $addingVendor ? 'Cancel' : '+ New vendor' }}</a>
                                    </label>
                                    @if ($addingVendor)
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control @error('newVendor') is-invalid @enderror" wire:model="newVendor" placeholder="Vendor name" wire:keydown.enter.prevent="addVendor">
                                            <button type="button" class="btn btn-primary" wire:click="addVendor">Add</button>
                                            @error('newVendor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    @else
                                        <x-searchable-select wire:model="vendor_id" :options="$this->vendorOptions" placeholder="Select vendor" :invalid="$errors->has('vendor_id')" />
                                        @error('vendor_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    @endif
                                </div>
                            @endif

                            @if ($type !== 'bank_transfer')
                                <div class="col-md-5" wire:key="amount-field">
                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror {{ $this->check['overPayable'] || $this->check['overAvailable'] ? 'border-danger' : '' }}"
                                            wire:model.live.debounce.400ms="amount" placeholder="0.00">
                                        @if ($this->check['payable'] !== null && \App\Support\Money::isPositive($this->check['payable']))
                                            <button type="button" class="btn btn-light" title="Pay full amount owed" wire:click="$set('amount', '{{ $this->check['payable'] }}')">Max</button>
                                        @endif
                                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            @endif

                            @if ($type === 'cash_payout')
                                <div class="col-md-7" wire:key="received-by">
                                    <label class="form-label">Cash received by</label>
                                    <input type="text" class="form-control" wire:model="received_by" placeholder="Representative name / CNIC">
                                </div>
                            @endif

                            @if ($type === 'vendor_purchase')
                                <div class="col-md-12" wire:key="item-desc">
                                    <label class="form-label">Items / services purchased <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('item_description') is-invalid @enderror" rows="2" wire:model="item_description" placeholder="e.g. 10 x A4 paper reams, 2 x printer toner"></textarea>
                                    @error('item_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            @endif

                            @if ($type === 'bank_transfer')
                                <div class="col-12" wire:key="transfer-lines">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <label class="form-label mb-0">Transfer to company account(s) <span class="text-danger">*</span></label>
                                        @if ($company_id)
                                            <a href="#" class="fs-12" wire:click.prevent="$toggle('addingAccount')">{{ $addingAccount ? 'Cancel' : '+ Add company bank account' }}</a>
                                        @endif
                                    </div>

                                    @if (! $company_id)
                                        <div class="alert alert-light border mb-0 fs-13">Select a company first to see its bank accounts.</div>
                                    @else
                                        @if ($addingAccount)
                                            <div class="border rounded-3 p-3 mb-3 bg-light-subtle">
                                                <div class="row g-2">
                                                    <div class="col-md-3"><input class="form-control form-control-sm @error('newAccount.bank_name') is-invalid @enderror" wire:model="newAccount.bank_name" placeholder="Bank *"></div>
                                                    <div class="col-md-3"><input class="form-control form-control-sm @error('newAccount.account_title') is-invalid @enderror" wire:model="newAccount.account_title" placeholder="Account title *"></div>
                                                    <div class="col-md-3"><input class="form-control form-control-sm @error('newAccount.account_number') is-invalid @enderror" wire:model="newAccount.account_number" placeholder="Account # *"></div>
                                                    <div class="col-md-2"><input class="form-control form-control-sm" wire:model="newAccount.iban" placeholder="IBAN"></div>
                                                    <div class="col-md-1 d-grid"><button type="button" class="btn btn-sm btn-primary" wire:click="addCompanyAccount">Add</button></div>
                                                </div>
                                                @foreach (['newAccount.bank_name', 'newAccount.account_title', 'newAccount.account_number'] as $f)
                                                    @error($f) <div class="text-danger fs-12 mt-1">{{ $message }}</div> @enderror
                                                @endforeach
                                            </div>
                                        @endif

                                        @if (empty($this->companyAccountOptions) && ! $addingAccount)
                                            <div class="alert alert-warning fs-13 mb-2">This company has no bank accounts on file. <a href="#" wire:click.prevent="$set('addingAccount', true)">Add one</a>.</div>
                                        @endif

                                        @error('lines') <div class="text-danger fs-12 mb-2">{{ $message }}</div> @enderror
                                        @foreach ($lines as $i => $line)
                                            <div class="row g-2 mb-2 align-items-start" wire:key="line-{{ $i }}">
                                                <div class="col-md-5">
                                                    <x-searchable-select wire:model.live="lines.{{ $i }}.company_bank_account_id" :options="$this->companyAccountOptions" placeholder="Company account" :invalid="$errors->has('lines.'.$i.'.company_bank_account_id')" />
                                                    @error('lines.'.$i.'.company_bank_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-sm has-validation">
                                                        <input type="number" step="0.01" min="0" class="form-control @error('lines.'.$i.'.amount') is-invalid @enderror" wire:model.live.debounce.400ms="lines.{{ $i }}.amount" placeholder="Amount">
                                                        <button type="button" class="btn btn-light" title="Fill remaining owed" wire:click="fillRemaining({{ $i }})"><i class="ri-magic-line"></i></button>
                                                        @error('lines.'.$i.'.amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm" wire:model="lines.{{ $i }}.reference" placeholder="IBFT / txn ref">
                                                </div>
                                                <div class="col-md-1 text-end">
                                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" wire:click="removeLine({{ $i }})" title="Remove"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                        <button type="button" class="btn btn-sm btn-light" wire:click="addLine"><i class="ri-add-line me-1"></i>Split to another account</button>
                                    @endif
                                </div>
                            @endif

                            <div class="col-md-4">
                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                                @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Reference</label>
                                <input type="text" class="form-control" wire:model="reference" placeholder="Voucher / invoice #">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">{{ $type === 'vendor_purchase' ? 'Receipt' : 'Attachment' }}</label>
                                <input type="file" class="form-control @error('receipt') is-invalid @enderror" wire:model="receipt" accept=".jpg,.jpeg,.png,.pdf">
                                @error('receipt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                @if ($existingReceipt && ! $receipt)
                                    <div class="form-text"><a href="{{ route('files.show', ['disbursement', $disbursementId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current file</a></div>
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Live balances --}}
                    <div class="col-lg-4">
                        <div class="card border shadow-none mb-0 h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase fs-12 text-muted mb-3">Live balances</h6>

                                <div class="mb-3">
                                    <div class="fs-12 text-muted">Owed to {{ $this->company?->name ?? 'company' }}</div>
                                    <div class="fs-18 fw-semibold ams-balance">{{ $this->check['payable'] !== null ? money($this->check['payable']) : '—' }}</div>
                                    @if ($this->company && \App\Support\Money::isPositive($this->company->receivable_balance))
                                        <div class="fs-12 text-danger">They owe you {{ money($this->company->receivable_balance) }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <div class="fs-12 text-muted">Available in {{ $this->source?->name ?? 'account' }}</div>
                                    <div class="fs-18 fw-semibold ams-balance">{{ $this->check['available'] !== null ? money($this->check['available']) : '—' }}</div>
                                </div>
                                <hr>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">Paying now</span>
                                    <strong class="ams-balance">{{ money($this->total) }}</strong>
                                </div>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">Payable after</span>
                                    <strong class="ams-balance {{ $this->check['overPayable'] ? 'text-danger' : 'text-success' }}">{{ $this->check['payableAfter'] !== null ? money($this->check['payableAfter']) : '—' }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Account after</span>
                                    <strong class="ams-balance {{ $this->check['overAvailable'] ? 'text-danger' : '' }}">{{ $this->check['availableAfter'] !== null ? money($this->check['availableAfter']) : '—' }}</strong>
                                </div>

                                @if ($this->check['overPayable'])
                                    <div class="alert alert-danger fs-12 mt-3 mb-0"><i class="ri-forbid-line me-1"></i>Exceeds what you owe this company. Advances are not allowed.</div>
                                @elseif ($this->check['overAvailable'])
                                    <div class="alert alert-danger fs-12 mt-3 mb-0"><i class="ri-forbid-line me-1"></i>Not enough money in {{ $this->source->name }}.</div>
                                @endif

                                @if (auth()->user()->needsApproval())
                                    <div class="alert alert-info fs-12 mt-3 mb-0"><i class="ri-information-line me-1"></i>Payouts by staff are posted after an administrator approves them.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,receipt"
                    @disabled($this->check['overPayable'] || $this->check['overAvailable'])>
                    <span wire:loading.remove wire:target="save"><i class="ri-send-plane-line me-1"></i>{{ auth()->user()->needsApproval() && ! $disbursementId ? 'Submit for approval' : ($disbursementId ? 'Save changes' : 'Record payout') }}</span>
                    <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </form>
    </x-modal>
</div>
