<?php

/**
 * General company expenses (rent, fuel, salaries…). List + modal; embeddable on a company page.
 *
 * Open the form with: $dispatch('expense-create', { companyId: 1 })  (optional)
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Services\PaymentService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, rules, state, uses, usesFileUploads, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');
usesFileUploads();

state(['companyId' => null, 'recordId' => null])->locked();
state(['search' => '', 'filterCategory' => null, 'from' => '', 'to' => '']);
state([
    'company_id' => null, 'expense_category_id' => null, 'account_id' => null, 'amount' => '', 'date' => '',
    'description' => '', 'reference' => '', 'notes' => '', 'receipt' => null, 'existingReceipt' => false,
    'newCategory' => '', 'addingCategory' => false,
]);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'expense_category_id' => ['required', 'exists:expense_categories,id'],
    'account_id' => ['required', 'exists:accounts,id'],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'description' => ['required', 'string', 'max:255'],
    'reference' => ['nullable', 'string', 'max:255'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'receipt' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
])->messages(['expense_category_id.required' => 'Choose a category.', 'account_id.required' => 'Choose the account paid from.']);

$updated = function ($property) {
    if (in_array($property, ['search', 'filterCategory', 'from', 'to'], true)) {
        $this->resetPage('expPage');
    }
    if ($property === 'company_id') {
        $this->account_id = null;
    }
};

$baseQuery = computed(fn () => Expense::query()
    ->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->filterCategory, fn ($q, $id) => $q->where('expense_category_id', $id))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('description', 'like', "%{$this->search}%")
        ->orWhere('reference', 'like', "%{$this->search}%"))));

$rows = computed(fn () => (clone $this->baseQuery)->with(['company', 'category', 'account'])
    ->orderByDesc('date')->orderByDesc('id')->paginate(15, pageName: 'expPage'));

$total = computed(fn () => Money::of((clone $this->baseQuery)->sum('amount')));

$companyOptions = computed(fn () => Options::companies($this->company_id));
$categoryOptions = computed(fn () => Options::expenseCategories($this->expense_category_id));
$accountOptions = computed(fn () => $this->company_id ? Options::accounts((int) $this->company_id, null, $this->account_id) : []);

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->rows, $this->total, $this->accountOptions);
}]);

on(['expense-create' => function (?int $companyId = null) {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->fill(['company_id' => $companyId ?? $this->companyId, 'expense_category_id' => null, 'account_id' => null, 'amount' => '',
        'date' => now()->toDateString(), 'description' => '', 'reference' => '', 'notes' => '', 'receipt' => null,
        'existingReceipt' => false, 'newCategory' => '', 'addingCategory' => false]);
    $this->showModal('expenseModal');
}]);

$edit = function (int $id) {
    $this->resetErrorBag();
    $e = Expense::findOrFail($id);
    $this->recordId = $e->id;
    $this->fill(['company_id' => $e->company_id, 'expense_category_id' => $e->expense_category_id, 'account_id' => $e->account_id,
        'amount' => $e->amount, 'date' => $e->date->toDateString(), 'description' => $e->description, 'reference' => $e->reference ?? '',
        'notes' => $e->notes ?? '', 'receipt' => null, 'existingReceipt' => (bool) $e->receipt_path, 'addingCategory' => false]);
    $this->showModal('expenseModal');
};

$addCategory = function () {
    $this->validate(['newCategory' => ['required', 'string', 'max:255', 'unique:expense_categories,name']], [], ['newCategory' => 'category name']);
    $this->expense_category_id = ExpenseCategory::create(['name' => trim($this->newCategory), 'is_active' => true])->id;
    unset($this->categoryOptions);
    $this->fill(['newCategory' => '', 'addingCategory' => false]);
};

$save = function () {
    $data = $this->validate();
    $data['receipt_path'] = $this->storeUpload($this->receipt, 'receipts');
    unset($data['receipt']);

    $ok = $this->attempt(function () use ($data) {
        $e = app(PaymentService::class)->saveExpense($this->recordId ? Expense::findOrFail($this->recordId) : null, $data);
        $this->toast('success', 'Expense of '.money($e->amount).' saved.');
    });
    if ($ok !== false) {
        $this->hideModal('expenseModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $e = Expense::findOrFail($id);
    if ($this->attempt(fn () => app(PaymentService::class)->delete($e)) !== false) {
        $this->toast('success', 'Expense deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <div class="flex-grow-1" style="min-width:200px">
                <input type="search" class="form-control form-control-sm" placeholder="Search description or reference…" aria-label="Search expenses" wire:model.live.debounce.350ms="search">
            </div>
            <div style="min-width:170px"><x-searchable-select wire:model.live="filterCategory" :options="Options::expenseCategories()" placeholder="All categories" size="sm" /></div>
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
            <button type="button" class="btn btn-sm btn-primary" wire:click="$dispatch('expense-create')"><i class="ri-add-line me-1"></i>Add expense</button>
        </div>
        <div class="px-4 py-2 border-bottom fs-13 bg-body-tertiary"><span class="text-muted">Total of list:</span> <strong class="text-danger">{{ money($this->total) }}</strong></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Expense</th><th class="d-none d-md-table-cell">Paid from</th><th class="money">Amount</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $e)
                            <tr wire:key="exp-{{ $e->id }}">
                                <td class="fs-13 text-nowrap">{{ $e->date->format('d M Y') }}</td>
                                <td class="ams-desc-cell">
                                    <span class="badge bg-danger-subtle text-danger">{{ $e->category->name }}</span>
                                    <div class="fs-13 text-truncate ams-wrap-sm">{{ $e->description }}</div>
                                    <div class="fs-12 text-muted">@unless ($companyId){{ $e->company->name }}@endunless{{ $e->reference ? ' · Ref '.$e->reference : '' }}</div>
                                </td>
                                <td class="fs-13 d-none d-md-table-cell">{{ $e->account->shortLabel() }}</td>
                                <td class="money fw-semibold">{{ money($e->amount) }}</td>
                                <td class="text-end text-nowrap">
                                    @if ($e->receipt_path)
                                        <a class="btn btn-sm btn-light icon-btn-sm" href="{{ route('files.show', ['expense', $e->id]) }}" target="_blank" title="Receipt"><i class="ri-attachment-2"></i></a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $e->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete this expense of '.money($e->amount).'?'), 'Delete').then(ok => ok && $wire.delete({{ $e->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="5" icon="ri-receipt-line" message="No expenses recorded." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->rows->onEachSide(1)->links() }}</div>
    </div>

    <x-modal id="expenseModal" :title="$recordId ? 'Edit Expense' : 'Add Expense'" icon="ri-receipt-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('company_id')" />
                        @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label d-flex justify-content-between">
                            <span>Category <span class="text-danger">*</span></span>
                            <a href="#" class="fs-12" wire:click.prevent="$toggle('addingCategory')">{{ $addingCategory ? 'Cancel' : '+ New category' }}</a>
                        </label>
                        @if ($addingCategory)
                            <div class="input-group has-validation">
                                <input type="text" class="form-control @error('newCategory') is-invalid @enderror" wire:model="newCategory" placeholder="e.g. Fuel" wire:keydown.enter.prevent="addCategory">
                                <button type="button" class="btn btn-primary" wire:click="addCategory">Add</button>
                                @error('newCategory') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <x-searchable-select wire:model="expense_category_id" :options="$this->categoryOptions" placeholder="Select category" :invalid="$errors->has('expense_category_id')" />
                            @error('expense_category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" wire:model="description" placeholder="e.g. Generator diesel for October">
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Paid from <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model="account_id" :options="$this->accountOptions" :placeholder="$company_id ? 'Select cash or bank' : 'Select a company first'" :disabled="! $company_id" :invalid="$errors->has('account_id')" />
                        @error('account_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model="amount" placeholder="0.00">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Reference</label>
                        <input type="text" class="form-control" wire:model="reference" placeholder="Bill / receipt no.">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Receipt</label>
                        <input type="file" class="form-control @error('receipt') is-invalid @enderror" wire:model="receipt" accept=".jpg,.jpeg,.png,.pdf">
                        @error('receipt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($existingReceipt && ! $receipt)
                            <div class="form-text"><a href="{{ route('files.show', ['expense', $recordId]) }}" target="_blank"><i class="ri-attachment-2"></i> Current file</a></div>
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
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save,receipt"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
