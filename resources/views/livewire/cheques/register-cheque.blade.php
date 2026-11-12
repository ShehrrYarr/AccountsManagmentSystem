<?php

/**
 * Enter government cheques for departments. Entering a cheque deposits it into the company's
 * bank the same day (the deposit date is the day it is saved; an edit keeps its date).
 *
 * As a modal (one cheque at a time, also used to edit):
 *     $dispatch('cheque-create')  or  $dispatch('cheque-create', { companyId: 5, departmentId: 2 })
 *     $dispatch('cheque-edit', { id: 12 })
 * As a page (batch entry): <livewire:cheques.register-cheque :as-page="true" />  (route cheques.create,
 *     prefilled from ?company=5&department=2). The white "batch details" card (date, company, bank,
 *     branch, department) stays filled; the light-blue "cheque details" card clears after each
 *     "Add to table". "Save & deposit all" saves the table together, all-or-nothing, and stays here.
 */

use App\Exceptions\BusinessRuleException;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\Department;
use App\Services\Balances;
use App\Services\ChequeService;
use App\Support\ChequeRules;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Livewire\Volt\{computed, mount, on, rules, state, uses, usesFileUploads};

uses([InteractsWithUi::class]);
usesFileUploads();

state(['chequeId' => null, 'asPage' => false])->locked();

state([
    // The form, in the order it is shown.
    'cheque_date' => '',
    'company_id' => null,
    'deposit_account_id' => null,
    'issuing_branch' => '',
    'department_id' => null,
    'cheque_number' => '',
    'amount' => '',
    'bank_charges' => '',
    'scan' => null,
    'notes' => '',
    'deposit_reference' => '',

    'existingScan' => false,   // modal edit: the saved cheque has a picture
    'depositedOn' => null,     // modal edit: its (unchanged) deposit date
    'newDepartment' => '',
    'addingDepartment' => false,

    // Page (batch) mode.
    'rows' => [],
    'editingRow' => null,      // index of the table row loaded into the form
    'rowScanPath' => null,     // picture already attached to that row
    'rowScanName' => null,
    'rowErrors' => [],         // index => why the final save rejected it
    'heldBatch' => null,       // batch details to restore when a row edit ends
]);

rules(fn () => ChequeRules::rules($this->chequeId))->messages(ChequeRules::messages())->attributes(ChequeRules::attributes());

$companyOptions = computed(fn () => Options::companies($this->company_id));
$departmentOptions = computed(fn () => Options::departments($this->department_id));
$bankOptions = computed(fn () => $this->company_id ? Options::accounts((int) $this->company_id, 'bank', $this->deposit_account_id) : []);

// Where the department stands with this company before this cheque (and the other cheques in the table).
$position = computed(function () {
    if (! $this->company_id || ! $this->department_id) {
        return null;
    }
    $balance = Balances::departmentBalance((int) $this->department_id, (int) $this->company_id);
    if ($this->chequeId && ($old = Cheque::find($this->chequeId)) && $old->company_id == $this->company_id && $old->department_id == $this->department_id) {
        $balance = Money::add($balance, $old->amount); // show it without the cheque being edited
    }
    foreach ($this->rows as $i => $row) {
        if ($i !== $this->editingRow && $row['company_id'] == $this->company_id && $row['department_id'] == $this->department_id) {
            $balance = Money::sub($balance, $row['amount']);
        }
    }

    return $balance;
});

$expiry = computed(function () {
    if (! $this->cheque_date || strtotime($this->cheque_date) === false) {
        return null;
    }
    $expiry = Cheque::expiryFor($this->cheque_date);
    $on = $this->depositedOn ? \Illuminate\Support\Carbon::parse($this->depositedOn) : now();

    return ['date' => $expiry, 'expired' => $on->startOfDay()->gt($expiry)];
});

$net = computed(fn () => is_numeric($this->amount) ? Money::sub($this->amount, is_numeric($this->bank_charges) ? $this->bank_charges : 0) : null);

