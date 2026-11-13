<?php

/**
 * Pay / spend for departments: cash from the admin's cash in hand (no company), a bank transfer
 * from a company bank, or goods bought from a supplier (paid from a bank or on credit). Agents
 * pay by bank transfer from their own bank, for a company they choose.
 *
 * As a modal (one payment at a time, also used to edit):
 *     $dispatch('payment-create', { companyId: 1, departmentId: 2, method: 'cash' })   (all optional)
 *     $dispatch('payment-edit', { id: 9 })        an agent's edit becomes a request to the admin
 * As a page (batch entry): <livewire:payments.create :as-page="true" />  (route payments.create,
 *     prefilled from ?company=1&department=2&method=goods). The white "payment details" card
 *     (date, type, company, bank / supplier, department) stays filled; the light-blue card
 *     (amount, description, reference, received by, receipt, notes) clears after each
 *     "Add to table". "Save all" saves the table together, all-or-nothing, and stays here.
 */

use App\Enums\PaymentMethod;
use App\Exceptions\BusinessRuleException;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Supplier;
use App\Services\Balances;
use App\Services\PaymentApprovalService;
use App\Services\PaymentService;
use App\Support\Money;
use App\Support\Options;
use App\Support\PaymentRules;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Livewire\Volt\{computed, mount, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class]);
usesFileUploads();

state(['paymentId' => null, 'asPage' => false])->locked();

state([
    // Payment details (stay the same from one payment to the next on the page).
    'date' => '',
    'method' => 'cash',
    'company_id' => null,
    'account_id' => null,
    'supplier_id' => null,
    'on_credit' => '0',
    'department_id' => null,
    // Item details (cleared after each "Add to table").
    'amount' => '',
    'item_description' => '',
    'reference' => '',
    'received_by' => '',
    'receipt' => null,
    'notes' => '',

    'existingReceipt' => false,   // modal edit: the saved payment has a receipt
    'newDepartment' => '',
    'addingDepartment' => false,
    'newSupplier' => '',
    'addingSupplier' => false,

    // Page (batch) mode.
    'rows' => [],
    'editingRow' => null,
    'rowReceiptPath' => null,
    'rowReceiptName' => null,
    'rowErrors' => [],
    'heldBatch' => null,
    'changeReason' => '',          // agent editing a saved payment: why (sent with the request)
]);

$isAdmin = computed(fn () => (bool) auth()->user()?->isAdmin());

rules(fn () => PaymentRules::rules($this->only(PaymentRules::BATCH_FIELDS), ! $this->isAdmin))
    ->messages(PaymentRules::messages())->attributes(PaymentRules::attributes());

// What the company owes or is owed: agents see what they hold of each company.
$companyOptions = computed(function () {
    $options = Options::companies($this->company_id);
    if ($this->isAdmin) {
        return $options;
    }
    $owed = Balances::agents(null, auth()->id())->pluck('owed', 'company_id');

    return array_map(fn ($o) => $o + ['hint' => 'you hold '.money($owed[$o['value']] ?? 0)], $options);
});
$departmentOptions = computed(fn () => Options::departments($this->department_id));
$supplierOptions = computed(fn () => Options::suppliers($this->supplier_id));
$accountOptions = computed(fn () => match (true) {
    ! $this->isAdmin => Options::agentAccounts(auth()->id(), $this->account_id, 'bank'),
    // The admin editing an agent's payment: that agent's banks.
    (bool) ($agentId = $this->account_id ? Account::withTrashed()->whereKey($this->account_id)->value('agent_id') : null) => Options::agentAccounts($agentId, $this->account_id, 'bank'),
    $this->method === 'cash' => [],
    (bool) $this->company_id => Options::accounts((int) $this->company_id, 'bank', $this->account_id),
    default => [],
});
$cashAccount = computed(fn () => Account::adminCash());

// The department's balance with this company (or with no company, for cash) before this payment
// and the other payments in the table.
$position = computed(function () {
    if (! $this->department_id || ($this->method !== 'cash' && ! $this->company_id)) {
        return null;
    }
    $company = $this->method === 'cash' && $this->isAdmin ? Balances::NONE : (int) $this->company_id;
    $balance = Balances::departmentBalance((int) $this->department_id, $company);
    if ($this->paymentId && ($old = Payment::find($this->paymentId)) && (int) $old->company_id === $company && $old->department_id == $this->department_id) {
        $balance = Money::sub($balance, $old->amount);
    }
    foreach ($this->rows as $i => $row) {
        if ($i !== $this->editingRow && (int) $row['company_id'] === $company && $row['department_id'] == $this->department_id) {
            $balance = Money::add($balance, $row['amount']);
        }
    }

    return $balance;
});

