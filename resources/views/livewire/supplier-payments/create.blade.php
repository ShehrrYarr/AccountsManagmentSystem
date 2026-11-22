<?php

/**
 * Paying a supplier what is owed for goods bought on credit: cash from the admin's cash in hand
 * (no company) or a bank transfer from a company bank. Admin only.
 *
 * As a modal (one payment at a time, also used to edit):
 *     $dispatch('supplier-payment-create', { companyId: 1, supplierId: 3 })   (both optional)
 *     $dispatch('supplier-payment-edit', { id: 9 })
 * As a page (batch entry): <livewire:supplier-payments.create :as-page="true" />  (route
 *     supplier-payments.create, prefilled from ?company=1&supplier=3). The white "payment details"
 *     card (date, type, company, bank, supplier) stays filled; the light-blue card (amount,
 *     reference, receipt, notes) clears after each "Add to table". "Save all" saves the table
 *     together, all-or-nothing, and stays here. The unsaved form and table are kept in the
 *     browser (KeepsDraft) and come back after a reload.
 */

use App\Exceptions\BusinessRuleException;
use App\Livewire\Concerns\HasTaxFields;
use App\Livewire\Concerns\InteractsWithUi;
use App\Livewire\Concerns\KeepsDraft;
use App\Models\Account;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Services\Balances;
use App\Services\PaymentService;
use App\Support\Money;
use App\Support\Options;
use App\Support\SupplierPaymentRules;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Livewire\Volt\{computed, mount, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class, KeepsDraft::class, HasTaxFields::class]);
usesFileUploads();

state(['recordId' => null, 'asPage' => false])->locked();

state([
    // Payment details (stay the same from one payment to the next on the page).
    'date' => '',
    'method' => 'cash',
    'company_id' => null,
    'account_id' => null,
    'supplier_id' => null,
    // Item details (cleared after each "Add to table").
    'amount' => '',
    'reference' => '',
    'receipt' => null,
    'notes' => '',

    'existingReceipt' => false,   // modal edit: the saved payment has a receipt

    // Page (batch) mode.
    'rows' => [],
    'editingRow' => null,
    'rowReceiptPath' => null,
    'rowReceiptName' => null,
    'rowErrors' => [],
    'heldBatch' => null,
]);

rules(fn () => SupplierPaymentRules::rules($this->method))
    ->messages(SupplierPaymentRules::messages())->attributes(SupplierPaymentRules::attributes());

$companyOptions = computed(fn () => Options::companies($this->company_id));
$supplierOptions = computed(fn () => Options::suppliers($this->supplier_id));
$accountOptions = computed(fn () => $this->method === 'bank_transfer' && $this->company_id ? Options::accounts((int) $this->company_id, 'bank', $this->account_id) : []);
$cashAccount = computed(fn () => Account::adminCash());

// Names for the batch table.
$lookups = computed(function () {
    $rows = collect($this->rows);

    return [
        'companies' => Company::withTrashed()->whereIn('id', $rows->pluck('company_id')->filter())->pluck('name', 'id'),
        'accounts' => Account::withTrashed()->whereIn('id', $rows->pluck('account_id')->filter())->get()->mapWithKeys(fn ($a) => [$a->id => $a->shortLabel()]),
        'suppliers' => Supplier::whereIn('id', $rows->pluck('supplier_id'))->pluck('name', 'id'),
        'taxes' => \App\Models\Tax::whereIn('id', $rows->pluck('taxes')->flatten(1)->pluck('tax_id')->filter())->pluck('name', 'id'),
    ];
});

$total = computed(fn () => Money::add('0', ...array_column($this->rows, 'amount')));

/** Pick the only (page: the first) bank of the company when the list has one to offer. */
$pickAccount = function () {
    unset($this->accountOptions);
    $options = $this->accountOptions;
    if (! collect($options)->contains('value', $this->account_id)) {
        $this->account_id = ($this->asPage || count($options) === 1) ? ($options[0]['value'] ?? null) : null;
    }
};

$updatedCompanyId = function () {
    $this->account_id = null;
    $this->pickAccount();
};