// Names for the batch table.
$lookups = computed(function () {
    $rows = collect($this->rows);

    return [
        'companies' => Company::withTrashed()->whereIn('id', $rows->pluck('company_id'))->pluck('name', 'id'),
        'banks' => Account::withTrashed()->whereIn('id', $rows->pluck('deposit_account_id'))->get()->mapWithKeys(fn ($a) => [$a->id => $a->shortLabel()]),
        'departments' => Department::whereIn('id', $rows->pluck('department_id'))->pluck('name', 'id'),
    ];
});

$totals = computed(fn () => [
    'amount' => Money::add(...array_column($this->rows, 'amount')),
    'charges' => Money::add(...array_map(fn ($r) => Money::of($r['bank_charges']), $this->rows)),
]);

// Page: the company's first bank is picked; modal: only when the company has just one bank.
$updatedCompanyId = function () {
    unset($this->bankOptions);
    $banks = $this->bankOptions;
    $this->deposit_account_id = ($this->asPage || count($banks) === 1) ? ($banks[0]['value'] ?? null) : null;
};

$resetForm = function () {
    $this->fill([
        'cheque_date' => '', 'company_id' => null, 'deposit_account_id' => null, 'issuing_branch' => '', 'department_id' => null,
        'cheque_number' => '', 'amount' => '', 'bank_charges' => '', 'scan' => null, 'notes' => '', 'deposit_reference' => '',
        'existingScan' => false, 'depositedOn' => null, 'newDepartment' => '', 'addingDepartment' => false,
        'editingRow' => null, 'rowScanPath' => null, 'rowScanName' => null, 'heldBatch' => null,
    ]);
    $this->chequeId = null;
    $this->resetErrorBag();
    unset($this->bankOptions, $this->position);
};

$startNew = function (?int $companyId = null, ?int $departmentId = null) {
    $this->resetForm();
    $this->company_id = $companyId;
    $this->department_id = $departmentId;
    if ($companyId) {
        $this->updatedCompanyId();
    }
};

// Volt hands props to mount() when one is defined. The page opens with today's date, the first
// company (and its first bank) and the first department, unless ?company= / ?department= say otherwise.
mount(function (bool $asPage = false, $company = null, $department = null) {
    $this->asPage = $asPage;
    if ($this->asPage) {
        $id = fn ($v) => ctype_digit((string) $v) ? (int) $v : null;
        $this->startNew(
            $id($company) ?? ($this->companyOptions[0]['value'] ?? null),
            $id($department) ?? ($this->departmentOptions[0]['value'] ?? null),
        );
        $this->cheque_date = now()->toDateString();
        unset($this->companyOptions, $this->departmentOptions);
    }
});

on(['cheque-create' => function (?int $companyId = null, ?int $departmentId = null) {
    if ($this->asPage) {
        return; // the page form is always open; the modal instance handles this event
    }
    $this->startNew($companyId, $departmentId);
    $this->showModal('chequeFormModal');
}]);