// Agent: what they hold of the chosen company's money before this payment (and the table's).
$agentHolds = computed(function () {
    if ($this->isAdmin || ! $this->company_id) {
        return null;
    }
    $holds = Balances::agentOwed(auth()->id(), (int) $this->company_id);
    if ($this->paymentId && ($old = Payment::find($this->paymentId)) && $old->company_id == $this->company_id) {
        $holds = Money::add($holds, $old->amount);
    }
    foreach ($this->rows as $i => $row) {
        if ($i !== $this->editingRow && $row['company_id'] == $this->company_id) {
            $holds = Money::sub($holds, $row['amount']);
        }
    }

    return $holds;
});

$supplierOwed = computed(fn () => $this->method === 'goods' && $this->company_id && $this->supplier_id
    ? Balances::supplierOwed((int) $this->supplier_id, (int) $this->company_id)
    : null);

// Names for the batch table.
$lookups = computed(function () {
    $rows = collect($this->rows);

    return [
        'companies' => Company::withTrashed()->whereIn('id', $rows->pluck('company_id')->filter())->pluck('name', 'id'),
        'accounts' => Account::withTrashed()->whereIn('id', $rows->pluck('account_id')->filter())->get()->mapWithKeys(fn ($a) => [$a->id => $a->shortLabel()]),
        'departments' => Department::whereIn('id', $rows->pluck('department_id'))->pluck('name', 'id'),
        'suppliers' => Supplier::whereIn('id', $rows->pluck('supplier_id')->filter())->pluck('name', 'id'),
    ];
});

$total = computed(fn () => Money::add(...array_column($this->rows, 'amount')));

/** Pick the only (page: the first) bank when the list has one to offer. */
$pickAccount = function () {
    unset($this->accountOptions);
    $options = $this->accountOptions;
    if (! collect($options)->contains('value', $this->account_id)) {
        $this->account_id = ($this->asPage || count($options) === 1) ? ($options[0]['value'] ?? null) : null;
    }
};

$updatedCompanyId = function () {
    // A company bank follows the company; an agent's bank (theirs, or the admin editing theirs) does not.
    if ($this->isAdmin && ! Account::find($this->account_id)?->isAgentAccount()) {
        $this->account_id = null;
        $this->pickAccount();
    }
    unset($this->position, $this->agentHolds, $this->supplierOwed);
};

$updatedMethod = function () {
    if (! $this->isAdmin) {
        $this->method = 'bank_transfer';
    }
    if ($this->method === 'cash') {
        $this->fill(['company_id' => null, 'account_id' => null]);
    }
    if ($this->method !== 'goods') {
        $this->fill(['supplier_id' => null, 'on_credit' => '0']);
    }
    $this->pickAccount();
    $this->resetErrorBag();
    unset($this->position, $this->supplierOwed);
};

$updatedOnCredit = function () {
    $this->pickAccount();
};

$resetForm = function () {
    $this->fill([
        'date' => now()->toDateString(), 'method' => $this->isAdmin ? 'cash' : 'bank_transfer', 'company_id' => null, 'account_id' => null,
        'supplier_id' => null, 'on_credit' => '0', 'department_id' => null,
        'amount' => '', 'item_description' => '', 'reference' => '', 'received_by' => '', 'receipt' => null, 'notes' => '',
        'existingReceipt' => false, 'newDepartment' => '', 'addingDepartment' => false, 'newSupplier' => '', 'addingSupplier' => false,
        'editingRow' => null, 'rowReceiptPath' => null, 'rowReceiptName' => null, 'heldBatch' => null, 'changeReason' => '',
    ]);
    $this->paymentId = null;
    $this->resetErrorBag();
    unset($this->accountOptions, $this->position, $this->agentHolds, $this->supplierOwed);
};

$startNew = function (?int $companyId = null, ?int $departmentId = null, ?string $method = null) {
    $this->resetForm();
    if ($this->isAdmin && ($m = PaymentMethod::tryFrom((string) $method))) {
        $this->method = $m->value;
    } elseif ($this->isAdmin && $companyId) {
        $this->method = PaymentMethod::BankTransfer->value; // opened for a company: cash would have none
    }
    $this->company_id = $this->method === 'cash' ? null : $companyId;
    $this->department_id = $departmentId;
    $this->pickAccount();
};

// The page opens with today's date and the first department; an agent also starts on their first
// bank and the first company. ?company= / ?department= / ?method= can say otherwise.
mount(function (bool $asPage = false, $company = null, $department = null, $method = null) {
    $this->asPage = $asPage;
    if ($this->asPage) {
        $id = fn ($v) => ctype_digit((string) $v) ? (int) $v : null;
        $companyId = $id($company) ?? ($this->isAdmin ? null : ($this->companyOptions[0]['value'] ?? null));
        $this->startNew($companyId, $id($department) ?? ($this->departmentOptions[0]['value'] ?? null), $method);
        unset($this->companyOptions, $this->departmentOptions);
    }
});

on(['payment-create' => function (?int $companyId = null, ?int $departmentId = null, ?string $method = null) {
    if ($this->asPage) {
        return; // the page form is always open; the modal instance handles this event
    }
    $this->startNew($companyId, $departmentId, $method);
    $this->showModal('paymentModal');
}]);