$updatedMethod = function () {
    if (! in_array($this->method, SupplierPaymentRules::METHODS, true)) {
        $this->method = 'cash';
    }
    if ($this->method === 'cash') {
        $this->fill(['company_id' => null, 'account_id' => null, 'taxes' => []]); // taxes only leave a bank
    }
    $this->pickAccount();
    $this->resetErrorBag();
};

$resetForm = function () {
    $this->fill([
        'date' => now()->toDateString(), 'method' => 'cash', 'company_id' => null, 'account_id' => null, 'supplier_id' => null,
        'amount' => '', 'taxes' => [], 'addingTax' => false, 'newTax' => '', 'reference' => '', 'receipt' => null, 'notes' => '', 'existingReceipt' => false,
        'editingRow' => null, 'rowReceiptPath' => null, 'rowReceiptName' => null, 'heldBatch' => null,
    ]);
    $this->recordId = null;
    $this->resetErrorBag();
    unset($this->accountOptions);
};

// Opened for a company: a bank transfer from its bank; otherwise cash.
$startNew = function (?int $companyId = null, ?int $supplierId = null) {
    $this->resetForm();
    if ($companyId) {
        $this->fill(['method' => 'bank_transfer', 'company_id' => $companyId]);
    }
    $this->supplier_id = $supplierId;
    $this->pickAccount();
};

// The page opens with today's date and the first supplier, unless ?company= / ?supplier= say otherwise.
mount(function (bool $asPage = false, $company = null, $supplier = null) {
    abort_unless(auth()->user()?->isAdmin(), 403);
    $this->asPage = $asPage;
    if ($this->asPage) {
        $id = fn ($v) => ctype_digit((string) $v) ? (int) $v : null;
        $this->startNew($id($company), $id($supplier) ?? ($this->supplierOptions[0]['value'] ?? null));
        unset($this->supplierOptions);
        $this->newDraftToken();
    }
});

on(['supplier-payment-create' => function (?int $companyId = null, ?int $supplierId = null) {
    if ($this->asPage) {
        return; // the page form is always open; the modal instance handles this event
    }
    $this->startNew($companyId, $supplierId);
    $this->showModal('supplierPaymentModal');
}]);

on(['supplier-payment-edit' => function (int $id) {
    if ($this->asPage) {
        return;
    }
    $p = SupplierPayment::with('account')->findOrFail($id);
    $this->resetForm();
    $this->recordId = $p->id;
    $this->fill([
        'date' => $p->date->toDateString(),
        'method' => $p->company_id ? 'bank_transfer' : 'cash',
        'company_id' => $p->company_id,
        'account_id' => $p->company_id ? $p->account_id : null,
        'supplier_id' => $p->supplier_id,
        'amount' => $p->amount,
        'reference' => $p->reference ?? '',
        'notes' => $p->notes ?? '',
        'existingReceipt' => (bool) $p->receipt_path,
        'taxes' => $this->taxRowsOf($p),
    ]);
    unset($this->accountOptions);
    $this->showModal('supplierPaymentModal');
}]);

on(['transaction-updated' => function () {
    unset($this->cashAccount);
}]);

/** A form or table row as the service takes it: cash is the admin's cash in hand. */
$serviceData = fn (array $values) => [
    'supplier_id' => (int) $values['supplier_id'],
    'company_id' => $values['method'] === 'cash' ? null : $values['company_id'],
    'account_id' => $values['method'] === 'cash' ? Account::adminCash()->id : $values['account_id'],
    'amount' => $values['amount'],
    'date' => $values['date'],
    'reference' => filled($values['reference'] ?? null) ? trim($values['reference']) : null,
    'notes' => filled($values['notes'] ?? null) ? trim($values['notes']) : null,
    'receipt_path' => $values['receipt_path'] ?? null,
    'taxes' => $values['method'] === 'cash' ? [] : ($values['taxes'] ?? []),
];

$formValues = fn () => $this->only([...SupplierPaymentRules::BATCH_FIELDS, ...SupplierPaymentRules::ITEM_FIELDS]);

// ── Modal: save one payment ───────────────────────────────────────────────────────────

