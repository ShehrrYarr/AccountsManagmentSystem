<?php

/**
 * Manual company adjustments (admin only). The only way to create a receivable.
 */

use App\Enums\AdjustmentKind;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Company;
use App\Models\CompanyAdjustment;
use App\Services\AdjustmentService;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['adjustmentId' => null])->locked();
state([
    'company_id' => null, 'kind' => 'receivable_charge', 'amount' => '', 'date' => '',
    'bank_account_id' => null, 'reason' => '', 'filterCompany' => null,
]);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'kind' => ['required', Rule::enum(AdjustmentKind::class)],
    'amount' => ['required', 'numeric', 'gt:0'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'bank_account_id' => ['nullable', 'exists:bank_accounts,id'],
    'reason' => ['required', 'string', 'max:255'],
]);

$companyOptions = computed(fn () => Options::companies());
$accountOptions = computed(fn () => Options::bankAccounts());
$company = computed(fn () => $this->company_id ? Company::find($this->company_id) : null);

$rows = computed(fn () => CompanyAdjustment::with(['company', 'bankAccount', 'creator'])
    ->when($this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->latest('date')->latest('id')->paginate(20));

$updatedFilterCompany = fn () => $this->resetPage();

on(['transaction-updated' => function () {
    unset($this->rows, $this->company, $this->companyOptions);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->reset(['company_id', 'amount', 'bank_account_id', 'reason']);
    $this->adjustmentId = null;
    $this->kind = 'receivable_charge';
    $this->date = now()->toDateString();
    $this->showModal('adjustmentModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $a = CompanyAdjustment::findOrFail($id);
    $this->adjustmentId = $a->id;
    $this->fill($a->only(['company_id', 'amount', 'bank_account_id', 'reason']) + ['kind' => $a->kind->value, 'date' => $a->date->toDateString()]);
    $this->showModal('adjustmentModal');
};

$save = function () {
    $data = $this->validate();
    $service = app(AdjustmentService::class);

    $ok = $this->attempt(function () use ($service, $data) {
        $this->adjustmentId
            ? $service->update(CompanyAdjustment::findOrFail($this->adjustmentId), $data, auth()->user())
            : $service->create($data, auth()->user());
        $this->toast('success', 'Adjustment posted.');
    });

    if ($ok !== false) {
        $this->hideModal('adjustmentModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    $ok = $this->attempt(fn () => app(AdjustmentService::class)->delete(CompanyAdjustment::findOrFail($id), auth()->user()));
    if ($ok !== false) {
        $this->toast('success', 'Adjustment deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="alert alert-light border fs-13">
        <i class="ri-information-line me-1 text-primary"></i>
        Adjustments correct a company's balances outside normal cheque and payout flows — for example recording that a company
        owes you money, or moving an overpayment caused by a bounced cheque into receivables so the bounce can be posted.
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center gap-2">
            <div style="min-width:240px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" /></div>
            <button type="button" class="btn btn-sm btn-primary ms-auto" wire:click="create"><i class="ri-add-line me-1"></i>New Adjustment</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light"><tr><th>Date</th><th>Company</th><th>Type</th><th>Reason</th><th class="money">Amount</th><th>By</th><th></th></tr></thead>
                    <tbody>
                        @forelse ($this->rows as $a)
                            <tr wire:key="adj-{{ $a->id }}">
                                <td class="fs-13">{{ $a->date->format('d M Y') }}</td>
                                <td><a href="{{ route('companies.show', $a->company_id) }}" class="text-body fw-medium">{{ $a->company->name }}</a></td>
                                <td><span class="badge bg-dark-subtle text-body">{{ $a->kind->shortLabel() }}</span>
                                    @if ($a->bankAccount)<div class="fs-11 text-muted">into {{ $a->bankAccount->name }}</div>@endif</td>
                                <td class="fs-13">{{ $a->reason }}</td>
                                <td class="money fw-semibold">{{ money($a->amount) }}</td>
                                <td class="fs-13">{{ $a->creator?->name }}</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $a->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" x-on:click="amsConfirm('Delete this adjustment?', 'Delete').then(ok => ok && $wire.delete({{ $a->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="7" icon="ri-scales-3-line" message="No adjustments recorded." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->rows->links() }}</div>
    </div>

    <x-modal id="adjustmentModal" :title="$adjustmentId ? 'Edit Adjustment' : 'New Company Adjustment'" icon="ri-scales-3-line" size="lg">
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
                        <label class="form-label">Current position</label>
                        <div class="form-control bg-light-subtle fs-13">
                            @if ($this->company)
                                Payable <strong>{{ money($this->company->payable_balance) }}</strong> · Receivable <strong>{{ money($this->company->receivable_balance) }}</strong>
                            @else <span class="text-muted">—</span> @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Adjustment type <span class="text-danger">*</span></label>
                        @foreach (AdjustmentKind::cases() as $k)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="adj-{{ $k->value }}" value="{{ $k->value }}" wire:model.live="kind">
                                <label class="form-check-label" for="adj-{{ $k->value }}">{{ $k->label() }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" wire:model="amount">
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @if ($kind === 'receivable_settlement')
                        <div class="col-md-4" wire:key="settle-acc">
                            <label class="form-label">Money received into</label>
                            <x-searchable-select wire:model="bank_account_id" :options="$this->accountOptions" placeholder="(no money moved)" />
                        </div>
                    @endif
                    <div class="col-12">
                        <label class="form-label">Reason <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reason') is-invalid @enderror" wire:model="reason" placeholder="Explain why — shown on the company statement">
                        @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Post adjustment</button>
            </div>
        </form>
    </x-modal>
</div>