on(['payment-edit' => function (int $id) {
    if ($this->asPage) {
        return;
    }
    // An agent may only open their own payment, and only when no change is already waiting.
    $p = Payment::visibleTo(auth()->user())->findOrFail($id);
    if (! $this->isAdmin && $p->pendingRequest()->exists()) {
        $this->toast('error', 'A change to this payment is already waiting for the admin.');

        return;
    }
    $this->resetForm();
    $this->paymentId = $p->id;
    $this->fill([
        'date' => $p->date->toDateString(), 'method' => $p->method->value, 'company_id' => $p->company_id,
        'account_id' => $p->account_id, 'supplier_id' => $p->supplier_id, 'on_credit' => $p->on_credit ? '1' : '0',
        'department_id' => $p->department_id, 'amount' => $p->amount, 'item_description' => $p->item_description ?? '',
        'reference' => $p->reference ?? '', 'received_by' => $p->received_by ?? '', 'notes' => $p->notes ?? '',
        'existingReceipt' => (bool) $p->receipt_path,
    ]);
    unset($this->accountOptions);
    $this->showModal('paymentModal');
}]);

// Only the admin adds departments and suppliers.
$addDepartment = function () {
    abort_unless($this->isAdmin, 403);
    $this->validate(['newDepartment' => ['required', 'string', 'max:255', 'unique:departments,name']], [], ['newDepartment' => 'department name']);
    $this->department_id = Department::create(['name' => trim($this->newDepartment), 'is_active' => true])->id;
    unset($this->departmentOptions);
    $this->fill(['newDepartment' => '', 'addingDepartment' => false]);
};

$addSupplier = function () {
    abort_unless($this->isAdmin, 403);
    $this->validate(['newSupplier' => ['required', 'string', 'max:255', 'unique:suppliers,name']], [], ['newSupplier' => 'supplier name']);
    $this->supplier_id = Supplier::create(['name' => trim($this->newSupplier), 'is_active' => true])->id;
    unset($this->supplierOptions);
    $this->fill(['newSupplier' => '', 'addingSupplier' => false]);
};

/** The form's values as a payment (without the receipt). */
$formData = fn () => $this->only([...PaymentRules::BATCH_FIELDS, ...PaymentRules::ITEM_FIELDS]);

// ── Modal: save one payment ───────────────────────────────────────────────────────────

$save = function () {
    $this->validate();
    $data = $this->formData();
    $data['receipt_path'] = $this->storeUpload($this->receipt, 'receipts');

    // An agent's edit of a saved payment waits for the admin.
    if ($this->paymentId && ! $this->isAdmin) {
        $payment = Payment::visibleTo(auth()->user())->findOrFail($this->paymentId);
        $sent = $this->attempt(fn () => app(PaymentApprovalService::class)->requestEdit($payment, $data, auth()->user(), trim($this->changeReason) ?: null));
        if ($sent === false) {
            if ($data['receipt_path']) {
                Storage::disk('local')->delete($data['receipt_path']);
            }

            return;
        }
        $this->toast('success', 'Change to the payment sent to the admin for approval.');
        $this->dispatch('approval-updated');
        $this->hideModal('paymentModal');
        $this->resetForm();

        return;
    }

    $ok = $this->attempt(function () use ($data) {
        $payment = app(PaymentService::class)->savePayment($this->paymentId ? Payment::visibleTo(auth()->user())->findOrFail($this->paymentId) : null, $data, auth()->user());
        $this->toast('success', ($this->paymentId ? 'Updated: ' : 'Saved: ').$payment->describe().' — '.money($payment->amount));
    });

    if ($ok !== false) {
        $this->hideModal('paymentModal');
        $this->broadcastChange();
        $this->resetForm();
    }
};

// ── Page: build a table of payments, then save them together ───────────────────────────

$addRow = function () {
    $this->validate();
    $data = $this->formData();

    $checked = $this->attempt(fn () => app(PaymentService::class)->checkPayment($data, null, auth()->user()));
    if ($checked === false) {
        return;
    }

    $receiptPath = $this->rowReceiptPath;
    $receiptName = $this->rowReceiptName;
    if ($this->receipt) {
        if ($receiptPath) {
            Storage::disk('local')->delete($receiptPath); // replaced
        }
        $receiptName = $this->receipt->getClientOriginalName();
        $receiptPath = $this->storeUpload($this->receipt, 'receipts');
    }

    // Keep what the rules decided (cash: no company, the admin's cash; on credit: no bank).
    $row = array_merge($data, [
        'company_id' => $checked->company_id ? (int) $checked->company_id : null,
        'account_id' => $checked->account_id ? (int) $checked->account_id : null,
        'supplier_id' => $checked->supplier_id ? (int) $checked->supplier_id : null,
        'on_credit' => $checked->on_credit ? '1' : '0',
        'department_id' => (int) $data['department_id'],
        'amount' => Money::of($data['amount']),
        'receipt_path' => $receiptPath,
        'receipt_name' => $receiptName,
    ]);

    if ($this->editingRow !== null) {
        $this->rows[$this->editingRow] = $row;
        unset($this->rowErrors[$this->editingRow]);
    } else {
        $this->rows[] = $row;
    }

    $this->finishEdit();
    unset($this->lookups, $this->total);
};

