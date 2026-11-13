<?php

/**
 * Department balances split by company, with a "Close deal" action per row.
 *   On a company page:    <livewire:departments.balances :company-id="1" />   (one row per department)
 *   On a department page: <livewire:departments.balances :department-id="4" /> (one row per company)
 */

use App\Models\Company;
use App\Models\Department;
use App\Services\Balances;
use App\Support\Money;

use function Livewire\Volt\{computed, on, state};

state(['companyId' => null, 'departmentId' => null])->locked();
state(['hideSettled' => true]);

$rows = computed(function () {
    $companies = Company::withTrashed()->pluck('name', 'id');
    $departments = Department::pluck('name', 'id');

    return Balances::departments($this->companyId, $this->departmentId)
        ->when($this->hideSettled, fn ($c) => $c->reject(fn ($r) => Money::isZero($r->balance)))
        ->map(fn ($r) => (object) ((array) $r + ['company' => Balances::companyName($r->company_id, $companies), 'department' => $departments[$r->department_id] ?? '?']))
        ->sortBy($this->departmentId ? 'company' : 'department')
        ->values();
});

on(['transaction-updated' => function () {
    unset($this->rows);
}]);

?>

<div class="card">
    <div class="card-header d-flex align-items-center gap-2">
        <h5 class="card-title mb-0 me-auto">{{ $departmentId ? 'Balance with each company' : 'Department balances' }}</h5>
        <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="bal-settled-{{ $companyId }}-{{ $departmentId }}" wire:model.live="hideSettled">
            <label class="form-check-label fs-13" for="bal-settled-{{ $companyId }}-{{ $departmentId }}">Hide settled</label>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 ams-table">
                <thead class="table-light">
                    <tr>
                        <th>{{ $departmentId ? 'Company' : 'Department' }}</th>
                        <th class="money d-none d-md-table-cell">Spent for them</th>
                        <th class="money d-none d-md-table-cell">Cheques / closed</th>
                        <th class="money">Balance</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->rows as $r)
                        <tr wire:key="db-{{ $r->company_id }}-{{ $r->department_id }}">
                            <td>
                                @if ($departmentId)
                                    @if ($r->company_id)
                                        <a href="{{ route('companies.show', $r->company_id) }}" class="fw-medium text-body">{{ $r->company }}</a>
                                    @else
                                        <span class="fw-medium" title="Paid from the cash in hand, which belongs to no company">{{ $r->company }}</span>
                                    @endif
                                @else
                                    <a href="{{ route('departments.show', $r->department_id) }}" class="fw-medium text-body">{{ $r->department }}</a>
                                @endif
                            </td>
                            <td class="money d-none d-md-table-cell">{{ money($r->spent) }}</td>
                            <td class="money d-none d-md-table-cell">{{ money($r->received) }}</td>
                            <td class="money fw-semibold">
                                @if (Money::isPositive($r->balance))
                                    <span class="text-danger">{{ money($r->balance) }}</span><div class="fs-11 text-muted">owes you</div>
                                @elseif (Money::isNegative($r->balance))
                                    <span class="text-success">{{ money(Money::sub(0, $r->balance)) }}</span><div class="fs-11 text-muted">you hold</div>
                                @else
                                    <span class="text-muted">settled</span>
                                @endif
                            </td>
                            <td class="text-end text-nowrap">
                                @unless (Money::isZero($r->balance))
                                    <button type="button" class="btn btn-sm btn-light" title="Close the deal: book the balance as profit or loss"
                                        wire:click="$dispatch('deal-close', { companyId: {{ $r->company_id }}, departmentId: {{ $r->department_id }} })">
                                        <i class="ri-flag-2-line me-1"></i>Close deal
                                    </button>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <x-empty-row :colspan="5" icon="ri-government-line" message="No open balances." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