$save = function () {
    $this->validate();
    $data = $this->serviceData($this->formValues());
    $data['receipt_path'] = $this->storeUpload($this->receipt, 'receipts');
    $old = $this->recordId ? SupplierPayment::find($this->recordId)?->receipt_path : null;

    $ok = $this->attempt(function () use ($data) {
        $p = app(PaymentService::class)->saveSupplierPayment($this->recordId ? SupplierPayment::findOrFail($this->recordId) : null, $data);
        $this->toast('success', ($this->recordId ? 'Updated: ' : 'Paid ').money($p->amount).' to '.$p->supplier->name.'.');
    });

    if ($ok === false) {
        if ($data['receipt_path']) {
            Storage::disk('local')->delete($data['receipt_path']);
        }

        return;
    }
    if ($data['receipt_path'] && $old) {
        Storage::disk('local')->delete($old); // replaced
    }
    $this->hideModal('supplierPaymentModal');
    $this->broadcastChange();
    $this->resetForm();
};

// ── Page: build a table of payments, then save them together ───────────────────────────

/** Why this row would pay the supplier more than is owed (with the other table rows), or null. */
$overpaid = function (array $row) {
    $supplierId = (int) $row['supplier_id'];
    $others = collect($this->rows)->except([$this->editingRow ?? -1])->where('supplier_id', $supplierId);
    $name = Supplier::find($supplierId)?->name ?? 'the supplier';
    $after = $others->isNotEmpty() ? ' after the table' : '';

    $left = Money::sub(Balances::supplierOwed($supplierId), Money::add('0', ...$others->pluck('amount')->all()));
    if (Money::cmp($row['amount'], $left) > 0) {
        return 'That is more than is owed to '.$name.' in total ('.money(Money::isNegative($left) ? 0 : $left).' left'.$after.').';
    }
    if ($row['company_id']) {
        $same = $others->where('company_id', (int) $row['company_id']);
        $left = Money::sub(Balances::supplierOwed($supplierId, (int) $row['company_id']), Money::add('0', ...$same->pluck('amount')->all()));
        if (Money::cmp($row['amount'], $left) > 0) {
            return 'That is more than '.(Company::find($row['company_id'])?->name ?? 'the company').' owes '.$name.' ('.money(Money::isNegative($left) ? 0 : $left).' left'.$after.').';
        }
    }

    return null;
};

$addRow = function () {
    $this->validate();
    $values = $this->formValues();

    $checked = $this->attempt(fn () => app(PaymentService::class)->checkSupplierPayment($this->serviceData($values)));
    if ($checked === false) {
        return;
    }

    $row = array_merge($values, [
        'company_id' => $checked->company_id ? (int) $checked->company_id : null,
        'account_id' => $values['method'] === 'cash' ? null : (int) $checked->account_id,
        'supplier_id' => (int) $values['supplier_id'],
        'amount' => Money::of($values['amount']),
        'reference' => trim((string) $values['reference']),
        'notes' => trim((string) $values['notes']),
        'taxes' => $checked->pendingTaxes ?? [],
    ]);
    if ($why = $this->overpaid($row)) {
        $this->addError('amount', $why);

        return;
    }

    $receiptPath = $this->rowReceiptPath;
    $receiptName = $this->rowReceiptName;
    if ($this->receipt) {
        if ($receiptPath) {
            Storage::disk('local')->delete($receiptPath); // replaced
            $this->forgetDraftFiles([$receiptPath]);
        }
        $receiptName = $this->receipt->getClientOriginalName();
        $receiptPath = $this->storeUpload($this->receipt, 'receipts');
        $this->rememberDraftFile($receiptPath);
    }
    $row += ['receipt_path' => $receiptPath, 'receipt_name' => $receiptName];

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
        'amount' => '', 'taxes' => [], 'addingTax' => false, 'newTax' => '', 'reference' => '', 'receipt' => null, 'notes' => '',
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
};