/** Clear only the item fields (the light-blue card). */
$clearItemFields = function () {
    $this->fill([
        'amount' => '', 'item_description' => '', 'reference' => '', 'received_by' => '', 'receipt' => null, 'notes' => '',
        'editingRow' => null, 'rowReceiptPath' => null, 'rowReceiptName' => null,
    ]);
    $this->resetErrorBag();
};

/** Leave row-edit mode: restore the payment details held when the edit started, clear the item fields. */
$finishEdit = function () {
    if ($this->heldBatch !== null) {
        $this->fill($this->heldBatch);
        $this->heldBatch = null;
        unset($this->accountOptions);
    }
    $this->clearItemFields();
    unset($this->position, $this->agentHolds, $this->supplierOwed);
};

$editRow = function (int $i) {
    if (! isset($this->rows[$i])) {
        return;
    }
    if ($this->editingRow === null) {
        $this->heldBatch = $this->only(PaymentRules::BATCH_FIELDS);
    }
    $row = $this->rows[$i];
    $this->clearItemFields();
    $this->fill(Arr::only($row, [...PaymentRules::BATCH_FIELDS, ...PaymentRules::ITEM_FIELDS]));
    $this->fill(['editingRow' => $i, 'rowReceiptPath' => $row['receipt_path'], 'rowReceiptName' => $row['receipt_name']]);
    unset($this->accountOptions, $this->position, $this->agentHolds, $this->supplierOwed);
};

$cancelEdit = function () {
    $this->finishEdit();
};

$removeRow = function (int $i) {
    if (! isset($this->rows[$i])) {
        return;
    }
    if ($path = $this->rows[$i]['receipt_path']) {
        Storage::disk('local')->delete($path);
    }
    if ($this->editingRow === $i) {
        $this->finishEdit();
    } elseif ($this->editingRow !== null && $this->editingRow > $i) {
        $this->editingRow--;
    }

    array_splice($this->rows, $i, 1);
    $errors = [];
    foreach ($this->rowErrors as $k => $msg) {
        if ($k != $i) {
            $errors[$k > $i ? $k - 1 : $k] = $msg;
        }
    }
    $this->rowErrors = $errors;
    unset($this->lookups, $this->total, $this->position, $this->agentHolds);
};

$saveAll = function () {
    if ($this->editingRow !== null) {
        $this->toast('error', 'Finish editing row '.($this->editingRow + 1).' first: Update row or Cancel.');

        return;
    }
    if ($this->rows === []) {
        $this->toast('error', 'Add at least one payment to the table first.');

        return;
    }

    // Re-check every row as the form would; nothing is saved unless all of them pass.
    $this->rowErrors = [];
    foreach ($this->rows as $i => $row) {
        $rules = PaymentRules::rules($row, ! $this->isAdmin, false) + ['receipt_path' => ['nullable', 'string', 'starts_with:receipts/', 'not_regex:/\.\./']];
        $v = Validator::make($row, $rules, PaymentRules::messages(), PaymentRules::attributes());
        if ($v->fails()) {
            $this->rowErrors[$i] = $v->errors()->first();
        }
    }

    if ($this->rowErrors === []) {
        try {
            $rows = array_map(fn ($r) => Arr::except($r, ['receipt_name']), $this->rows);
            app(PaymentService::class)->savePayments($rows, auth()->user());
        } catch (BusinessRuleException $e) {
            // A row's own problem names the row; a total-level one (e.g. not enough cash) does not.
            if (Str::startsWith((string) $e->field, 'rows.')) {
                $this->rowErrors[(int) Str::after($e->field, 'rows.')] = $e->getMessage();
            } else {
                $this->toast('error', 'Nothing was saved. '.$e->getMessage());

                return;
            }
        }
    }

    if ($this->rowErrors !== []) {
        $first = array_key_first($this->rowErrors);
        $this->toast('error', 'Nothing was saved. Row '.($first + 1).': '.$this->rowErrors[$first]);

        return;
    }

    // Stay on the page for the next batch: empty table, payment details kept.
    $count = count($this->rows);
    $total = $this->total;
    $this->rows = [];
    $this->rowErrors = [];
    $this->clearItemFields();
    unset($this->lookups, $this->total, $this->position, $this->agentHolds, $this->supplierOwed, $this->companyOptions, $this->accountOptions);
    $this->toast('success', $count.' '.Str::plural('payment', $count).' of '.money($total).' saved.');
    $this->broadcastChange();
};

?>

