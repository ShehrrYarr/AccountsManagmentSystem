<?php

use App\Models\Company;
use App\Support\Money;

use function Livewire\Volt\{computed, on, state};

state(['companyId' => null])->locked();

$company = computed(fn () => Company::withTrashed()->withCount('bankAccounts')->findOrFail($this->companyId));
$pending = computed(fn () => $this->company->pendingChequesTotal());

on(['transaction-updated' => function () {
    unset($this->company, $this->pending);
}]);

?>

<div class="row g-3 mb-4">
    @php($c = $this->company)
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <div class="fs-12 text-muted text-uppercase mb-2">Company</div>
                <div class="fw-semibold">{{ $c->name }}
                    @unless ($c->is_active)<span class="badge bg-secondary-subtle text-secondary">Inactive</span>@endunless
                </div>
                <div class="fs-13 text-muted">{{ collect([$c->contact_person, $c->phone])->filter()->implode(' · ') ?: 'No contact details' }}</div>
                <div class="fs-12 text-muted">{{ $c->bank_accounts_count }} bank account(s) on file</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <x-stat-card label="Payable (I owe them)" :value="money($c->payable_balance)" icon="ri-arrow-right-up-line" color="success" />
    </div>
    <div class="col-xl-3 col-md-6">
        <x-stat-card label="Receivable (they owe me)" :value="money($c->receivable_balance)" icon="ri-arrow-left-down-line" color="danger" />
    </div>
    <div class="col-xl-3 col-md-6">
        <x-stat-card label="Cheques in clearing" :value="money($this->pending)" icon="ri-time-line" color="warning" hint="Not yet in the payable" />
    </div>
</div>