on(['cheque-edit' => function (int $id) {
    if ($this->asPage) {
        return;
    }
    $this->resetForm();
    $cheque = Cheque::findOrFail($id);
    $this->chequeId = $cheque->id;
    $this->fill([
        'cheque_date' => $cheque->cheque_date->toDateString(),
        'company_id' => $cheque->company_id,
        'deposit_account_id' => $cheque->deposit_account_id,
        'issuing_branch' => $cheque->issuing_branch ?? '',
        'department_id' => $cheque->department_id,
        'cheque_number' => $cheque->cheque_number,
        'amount' => $cheque->amount,
        'bank_charges' => Money::isPositive($cheque->bank_charges) ? $cheque->bank_charges : '',
        'notes' => $cheque->notes ?? '',
        'deposit_reference' => $cheque->deposit_reference ?? '',
        'existingScan' => (bool) $cheque->scan_path,
        'depositedOn' => $cheque->date->toDateString(),
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

/** The form's values as a cheque (without the picture). */
$formData = fn () => $this->only(['cheque_date', 'company_id', 'deposit_account_id', 'issuing_branch', 'department_id', 'cheque_number', 'amount', 'bank_charges', 'notes', 'deposit_reference']);

// ── Modal: save one cheque ─────────────────────────────────────────────────────────────

$save = function () {
    $this->validate();
    $data = $this->formData();
    $data['scan_path'] = $this->storeUpload($this->scan, 'cheques');

    $message = $this->attempt(function () use ($data) {
        $cheque = app(ChequeService::class)->save($this->chequeId ? Cheque::findOrFail($this->chequeId) : null, $data, auth()->user());

        return $this->chequeId
            ? "Cheque #{$cheque->cheque_number} updated."
            : "Cheque #{$cheque->cheque_number}: ".money($cheque->netDeposit()).' deposited into '.$cheque->depositAccount->shortLabel().' for '.$cheque->department->name.'.';
    });

    if ($message === false) {
        return;
    }

    $this->toast('success', $message);
    $this->broadcastChange();
    $this->hideModal('chequeFormModal');
    $this->resetForm();
};

// ── Page: build a table of cheques, then save them together ────────────────────────────

$addRow = function () {
    $this->validate();
    $data = $this->formData();
    $number = trim((string) $data['cheque_number']);

    foreach ($this->rows as $i => $row) {
        if ($i !== $this->editingRow && strcasecmp(trim($row['cheque_number']), $number) === 0) {
            $this->addError('cheque_number', 'This cheque number is already in the table (row '.($i + 1).').');

            return;
        }
    }

    if ($this->attempt(fn () => app(ChequeService::class)->check($data)) === false) {
        return;
    }

    $scanPath = $this->rowScanPath;
    $scanName = $this->rowScanName;
    if ($this->scan) {
        if ($scanPath) {
            Storage::disk('local')->delete($scanPath); // replaced
        }
        $scanName = $this->scan->getClientOriginalName();
        $scanPath = $this->storeUpload($this->scan, 'cheques');
    }

    $row = array_merge($data, [
        'company_id' => (int) $data['company_id'],
        'deposit_account_id' => (int) $data['deposit_account_id'],
        'department_id' => (int) $data['department_id'],
        'cheque_number' => $number,
        'amount' => Money::of($data['amount']),
        'bank_charges' => Money::of($data['bank_charges']),
        'scan_path' => $scanPath,
        'scan_name' => $scanName,
    ]);

    if ($this->editingRow !== null) {
        $this->rows[$this->editingRow] = $row;
        unset($this->rowErrors[$this->editingRow]);
    } else {
        $this->rows[] = $row;
    }

    // The batch details stay for the next cheque (or go back to what they were before an edit).
    $this->finishEdit();
    unset($this->lookups, $this->totals);
};

/** Clear only the per-cheque fields (the light-blue card). */
$clearChequeFields = function () {
    $this->fill([
        'cheque_number' => '', 'amount' => '', 'bank_charges' => '', 'scan' => null, 'notes' => '', 'deposit_reference' => '',
        'editingRow' => null, 'rowScanPath' => null, 'rowScanName' => null,
    ]);
    $this->resetErrorBag();
};

/** Leave row-edit mode: restore the batch details held when the edit started, clear the cheque fields. */
$finishEdit = function () {
    if ($this->heldBatch !== null) {
        $this->fill($this->heldBatch);
        $this->heldBatch = null;
        unset($this->bankOptions);
    }
    $this->clearChequeFields();
    unset($this->position);
};

$editRow = function (int $i) {
    if (! isset($this->rows[$i])) {
        return;
    }
    if ($this->editingRow === null) {
        $this->heldBatch = $this->only(ChequeRules::BATCH_FIELDS);
    }
    $row = $this->rows[$i];
    $this->clearChequeFields();
    $this->fill(Arr::only($row, [...ChequeRules::BATCH_FIELDS, 'cheque_number', 'notes', 'deposit_reference']));
    $this->fill([
        'amount' => $row['amount'],
        'bank_charges' => Money::isPositive($row['bank_charges']) ? $row['bank_charges'] : '',
        'editingRow' => $i,
        'rowScanPath' => $row['scan_path'],
        'rowScanName' => $row['scan_name'],
    ]);
    unset($this->bankOptions, $this->position);
};

$cancelEdit = function () {
    $this->finishEdit();
};

$removeRow = function (int $i) {
    if (! isset($this->rows[$i])) {
        return;
    }
    if ($path = $this->rows[$i]['scan_path']) {
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
    unset($this->lookups, $this->totals, $this->position);
};

$saveAll = function () {
    if ($this->editingRow !== null) {
        $this->toast('error', 'Finish editing row '.($this->editingRow + 1).' first: Update row or Cancel.');

        return;
    }
    if ($this->rows === []) {
        $this->toast('error', 'Add at least one cheque to the table first.');

        return;
    }

    // Re-check every row as the form would; nothing is saved unless all of them pass.
    $this->rowErrors = [];
    $rules = ChequeRules::rules(null, false) + ['scan_path' => ['nullable', 'string', 'starts_with:cheques/', 'not_regex:/\.\./']];
    foreach ($this->rows as $i => $row) {
        $v = Validator::make($row, $rules, ChequeRules::messages(), ChequeRules::attributes());
        if ($v->fails()) {
            $this->rowErrors[$i] = $v->errors()->first();
        }
    }

    if ($this->rowErrors === []) {
        try {
            $rows = array_map(fn ($r) => Arr::except($r, ['scan_name']), $this->rows);
            app(ChequeService::class)->saveMany($rows, auth()->user());
        } catch (BusinessRuleException $e) {
            $this->rowErrors[(int) Str::after((string) $e->field, 'rows.')] = $e->getMessage();
        }
    }

    if ($this->rowErrors !== []) {
        $first = array_key_first($this->rowErrors);
        $this->toast('error', 'Nothing was saved. Row '.($first + 1).': '.$this->rowErrors[$first]);

        return;
    }

    // Stay on the page for the next batch: empty table, batch details kept.
    $count = count($this->rows);
    $total = $this->totals['amount'];
    $this->rows = [];
    $this->rowErrors = [];
    $this->clearChequeFields();
    unset($this->lookups, $this->totals, $this->position);
    $this->toast('success', $count.' '.Str::plural('cheque', $count).' of '.money($total).' deposited.');
    $this->broadcastChange();
};

?>

@php
    // Page: batch details in one row (department on its own row), cheque details six a row; modal: two a row.
    $colBatch = $asPage ? 'col-lg-3 col-sm-6' : 'col-md-6';
    $colDept = $asPage ? 'col-12' : 'col-md-6';
    $colCheque = $asPage ? 'col-xl-2 col-lg-4 col-sm-6' : 'col-md-6';
    $label = $asPage ? 'form-label fw-semibold fs-13 mb-1' : 'form-label fs-12 mb-1';
    $req = '<span class="text-danger">*</span>';
@endphp

{{-- The fields are written once and placed into two cards (page) or one list (modal). --}}
@php(ob_start())
    {{-- 1. Cheque date --}}
    <div class="{{ $colBatch }}">
        <label class="{{ $label }}">Cheque date {!! $req !!}</label>
        <input type="date" class="form-control form-control-sm @error('cheque_date') is-invalid @enderror" wire:model.live="cheque_date" max="{{ now()->toDateString() }}">
        @error('cheque_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($this->expiry && ! $errors->has('cheque_date'))
            <div class="form-text fs-11 mt-0 {{ $this->expiry['expired'] ? 'text-danger' : '' }}">
                {{ $this->expiry['expired'] ? 'Expired on' : 'Valid until' }} {{ $this->expiry['date']->format('d M Y') }}
            </div>
        @endif
    </div>

    {{-- 2. Company --}}
    <div class="{{ $colBatch }}">
        <label class="{{ $label }}">Company {!! $req !!}</label>
        <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" size="sm" :invalid="$errors->has('company_id')" />
        @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    {{-- 3. Company bank it is deposited into --}}
    <div class="{{ $colBatch }}">
        <label class="{{ $label }}">Bank {!! $req !!}</label>
        <x-searchable-select wire:model="deposit_account_id" :options="$this->bankOptions" size="sm"
            :placeholder="! $company_id ? 'Select a company first' : (count($this->bankOptions) ? 'Select bank' : 'No bank account')"
            :disabled="! $company_id" :invalid="$errors->has('deposit_account_id')" />
        @error('deposit_account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        @if ($company_id && ! count($this->bankOptions))
            <div class="form-text fs-11 mt-0"><a href="{{ route('accounts.index') }}">Add a bank account</a> first.</div>
        @endif
    </div>

    {{-- 4. Branch code on the cheque --}}
    <div class="{{ $colBatch }}">
        <label class="{{ $label }}">Branch code</label>
        <input type="text" class="form-control form-control-sm @error('issuing_branch') is-invalid @enderror" wire:model="issuing_branch" placeholder="Optional">
        @error('issuing_branch') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 5. Department --}}
    <div class="{{ $colDept }}">
        <label class="{{ $label }} d-flex justify-content-between">
            <span>Department {!! $req !!}</span>
            <a href="#" class="fs-11 fw-normal" wire:click.prevent="$toggle('addingDepartment')">{{ $addingDepartment ? 'Cancel' : '+ New department' }}</a>
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
        @if ($this->position !== null && ! $addingDepartment)
            @php($describe = fn ($b) => Money::isNegative($b) ? 'you hold '.money(Money::sub(0, $b)) : (Money::isZero($b) ? 'settled' : 'owes you '.money($b)))
            <div class="form-text fs-11 mt-0 ams-balance" title="Department balance with this company{{ $rows ? ', including the cheques in the table' : '' }}">
                {{ ucfirst($describe($this->position)) }}
                @if (is_numeric($amount) && $amount > 0)
                    → {{ $describe(Money::sub($this->position, $amount)) }}
                @endif
            </div>
        @endif
    </div>
@php($batchFields = ob_get_clean())

@php(ob_start())
    {{-- 6. Cheque number --}}
    <div class="{{ $colCheque }}">
        <label class="{{ $label }}">Cheque number {!! $req !!}</label>
        <input type="text" class="form-control form-control-sm @error('cheque_number') is-invalid @enderror" wire:model.blur="cheque_number" placeholder="e.g. 12345678">
        @error('cheque_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 7. Amount --}}
    <div class="{{ $colCheque }}">
        <label class="{{ $label }}">Cheque amount {!! $req !!}</label>
        <div class="input-group input-group-sm has-validation">
            <span class="input-group-text">Rs.</span>
            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model.live.debounce.400ms="amount" placeholder="0.00">
            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    {{-- 8. Bank charges --}}
    <div class="{{ $colCheque }}">
        <label class="{{ $label }}">Bank charges</label>
        <div class="input-group input-group-sm has-validation">
            <span class="input-group-text">Rs.</span>
            <input type="number" step="0.01" min="0" class="form-control @error('bank_charges') is-invalid @enderror" wire:model.live.debounce.400ms="bank_charges" placeholder="0.00">
            @error('bank_charges') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        @if ($this->net !== null && Money::isPositive($amount) && Money::isPositive(is_numeric($bank_charges) ? $bank_charges : 0))
            <div class="form-text fs-11 mt-0">Net to bank: <strong class="text-success">{{ money($this->net) }}</strong></div>
        @endif
    </div>

    {{-- 9. Cheque picture --}}
    <div class="{{ $colCheque }}">
        <label class="{{ $label }}">Cheque picture</label>
        <input type="file" class="form-control form-control-sm @error('scan') is-invalid @enderror" wire:model="scan" accept=".jpg,.jpeg,.png,.pdf">
        <div wire:loading wire:target="scan" class="form-text fs-11 mt-0"><i class="ri-loader-4-line"></i> Uploading…</div>
        @error('scan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if (! $scan && $existingScan && $chequeId)
            <div class="form-text fs-11 mt-0"><a href="{{ route('files.show', ['cheque', $chequeId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current picture</a> — upload to replace</div>
        @elseif (! $scan && $rowScanPath)
            <div class="form-text fs-11 mt-0 text-truncate"><i class="ri-attachment-2"></i> {{ $rowScanName }} — upload to replace</div>
        @endif
    </div>

    {{-- 10. Notes --}}
    <div class="{{ $colCheque }}">
        <label class="{{ $label }}">Notes</label>
        <input type="text" class="form-control form-control-sm @error('notes') is-invalid @enderror" wire:model="notes" placeholder="Bill / invoice ref, remarks">
        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- 11. Deposit slip --}}
    <div class="{{ $colCheque }}">
        <label class="{{ $label }}">Deposit slip / reference</label>
        <input type="text" class="form-control form-control-sm @error('deposit_reference') is-invalid @enderror" wire:model="deposit_reference" placeholder="Optional">
        @error('deposit_reference') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
@php($chequeFields = ob_get_clean())

<div @if ($asPage) x-data x-on:beforeunload.window="if ($wire.rows.length) { $event.preventDefault(); $event.returnValue = ''; }" @endif>
    @if ($asPage)
        <form wire:submit="addRow" id="chequeFormPage">
            @error('general') <div class="alert alert-danger py-2">{{ $message }}</div> @enderror

            {{-- Batch details: stay the same from one cheque to the next --}}
            <div class="card mb-3" id="chequeBatchDetails">
                <div class="card-header d-flex flex-wrap align-items-center gap-2 py-2">
                    <h5 class="card-title mb-0 me-auto d-flex align-items-center gap-2"><i class="ri-pushpin-line text-primary"></i>Batch details</h5>
                    <span class="fs-12 text-muted">Stay the same for every cheque you add · Deposit date: today, {{ now()->format('d M Y') }}</span>
                </div>
                <div class="card-body">
                    @if ($editingRow !== null)
                        <div class="alert alert-warning py-2 fs-13 mb-2"><i class="ri-edit-line me-1"></i>Editing row {{ $editingRow + 1 }}: both cards show that row. <strong>Update row</strong> or <strong>Cancel</strong> brings your batch details back.</div>
                    @endif
                    <div class="row g-2">{!! $batchFields !!}</div>
                </div>
            </div>

            {{-- Cheque details: cleared after each "Add to table" --}}
            <div class="card mb-3 bg-primary-subtle border border-primary-subtle" id="chequeDetails">
                <div class="card-header d-flex flex-wrap align-items-center gap-2 py-2 bg-transparent border-primary-subtle">
                    <h5 class="card-title mb-0 me-auto d-flex align-items-center gap-2"><i class="ri-bank-card-line text-primary"></i>Cheque details</h5>
                    <span class="fs-12 text-muted">Cleared after each cheque is added</span>
                </div>
                <div class="card-body">
                    <div class="row g-2">{!! $chequeFields !!}</div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        @if ($editingRow !== null)
                            <button type="button" class="btn btn-sm btn-light" wire:click="cancelEdit">Cancel</button>
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary px-4" wire:loading.attr="disabled" wire:target="addRow,scan">
                            <span wire:loading.remove wire:target="addRow">
                                <i class="{{ $editingRow !== null ? 'ri-check-line' : 'ri-add-line' }} me-1"></i>{{ $editingRow !== null ? 'Update row '.($editingRow + 1) : 'Add to table' }}
                            </span>
                            <span wire:loading wire:target="addRow"><i class="ri-loader-4-line me-1"></i>Checking…</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Cheques waiting to be saved --}}
        <div class="card" id="chequeBatch">
            <div class="card-header d-flex align-items-center gap-2">
                <h5 class="card-title mb-0 me-auto">Cheques to deposit <span class="badge bg-primary-subtle text-primary ms-1">{{ count($rows) }}</span></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 fs-13">
                    <thead class="table-light">
                        <tr>
                            <th>#</th><th>Cheque date</th><th>Company</th><th>Bank</th><th>Branch</th><th>Department</th><th>Cheque no.</th>
                            <th class="money text-end">Amount</th><th class="money text-end">Charges</th><th class="money text-end">Net</th><th>Picture</th><th>Notes / slip</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $i => $row)
                            @php($error = $rowErrors[$i] ?? null)
                            <tr wire:key="row-{{ $i }}-{{ $row['cheque_number'] }}" class="{{ $error ? 'table-danger' : ($editingRow === $i ? 'table-warning' : '') }}">
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ \Illuminate\Support\Carbon::parse($row['cheque_date'])->format('d M Y') }}</td>
                                <td>{{ $this->lookups['companies'][$row['company_id']] ?? '—' }}</td>
                                <td class="text-nowrap">{{ $this->lookups['banks'][$row['deposit_account_id']] ?? '—' }}</td>
                                <td>{{ $row['issuing_branch'] ?: '—' }}</td>
                                <td>{{ $this->lookups['departments'][$row['department_id']] ?? '—' }}</td>
                                <td class="fw-medium">#{{ $row['cheque_number'] }}</td>
                                <td class="money text-end text-nowrap">{{ money($row['amount']) }}</td>
                                <td class="money text-end text-nowrap">{{ Money::isPositive($row['bank_charges']) ? money($row['bank_charges']) : '—' }}</td>
                                <td class="money text-end text-nowrap fw-semibold">{{ money(Money::sub($row['amount'], $row['bank_charges'])) }}</td>
                                <td>@if ($row['scan_path'])<i class="ri-image-line text-primary" title="{{ $row['scan_name'] }}"></i>@else<span class="text-muted">—</span>@endif</td>
                                <td class="text-truncate" style="max-width: 14rem" title="{{ trim($row['notes'].' '.$row['deposit_reference']) }}">
                                    {{ $row['notes'] ?: '' }}{{ $row['notes'] && $row['deposit_reference'] ? ' · ' : '' }}{{ $row['deposit_reference'] ? 'Slip '.$row['deposit_reference'] : '' }}
                                    @if (! $row['notes'] && ! $row['deposit_reference'])<span class="text-muted">—</span>@endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-icon btn-light" wire:click="editRow({{ $i }})" title="Edit"><i class="ri-pencil-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-icon btn-light text-danger" wire:click="removeRow({{ $i }})" wire:confirm="Remove cheque #{{ $row['cheque_number'] }} from the table?" title="Remove"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            @if ($error)
                                <tr class="table-danger" wire:key="row-error-{{ $i }}">
                                    <td></td>
                                    <td colspan="12" class="text-danger fs-12 pt-0"><i class="ri-error-warning-line me-1"></i>{{ $error }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted py-4">
                                    <i class="ri-inbox-line fs-24 d-block mb-1 opacity-50"></i>
                                    Fill in the cheque details and click <strong>Add to table</strong>. Add as many as you need, then save them together.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($rows)
                        <tfoot class="table-light fw-semibold">
                            <tr>
                                <td colspan="7" class="text-end">Total ({{ count($rows) }} {{ Str::plural('cheque', count($rows)) }})</td>
                                <td class="money text-end text-nowrap">{{ money($this->totals['amount']) }}</td>
                                <td class="money text-end text-nowrap">{{ money($this->totals['charges']) }}</td>
                                <td class="money text-end text-nowrap text-success">{{ money(Money::sub($this->totals['amount'], $this->totals['charges'])) }}</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            <div class="card-footer d-flex flex-wrap align-items-center justify-content-end gap-2">
                <a href="{{ route('cheques.index') }}" class="btn btn-light me-auto"
                    @if ($rows) x-on:click="if (! confirm('Leave without saving the cheques in the table?')) $event.preventDefault()" @endif>Back to cheques</a>
                <button type="button" class="btn btn-primary" wire:click="saveAll" wire:loading.attr="disabled" wire:target="saveAll,addRow,scan" @disabled(! $rows)>
                    <span wire:loading.remove wire:target="saveAll"><i class="ri-save-3-line me-1"></i>Save &amp; deposit all</span>
                    <span wire:loading wire:target="saveAll"><i class="ri-loader-4-line me-1"></i>Saving…</span>
                </button>
            </div>
        </div>
    @else
        <x-modal id="chequeFormModal" :title="$chequeId ? 'Edit Government Cheque' : 'Deposit Government Cheque'" icon="ri-bank-card-line" size="lg">
            <form wire:submit="save">
                <div class="modal-body">
                    @error('general') <div class="alert alert-danger py-2">{{ $message }}</div> @enderror

                    <div class="d-flex justify-content-between fs-12 text-muted mb-2">
                        <span><i class="ri-calendar-check-line"></i> Deposit date: {{ $depositedOn ? \Illuminate\Support\Carbon::parse($depositedOn)->format('d M Y') : 'today, '.now()->format('d M Y') }}</span>
                        @unless ($chequeId)
                            <a href="{{ route('cheques.create', array_filter(['company' => $company_id, 'department' => $department_id])) }}"><i class="ri-external-link-line"></i> Open as full page</a>
                        @endunless
                    </div>

                    <div class="row g-2">{!! $batchFields !!}{!! $chequeFields !!}</div>
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
    @endif
</div>