@php
    // Page: payment details four a row (department on its own row), item details six a row; modal: two a row.
    $colBatch = $asPage ? 'col-lg-3 col-sm-6' : 'col-md-6';
    $colWide = $asPage ? 'col-12' : 'col-md-6';
    $colItem = $asPage ? 'col-xl-2 col-lg-4 col-sm-6' : 'col-md-6';
    $label = $asPage ? 'form-label fw-semibold fs-13 mb-1' : 'form-label fs-12 mb-1';
    $req = '<span class="text-danger">*</span>';
    $isAgent = ! $this->isAdmin;
    $describe = fn ($b) => Money::isNegative($b) ? 'you hold '.money(Money::sub(0, $b)) : (Money::isZero($b) ? 'settled' : 'owes you '.money($b));
@endphp

{{-- The fields are written once and placed into two cards (page) or one list (modal). --}}
@php(ob_start())
    {{-- 1. Date --}}
    <div class="{{ $colBatch }}">
        <label class="{{ $label }}">Date {!! $req !!}</label>
        <input type="date" class="form-control form-control-sm @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 2. Type --}}
    <div class="{{ $asPage ? 'col-lg-3 col-sm-6' : 'col-md-6' }}">
        <label class="{{ $label }}">Type {!! $req !!}</label>
        @if ($isAgent)
            <div class="form-control form-control-sm bg-body-tertiary"><i class="ri-bank-line me-1"></i>Bank transfer from your bank</div>
        @else
            <div class="btn-group btn-group-sm w-100" role="group" aria-label="Payment type">
                @foreach (PaymentMethod::cases() as $m)
                    <input type="radio" class="btn-check" id="pm-{{ $asPage ? 'p' : 'm' }}-{{ $m->value }}" value="{{ $m->value }}" wire:model.live="method">
                    <label class="btn btn-outline-primary" for="pm-{{ $asPage ? 'p' : 'm' }}-{{ $m->value }}" title="{{ $m->hint() }}"><i class="{{ $m->icon() }} me-1"></i>{{ match ($m) { PaymentMethod::Cash => 'Cash', PaymentMethod::BankTransfer => 'Bank', PaymentMethod::Goods => 'Goods' } }}</label>
                @endforeach
            </div>
        @endif
        @error('method') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    {{-- 3. Where the money came from --}}
    @if ($method === 'cash' && ! $isAgent)
        <div class="{{ $asPage ? 'col-lg-6' : 'col-md-6' }}">
            <label class="{{ $label }}">Paid from</label>
            <div class="form-control form-control-sm bg-body-tertiary ams-balance">
                <i class="ri-wallet-3-line me-1"></i>Admin cash in hand · <strong>{{ money($this->cashAccount->current_balance) }}</strong>
                <span class="text-muted fs-11 ms-1">no company</span>
            </div>
        </div>
    @else
        <div class="{{ $colBatch }}">
            <label class="{{ $label }}">{{ $isAgent ? 'For company' : 'Company' }} {!! $req !!}</label>
            <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" size="sm" :invalid="$errors->has('company_id')" />
            @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            @if ($this->agentHolds !== null)
                <div class="form-text fs-11 mt-0 ams-balance">
                    @if (Money::isNegative($this->agentHolds))
                        The company owes you {{ money(Money::sub(0, $this->agentHolds)) }}
                    @else
                        You hold {{ money($this->agentHolds) }} of its money
                    @endif
                    @if (is_numeric($amount) && $amount > 0)
                        → {{ Money::isNegative($h = Money::sub($this->agentHolds, $amount)) ? 'it owes you '.money(Money::sub(0, $h)) : money($h).' left' }}
                    @endif
                </div>
            @endif
        </div>

        @if ($method === 'goods')
            <div class="{{ $colBatch }}">
                <label class="{{ $label }} d-flex justify-content-between">
                    <span>Supplier {!! $req !!}</span>
                    <a href="#" class="fs-11 fw-normal" wire:click.prevent="$toggle('addingSupplier')">{{ $addingSupplier ? 'Cancel' : '+ New supplier' }}</a>
                </label>
                @if ($addingSupplier)
                    <div class="input-group input-group-sm has-validation">
                        <input type="text" class="form-control @error('newSupplier') is-invalid @enderror" wire:model="newSupplier" placeholder="Supplier name" wire:keydown.enter.prevent="addSupplier">
                        <button type="button" class="btn btn-primary" wire:click="addSupplier">Add</button>
                        @error('newSupplier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @else
                    <x-searchable-select wire:model.live="supplier_id" :options="$this->supplierOptions" placeholder="Select supplier" size="sm" :invalid="$errors->has('supplier_id')" />
                    @error('supplier_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                @endif
                @if ($this->supplierOwed !== null && Money::isPositive($this->supplierOwed))
                    <div class="form-text fs-11 mt-0">This company already owes them {{ money($this->supplierOwed) }}</div>
                @endif
            </div>
            <div class="{{ $colBatch }}">
                <label class="{{ $label }}">Paid</label>
                <div class="btn-group btn-group-sm w-100" role="group">
                    <input type="radio" class="btn-check" id="credit-{{ $asPage ? 'p' : 'm' }}-0" wire:model.live="on_credit" value="0">
                    <label class="btn btn-outline-primary" for="credit-{{ $asPage ? 'p' : 'm' }}-0"><i class="ri-bank-line me-1"></i>From bank</label>
                    <input type="radio" class="btn-check" id="credit-{{ $asPage ? 'p' : 'm' }}-1" wire:model.live="on_credit" value="1">
                    <label class="btn btn-outline-warning" for="credit-{{ $asPage ? 'p' : 'm' }}-1"><i class="ri-time-line me-1"></i>On credit</label>
                </div>
            </div>
        @endif

        @if ($method === 'bank_transfer' || ($method === 'goods' && ! $on_credit))
            <div class="{{ $colBatch }}">
                <label class="{{ $label }}">{{ $isAgent ? 'Your bank' : 'Bank' }} {!! $req !!}</label>
                <x-searchable-select wire:model.live="account_id" :options="$this->accountOptions" size="sm"
                    :placeholder="$isAgent ? (count($this->accountOptions) ? 'Select your bank' : 'No bank account') : (! $company_id ? 'Select a company first' : (count($this->accountOptions) ? 'Select bank' : 'No bank account'))"
                    :disabled="! $isAgent && ! $company_id" :invalid="$errors->has('account_id')" />
                @error('account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                @if ($isAgent && ! count($this->accountOptions))
                    <div class="form-text fs-11 mt-0"><a href="{{ route('my-accounts') }}">Add your bank account</a> first.</div>
                @elseif (! $isAgent && $company_id && ! count($this->accountOptions))
                    <div class="form-text fs-11 mt-0"><a href="{{ route('accounts.index') }}">Add a bank account</a> first.</div>
                @endif
            </div>
        @endif
    @endif

    {{-- 4. Department, on its own row --}}
    <div class="{{ $colWide }}">
        <label class="{{ $label }} d-flex justify-content-between">
            <span>Department {!! $req !!}</span>
            @if (! $isAgent)
                <a href="#" class="fs-11 fw-normal" wire:click.prevent="$toggle('addingDepartment')">{{ $addingDepartment ? 'Cancel' : '+ New department' }}</a>
            @endif
        </label>
        @if ($addingDepartment)
            <div class="input-group input-group-sm has-validation">
                <input type="text" class="form-control @error('newDepartment') is-invalid @enderror" wire:model="newDepartment" placeholder="Department name" wire:keydown.enter.prevent="addDepartment">
                <button type="button" class="btn btn-primary" wire:click="addDepartment">Add</button>
                @error('newDepartment') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        @else
            <x-searchable-select wire:model.live="department_id" :options="$this->departmentOptions" placeholder="Select department" size="sm" :invalid="$errors->has('department_id')" />
            @error('department_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        @endif
        @if ($this->position !== null && ! $addingDepartment && ! $isAgent)
            <div class="form-text fs-11 mt-0 ams-balance" title="Department balance {{ $method === 'cash' ? 'with no company (cash)' : 'with this company' }}{{ $rows ? ', including the payments in the table' : '' }}">
                {{ $method === 'cash' ? 'Cash (no company): ' : '' }}{{ ucfirst($describe($this->position)) }}
                @if (is_numeric($amount) && $amount > 0)
                    → {{ $describe(Money::add($this->position, $amount)) }}
                @endif
            </div>
        @endif
    </div>
@php($batchFields = ob_get_clean())

@php(ob_start())
    {{-- 5. Amount --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Amount {!! $req !!}</label>
        <div class="input-group input-group-sm has-validation">
            <span class="input-group-text">Rs.</span>
            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model.live.debounce.400ms="amount" placeholder="0.00">
            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    {{-- 6. Description --}}
    <div class="{{ $asPage ? 'col-xl-4 col-lg-8' : 'col-md-6' }}">
        <label class="{{ $label }}">{{ $method === 'goods' ? 'Items bought' : 'Description' }} @if ($method === 'goods'){!! $req !!}@endif</label>
        <input type="text" class="form-control form-control-sm @error('item_description') is-invalid @enderror" wire:model="item_description"
            placeholder="{{ $method === 'goods' ? 'e.g. 20 office chairs, 5 printers' : 'What the money was for' }}">
        @error('item_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 7. Reference --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Reference / slip no.</label>
        <input type="text" class="form-control form-control-sm @error('reference') is-invalid @enderror" wire:model="reference"
            placeholder="{{ $method === 'bank_transfer' ? 'IBFT / transaction ID' : ($method === 'goods' ? 'Invoice / bill no.' : 'Voucher / receipt no.') }}">
        @error('reference') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 8. Received by --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Received by</label>
        <input type="text" class="form-control form-control-sm @error('received_by') is-invalid @enderror" wire:model="received_by" placeholder="Person at the department">
        @error('received_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 9. Receipt picture --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Receipt picture</label>
        <input type="file" class="form-control form-control-sm @error('receipt') is-invalid @enderror" wire:model="receipt" accept=".jpg,.jpeg,.png,.pdf">
        <div wire:loading wire:target="receipt" class="form-text fs-11 mt-0"><i class="ri-loader-4-line"></i> Uploading…</div>
        @error('receipt') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if (! $receipt && $existingReceipt && $paymentId)
            <div class="form-text fs-11 mt-0"><a href="{{ route('files.show', ['payment', $paymentId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current receipt</a> — upload to replace</div>
        @elseif (! $receipt && $rowReceiptPath)
            <div class="form-text fs-11 mt-0 text-truncate"><i class="ri-attachment-2"></i> {{ $rowReceiptName }} — upload to replace</div>
        @endif
    </div>

    {{-- 10. Notes --}}
    <div class="{{ $asPage ? 'col-12' : 'col-12' }}">
        <label class="{{ $label }}">Notes</label>
        <input type="text" class="form-control form-control-sm @error('notes') is-invalid @enderror" wire:model="notes" placeholder="Optional">
        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
@php($itemFields = ob_get_clean())

<div @if ($asPage) x-data x-on:beforeunload.window="if ($wire.rows.length) { $event.preventDefault(); $event.returnValue = ''; }" @endif>
    @if ($asPage)
        <form wire:submit="addRow" id="paymentFormPage">
            @error('general') <div class="alert alert-danger py-2">{{ $message }}</div> @enderror

            {{-- Payment details: stay the same from one payment to the next --}}
            <div class="card mb-3" id="paymentBatchDetails">
                <div class="card-header d-flex flex-wrap align-items-center gap-2 py-2">
                    <h5 class="card-title mb-0 me-auto d-flex align-items-center gap-2"><i class="ri-pushpin-line text-primary"></i>Payment details</h5>
                    <span class="fs-12 text-muted">Stay the same for every payment you add</span>
                </div>
                <div class="card-body">
                    @if ($editingRow !== null)
                        <div class="alert alert-warning py-2 fs-13 mb-2"><i class="ri-edit-line me-1"></i>Editing row {{ $editingRow + 1 }}: both cards show that row. <strong>Update row</strong> or <strong>Cancel</strong> brings your payment details back.</div>
                    @endif
                    <div class="row g-2">{!! $batchFields !!}</div>
                </div>
            </div>

            {{-- Item details: cleared after each "Add to table" --}}
            <div class="card mb-3 bg-primary-subtle border border-primary-subtle" id="paymentItemDetails">
                <div class="card-header d-flex flex-wrap align-items-center gap-2 py-2 bg-transparent border-primary-subtle">
                    <h5 class="card-title mb-0 me-auto d-flex align-items-center gap-2"><i class="ri-hand-coin-line text-primary"></i>Amount &amp; description</h5>
                    <span class="fs-12 text-muted">Cleared after each payment is added</span>
                </div>
                <div class="card-body">
                    <div class="row g-2">{!! $itemFields !!}</div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        @if ($editingRow !== null)
                            <button type="button" class="btn btn-sm btn-light" wire:click="cancelEdit">Cancel</button>
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary px-4" wire:loading.attr="disabled" wire:target="addRow,receipt">
                            <span wire:loading.remove wire:target="addRow">
                                <i class="{{ $editingRow !== null ? 'ri-check-line' : 'ri-add-line' }} me-1"></i>{{ $editingRow !== null ? 'Update row '.($editingRow + 1) : 'Add to table' }}
                            </span>
                            <span wire:loading wire:target="addRow"><i class="ri-loader-4-line me-1"></i>Checking…</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Payments waiting to be saved --}}
        <div class="card" id="paymentBatch">
            <div class="card-header d-flex align-items-center gap-2">
                <h5 class="card-title mb-0 me-auto">Payments to save <span class="badge bg-primary-subtle text-primary ms-1">{{ count($rows) }}</span></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 fs-13">
                    <thead class="table-light">
                        <tr>
                            <th>#</th><th>Date</th><th>Type</th><th>Company</th><th>Paid from</th><th>Department</th>
                            <th class="money text-end">Amount</th><th>Description</th><th>Ref / received by</th><th>Receipt</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $i => $row)
                            @php($error = $rowErrors[$i] ?? null)
                            @php($m = PaymentMethod::from($row['method']))
                            <tr wire:key="prow-{{ $i }}-{{ $row['amount'] }}" class="{{ $error ? 'table-danger' : ($editingRow === $i ? 'table-warning' : '') }}">
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ \Illuminate\Support\Carbon::parse($row['date'])->format('d M Y') }}</td>
                                <td><span class="badge {{ $m->badge() }}">{{ $m->label() }}</span></td>
                                <td>{{ $row['company_id'] ? ($this->lookups['companies'][$row['company_id']] ?? '—') : 'No company' }}</td>
                                <td class="text-nowrap">
                                    @if ($m === PaymentMethod::Goods)
                                        {{ $this->lookups['suppliers'][$row['supplier_id']] ?? '—' }}
                                        <div class="fs-11 text-muted">{{ $row['on_credit'] ? 'On credit' : ($this->lookups['accounts'][$row['account_id']] ?? '') }}</div>
                                    @else
                                        {{ $this->lookups['accounts'][$row['account_id']] ?? '—' }}
                                    @endif
                                </td>
                                <td>{{ $this->lookups['departments'][$row['department_id']] ?? '—' }}</td>
                                <td class="money text-end text-nowrap fw-semibold">{{ money($row['amount']) }}</td>
                                <td class="text-truncate" style="max-width: 14rem" title="{{ $row['item_description'] }}">{{ $row['item_description'] ?: '—' }}</td>
                                <td class="text-truncate" style="max-width: 12rem" title="{{ trim($row['reference'].' '.$row['received_by'].' '.$row['notes']) }}">
                                    {{ collect([$row['reference'] ? 'Ref '.$row['reference'] : null, $row['received_by'] ? 'by '.$row['received_by'] : null])->filter()->implode(' · ') ?: '—' }}
                                </td>
                                <td>@if ($row['receipt_path'])<i class="ri-image-line text-primary" title="{{ $row['receipt_name'] }}"></i>@else<span class="text-muted">—</span>@endif</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-icon btn-light" wire:click="editRow({{ $i }})" title="Edit"><i class="ri-pencil-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-icon btn-light text-danger" wire:click="removeRow({{ $i }})" wire:confirm="Remove this payment of {{ money($row['amount']) }} from the table?" title="Remove"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            @if ($error)
                                <tr class="table-danger" wire:key="prow-error-{{ $i }}">
                                    <td></td>
                                    <td colspan="10" class="text-danger fs-12 pt-0"><i class="ri-error-warning-line me-1"></i>{{ $error }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-4">
                                    <i class="ri-inbox-line fs-24 d-block mb-1 opacity-50"></i>
                                    Fill in the amount and description and click <strong>Add to table</strong>. Add as many as you need, then save them together.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($rows)
                        <tfoot class="table-light fw-semibold">
                            <tr>
                                <td colspan="6" class="text-end">Total ({{ count($rows) }} {{ Str::plural('payment', count($rows)) }})</td>
                                <td class="money text-end text-nowrap">{{ money($this->total) }}</td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            <div class="card-footer d-flex flex-wrap align-items-center justify-content-end gap-2">
                <a href="{{ route('payments.index') }}" class="btn btn-light me-auto"
                    @if ($rows) x-on:click="if (! confirm('Leave without saving the payments in the table?')) $event.preventDefault()" @endif>Back to payments</a>
                <button type="button" class="btn btn-primary" wire:click="saveAll" wire:loading.attr="disabled" wire:target="saveAll,addRow,receipt" @disabled(! $rows)>
                    <span wire:loading.remove wire:target="saveAll"><i class="ri-save-3-line me-1"></i>Save all</span>
                    <span wire:loading wire:target="saveAll"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </div>
    @else
        <x-modal id="paymentModal" :title="$paymentId ? ($this->isAdmin ? 'Edit Department Payment' : 'Request a Change to this Payment') : 'Pay a Department'" icon="ri-hand-coin-line" size="lg">
            <form wire:submit="save">
                <div class="modal-body">
                    @error('general') <div class="alert alert-danger py-2">{{ $message }}</div> @enderror

                    @unless ($paymentId)
                        <div class="d-flex justify-content-end fs-12 mb-2">
                            <a href="{{ route('payments.create', array_filter(['company' => $company_id, 'department' => $department_id, 'method' => $this->isAdmin ? $method : null])) }}"><i class="ri-external-link-line"></i> Open as full page</a>
                        </div>
                    @endunless

                    @if ($paymentId && ! $this->isAdmin)
                        <div class="alert alert-info py-2 fs-13 mb-2"><i class="ri-shield-check-line me-1"></i>Your changes go to the admin for approval. The payment stays as it is until then.</div>
                    @endif

                    <div class="row g-2">{!! $batchFields !!}{!! $itemFields !!}</div>

                    @if ($paymentId && ! $this->isAdmin)
                        <div class="mt-2">
                            <label class="form-label fs-12 mb-1">Why the change? <span class="text-muted">(optional, shown to the admin)</span></label>
                            <input type="text" class="form-control form-control-sm" wire:model="changeReason" maxlength="500" placeholder="e.g. Wrong amount entered">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,receipt">
                        <span wire:loading.remove wire:target="save"><i class="ri-save-3-line me-1"></i>{{ $paymentId ? ($this->isAdmin ? 'Save changes' : 'Send for approval') : 'Save payment' }}</span>
                        <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                    </button>
                </div>
            </form>
        </x-modal>
    @endif
</div>