$editRow = function (int $i) {
    if (! isset($this->rows[$i])) {
        return;
    }
    if ($this->editingRow === null) {
        $this->heldBatch = $this->only(SupplierPaymentRules::BATCH_FIELDS);
    }
    $row = $this->rows[$i];
    $this->clearItemFields();
    $this->fill(Arr::only($row, [...SupplierPaymentRules::BATCH_FIELDS, ...SupplierPaymentRules::ITEM_FIELDS]));
    $this->fill(['editingRow' => $i, 'rowReceiptPath' => $row['receipt_path'], 'rowReceiptName' => $row['receipt_name']]);
    unset($this->accountOptions);
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
        $this->forgetDraftFiles([$path]);
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
    unset($this->lookups, $this->total);
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
        $rules = SupplierPaymentRules::rules($row['method'] ?? null, false) + ['receipt_path' => ['nullable', 'string', 'starts_with:receipts/', 'not_regex:/\.\./']];
        $v = Validator::make($row, $rules, SupplierPaymentRules::messages(), SupplierPaymentRules::attributes());
        if ($v->fails()) {
            $this->rowErrors[$i] = $v->errors()->first();
        }
    }

    if ($this->rowErrors === []) {
        try {
            app(PaymentService::class)->saveSupplierPayments(array_map(fn ($r) => $this->serviceData($r), $this->rows));
        } catch (BusinessRuleException $e) {
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
    $this->markDraftSaved(array_column($this->rows, 'receipt_path'));
    $this->rows = [];
    $this->rowErrors = [];
    $this->clearItemFields();
    unset($this->lookups, $this->total, $this->cashAccount, $this->accountOptions);
    $this->toast('success', $count.' supplier '.Str::plural('payment', $count).' of '.money($total).' saved.');
    $this->broadcastChange();
};

// ── Page: the browser's copy of the unsaved form and table ─────────────────────────────

/** Put back what the browser kept. Returns whether anything was restored. */
$restoreDraft = function (array $draft) {
    abort_unless($this->asPage, 404);
    if ($this->draftWasSaved($draft['draftToken'] ?? null)) {
        return ['restored' => false]; // this batch was saved already
    }

    $batch = function (array $d) {
        $cash = ($d['method'] ?? 'cash') !== 'bank_transfer';

        return [
            'date' => $this->draftDate($d['date'] ?? null),
            'method' => $cash ? 'cash' : 'bank_transfer',
            'company_id' => $cash ? null : $this->draftId($d['company_id'] ?? null),
            'account_id' => $cash ? null : $this->draftId($d['account_id'] ?? null),
            'supplier_id' => $this->draftId($d['supplier_id'] ?? null),
        ];
    };
    $item = fn (array $d) => [
        'amount' => $this->draftAmount($d['amount'] ?? null),
        'taxes' => ($d['method'] ?? 'cash') === 'bank_transfer' ? $this->cleanTaxRows($d['taxes'] ?? []) : [],
        'reference' => $this->draftText($d['reference'] ?? ''),
        'notes' => $this->draftText($d['notes'] ?? '', 2000),
    ];

    $rows = [];
    foreach ($this->draftRows($draft['rows'] ?? null) as $r) {
        $row = $batch($r) + $item($r);
        if ($row['date'] === '' || $row['amount'] === '' || ! $row['supplier_id']) {
            continue;
        }
        $path = $this->draftFile($r['receipt_path'] ?? null, 'receipts');
        $rows[] = array_merge($row, [
            'amount' => Money::of($row['amount']),
            'receipt_path' => $path,
            'receipt_name' => $path ? $this->draftText($r['receipt_name'] ?? '') : null,
        ]);
    }

    $editing = is_int($draft['editingRow'] ?? null) && isset($rows[$draft['editingRow']]) ? $draft['editingRow'] : null;
    $rowReceipt = $editing !== null ? $this->draftFile($draft['rowReceiptPath'] ?? null, 'receipts') : null;

    $this->fill($batch($draft) + $item($draft) + [
        'rows' => $rows,
        'rowErrors' => [],
        'editingRow' => $editing,
        'rowReceiptPath' => $rowReceipt,
        'rowReceiptName' => $rowReceipt ? $this->draftText($draft['rowReceiptName'] ?? '') : null,
        'heldBatch' => $editing !== null && is_array($draft['heldBatch'] ?? null) ? $batch($draft['heldBatch']) : null,
    ]);
    if ($this->date === '') {
        $this->date = now()->toDateString();
    }
    if (is_string($draft['draftToken'] ?? null) && Str::isUuid($draft['draftToken'])) {
        $this->draftToken = $draft['draftToken'];
    }
    $this->resetErrorBag();
    unset($this->accountOptions, $this->companyOptions, $this->supplierOptions, $this->lookups, $this->total);

    return ['restored' => true];
};

/** "Discard": empty the table (deleting its receipts) and the item fields; the payment details stay. */
$discardDraft = function () {
    abort_unless($this->asPage, 404);
    $this->deleteDraftFiles(array_column($this->rows, 'receipt_path'), 'receipts');
    $this->rows = [];
    $this->rowErrors = [];
    $this->finishEdit();
    $this->newDraftToken();
    unset($this->lookups, $this->total);
};

?>

@php
    // Page: payment details four a row (supplier on its own row), item details four a row; modal: two a row.
    $colBatch = $asPage ? 'col-lg-3 col-sm-6' : 'col-md-6';
    $colWide = $asPage ? 'col-12' : 'col-md-6';
    $colItem = $asPage ? 'col-xl-3 col-sm-6' : 'col-md-6';
    $label = $asPage ? 'form-label fw-semibold fs-13 mb-1' : 'form-label fs-12 mb-1';
    $req = '<span class="text-danger">*</span>';
    $uid = $asPage ? 'p' : 'm';
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
    <div class="{{ $colBatch }}">
        <label class="{{ $label }}">Type {!! $req !!}</label>
        <div class="btn-group btn-group-sm w-100" role="group" aria-label="Payment type">
            <input type="radio" class="btn-check" id="spm-{{ $uid }}-cash" value="cash" wire:model.live="method">
            <label class="btn btn-outline-primary" for="spm-{{ $uid }}-cash"><i class="ri-money-dollar-circle-line me-1"></i>Cash</label>
            <input type="radio" class="btn-check" id="spm-{{ $uid }}-bank" value="bank_transfer" wire:model.live="method">
            <label class="btn btn-outline-primary" for="spm-{{ $uid }}-bank"><i class="ri-bank-line me-1"></i>Bank transfer</label>
        </div>
        @error('method') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    {{-- 3. Where the money came from --}}
    @if ($method === 'cash')
        <div class="{{ $asPage ? 'col-lg-6' : 'col-md-6' }}">
            <label class="{{ $label }}">Paid from</label>
            <div class="form-control form-control-sm bg-body-tertiary ams-balance">
                <i class="ri-wallet-3-line me-1"></i>Admin cash in hand · <strong>{{ money($this->cashAccount->current_balance) }}</strong>
                <span class="text-muted fs-11 ms-1">no company</span>
            </div>
        </div>
    @else
        <div class="{{ $colBatch }}">
            <label class="{{ $label }}">Company {!! $req !!}</label>
            <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" size="sm" :invalid="$errors->has('company_id')" />
            @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="{{ $colBatch }}">
            <label class="{{ $label }}">Bank {!! $req !!}</label>
            <x-searchable-select wire:model.live="account_id" :options="$this->accountOptions" size="sm"
                :placeholder="! $company_id ? 'Select a company first' : (count($this->accountOptions) ? 'Select bank' : 'No bank account')"
                :disabled="! $company_id" :invalid="$errors->has('account_id')" />
            @error('account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            @if ($company_id && ! count($this->accountOptions))
                <div class="form-text fs-11 mt-0"><a href="{{ route('accounts.index') }}">Add a bank account</a> first.</div>
            @endif
        </div>
    @endif

    {{-- 4. Supplier, on its own row --}}
    <div class="{{ $colWide }}">
        <label class="{{ $label }}">Supplier {!! $req !!}</label>
        <x-searchable-select wire:model.live="supplier_id" :options="$this->supplierOptions" placeholder="Select supplier" size="sm" :invalid="$errors->has('supplier_id')" />
        @error('supplier_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
@php($batchFields = ob_get_clean())

@php(ob_start())
    {{-- 5. Amount --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Amount {!! $req !!}</label>
        <div class="input-group input-group-sm has-validation">
            <span class="input-group-text">Rs.</span>
            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model="amount" placeholder="0.00">
            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    {{-- 6. Reference --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Reference</label>
        <input type="text" class="form-control form-control-sm @error('reference') is-invalid @enderror" wire:model="reference"
            placeholder="{{ $method === 'bank_transfer' ? 'Cheque no. / transfer ID' : 'Receipt / voucher no.' }}">
        @error('reference') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 7. Receipt picture --}}
    <div class="{{ $colItem }}">
        <label class="{{ $label }}">Receipt picture</label>
        <input type="file" class="form-control form-control-sm @error('receipt') is-invalid @enderror" wire:model="receipt" accept=".jpg,.jpeg,.png,.pdf">
        <div wire:loading wire:target="receipt" class="form-text fs-11 mt-0"><i class="ri-loader-4-line"></i> Uploading…</div>
        @error('receipt') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($receipt instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <div class="form-text fs-11 mt-0 text-truncate text-success"><i class="ri-attachment-2"></i> {{ $receipt->getClientOriginalName() }} attached</div>
        @elseif (! $receipt && $existingReceipt && $recordId)
            <div class="form-text fs-11 mt-0"><a href="{{ route('files.show', ['supplier-payment', $recordId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current receipt</a> — upload to replace</div>
        @elseif (! $receipt && $rowReceiptPath)
            <div class="form-text fs-11 mt-0 text-truncate"><i class="ri-attachment-2"></i> {{ $rowReceiptName }} — upload to replace</div>
        @endif
    </div>

    @if ($method === 'bank_transfer')
        @include('partials.payment-taxes', ['taxes' => $taxes, 'taxOptions' => $this->taxOptions(), 'label' => $label, 'addingTax' => $addingTax, 'canAddTax' => true, 'amount' => $amount])
    @endif

    {{-- 8. Notes --}}
    <div class="{{ $asPage ? 'col-xl-3 col-sm-6' : 'col-md-6' }}">
        <label class="{{ $label }}">Notes</label>
        <input type="text" class="form-control form-control-sm @error('notes') is-invalid @enderror" wire:model="notes" placeholder="Optional">
        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
@php($itemFields = ob_get_clean())

<div @if ($asPage) x-data="amsDraft(@js(['key' => 'ams-draft:'.auth()->id().':pay-supplier', 'file' => 'receipt', 'fields' => ['date', 'method', 'company_id', 'account_id', 'supplier_id', 'amount', 'taxes', 'reference', 'notes', 'rows', 'editingRow', 'rowReceiptPath', 'rowReceiptName', 'heldBatch', 'draftToken'], 'itemFields' => ['amount', 'taxes', 'reference', 'notes']]))" x-on:draft-saved.window="clear()" x-on:beforeunload.window="if ($wire.rows.length) { $event.preventDefault(); $event.returnValue = ''; }" @endif>
    @if ($asPage)
        @include('layouts.partials.form-draft-notice')
        <form wire:submit="addRow" id="supplierPaymentFormPage">
            @error('general') <div class="alert alert-danger py-2">{{ $message }}</div> @enderror

            {{-- Payment details: stay the same from one payment to the next --}}
            <div class="card mb-3" id="supplierPaymentBatchDetails">
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
            <div class="card mb-3 bg-primary-subtle border border-primary-subtle" id="supplierPaymentItemDetails">
                <div class="card-header d-flex flex-wrap align-items-center gap-2 py-2 bg-transparent border-primary-subtle">
                    <h5 class="card-title mb-0 me-auto d-flex align-items-center gap-2"><i class="ri-store-2-line text-primary"></i>Amount &amp; reference</h5>
                    <span class="fs-12 text-muted">Cleared after each payment is added</span>
                </div>
                <div class="card-body">
                    <div class="row g-2">{!! $itemFields !!}</div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        @if ($editingRow !== null)
                            <button type="button" class="btn btn-sm btn-light" wire:click="cancelEdit">Cancel</button>
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary px-4" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:target="addRow,receipt">
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
        <div class="card" id="supplierPaymentBatch">
            <div class="card-header d-flex align-items-center gap-2">
                <h5 class="card-title mb-0 me-auto">Payments to save <span class="badge bg-primary-subtle text-primary ms-1">{{ count($rows) }}</span></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 fs-13">
                    <thead class="table-light">
                        <tr>
                            <th>#</th><th>Date</th><th>Paid from</th><th>Supplier</th>
                            <th class="money text-end">Amount</th><th>Reference / notes</th><th>Receipt</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $i => $row)
                            @php($error = $rowErrors[$i] ?? null)
                            <tr wire:key="sprow-{{ $i }}-{{ $row['amount'] }}" class="{{ $error ? 'table-danger' : ($editingRow === $i ? 'table-warning' : '') }}">
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ \Illuminate\Support\Carbon::parse($row['date'])->format('d M Y') }}</td>
                                <td class="text-nowrap">
                                    @if ($row['method'] === 'cash')
                                        <i class="ri-wallet-3-line me-1"></i>Cash in hand <div class="fs-11 text-muted">No company</div>
                                    @else
                                        {{ $this->lookups['accounts'][$row['account_id']] ?? '—' }}
                                        <div class="fs-11 text-muted">{{ $this->lookups['companies'][$row['company_id']] ?? '' }}</div>
                                    @endif
                                </td>
                                <td>{{ $this->lookups['suppliers'][$row['supplier_id']] ?? '—' }}</td>
                                <td class="money text-end text-nowrap fw-semibold">{{ money($row['amount']) }}
                                    @foreach ($row['taxes'] ?? [] as $t)
                                        <div class="fs-11 text-muted fw-normal">+ {{ $this->lookups['taxes'][$t['tax_id']] ?? 'Tax' }} {{ money($t['amount']) }}</div>
                                    @endforeach
                                </td>
                                <td class="text-truncate" style="max-width: 16rem" title="{{ trim($row['reference'].' '.$row['notes']) }}">
                                    {{ collect([$row['reference'] ? 'Ref '.$row['reference'] : null, $row['notes'] ?: null])->filter()->implode(' · ') ?: '—' }}
                                </td>
                                <td>@if ($row['receipt_path'])<i class="ri-image-line text-primary" title="{{ $row['receipt_name'] }}"></i>@else<span class="text-muted">—</span>@endif</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-icon btn-light" wire:click="editRow({{ $i }})" title="Edit"><i class="ri-pencil-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-icon btn-light text-danger" wire:click="removeRow({{ $i }})" wire:confirm="Remove this payment of {{ money($row['amount']) }} from the table?" title="Remove"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            @if ($error)
                                <tr class="table-danger" wire:key="sprow-error-{{ $i }}">
                                    <td></td>
                                    <td colspan="7" class="text-danger fs-12 pt-0"><i class="ri-error-warning-line me-1"></i>{{ $error }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="ri-inbox-line fs-24 d-block mb-1 opacity-50"></i>
                                    Fill in the amount and click <strong>Add to table</strong>. Add as many as you need, then save them together.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($rows)
                        <tfoot class="table-light fw-semibold">
                            <tr>
                                <td colspan="4" class="text-end">Total ({{ count($rows) }} {{ Str::plural('payment', count($rows)) }})</td>
                                <td class="money text-end text-nowrap">{{ money($this->total) }}</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            <div class="card-footer d-flex flex-wrap align-items-center justify-content-end gap-2">
                <a href="{{ route('supplier-payments.index') }}" class="btn btn-light me-auto"
                    @if ($rows) x-on:click="if (! confirm('Leave without saving the payments in the table?')) $event.preventDefault()" @endif>Back to supplier payments</a>
                <button type="button" class="btn btn-primary" wire:click="saveAll" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:target="saveAll,addRow,receipt" @disabled(! $rows)>
                    <span wire:loading.remove wire:target="saveAll"><i class="ri-save-3-line me-1"></i>Save all</span>
                    <span wire:loading wire:target="saveAll"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </div>
    @else
        <x-modal id="supplierPaymentModal" :title="$recordId ? 'Edit Supplier Payment' : 'Pay a Supplier'" icon="ri-store-2-line" size="lg">
            <form wire:submit="save">
                <div class="modal-body">
                    @error('general') <div class="alert alert-danger py-2">{{ $message }}</div> @enderror

                    @unless ($recordId)
                        <div class="d-flex justify-content-end fs-12 mb-2">
                            <a href="{{ route('supplier-payments.create', array_filter(['company' => $company_id, 'supplier' => $supplier_id])) }}"><i class="ri-external-link-line"></i> Open as full page</a>
                        </div>
                    @endunless

                    <div class="row g-2">{!! $batchFields !!}{!! $itemFields !!}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,receipt">
                        <span wire:loading.remove wire:target="save"><i class="ri-save-3-line me-1"></i>{{ $recordId ? 'Save changes' : 'Save payment' }}</span>
                        <span wire:loading wire:target="save"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                    </button>
                </div>
            </form>
        </x-modal>
    @endif
</div>
