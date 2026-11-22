<?php

/**
 * Every payment one tax was paid on (from the posted journal lines), with the total.
 *     <livewire:taxes.payments :tax-id="$tax->id" />
 */

use App\Enums\LedgerAccount;
use App\Models\Account;
use App\Models\JournalLedgerEntry;
use App\Services\Balances;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, mount, on, state, usesPagination};

usesPagination(theme: 'bootstrap');

state(['taxId' => null])->locked();
state(['from' => '', 'to' => '', 'companyId' => '']);

mount(function (int $taxId) {
    $this->taxId = $taxId;
});

$updated = function ($property) {
    if (in_array($property, ['from', 'to', 'companyId'], true)) {
        $this->resetPage();
    }
};

$baseQuery = fn () => Balances::forCompany(JournalLedgerEntry::posted()
    ->where('journal_ledger_entries.ledger_account', LedgerAccount::Tax->value)
    ->where('journal_ledger_entries.tax_id', $this->taxId), $this->companyId ? (int) $this->companyId : null)
    ->when($this->from, fn ($q) => $q->where('transactions.date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->where('transactions.date', '<=', $this->to));

$lines = computed(fn () => $this->baseQuery()
    ->select('journal_ledger_entries.*', 'transactions.date as tx_date', 'transactions.description as tx_description',
        'transactions.reference as tx_reference', 'transactions.account_id as tx_account_id')
    ->orderByDesc('transactions.date')->orderByDesc('journal_ledger_entries.id')
    ->paginate(20));

$total = computed(fn () => Money::of($this->baseQuery()->selectRaw('COALESCE(SUM(debit) - SUM(credit), 0) as v')->value('v')));

$names = computed(fn () => [
    'companies' => \App\Models\Company::withTrashed()->pluck('name', 'id'),
    'accounts' => Account::withTrashed()->whereIn('id', $this->lines->pluck('tx_account_id')->filter())->get()->mapWithKeys(fn ($a) => [$a->id => $a->shortLabel()]),
]);

$companyOptions = computed(fn () => Options::companies());

on(['transaction-updated' => function () {
    unset($this->lines, $this->total);
}]);

?>

<div>
    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-xl-4">
            <x-stat-card label="Paid{{ $from || $to ? ' in the period' : ' in total' }}" :value="money($this->total)" icon="ri-percent-line" color="danger" />
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <h5 class="card-title mb-0 me-auto">Payments it was paid on</h5>
            <select class="form-select form-select-sm w-auto" wire:model.live="companyId" aria-label="Company">
                <option value="">All companies</option>
                @foreach ($this->companyOptions as $c)
                    <option value="{{ $c['value'] }}">{{ $c['label'] }}</option>
                @endforeach
            </select>
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Payment</th><th class="d-none d-md-table-cell">Company</th><th class="d-none d-md-table-cell">Paid from</th><th class="money">Tax</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($this->lines as $l)
                            <tr wire:key="taxline-{{ $l->id }}">
                                <td class="fs-13 text-nowrap">{{ \Illuminate\Support\Carbon::parse($l->tx_date)->format('d M Y') }}</td>
                                <td class="fs-13 ams-desc-cell">
                                    {{ \Illuminate\Support\Str::after($l->tx_description, 'on: ') }}
                                    @if ($l->tx_reference)<div class="fs-12 text-muted">Ref {{ $l->tx_reference }}</div>@endif
                                </td>
                                <td class="fs-13 d-none d-md-table-cell">{{ $this->names['companies'][$l->company_id] ?? '—' }}</td>
                                <td class="fs-13 d-none d-md-table-cell">{{ $this->names['accounts'][$l->tx_account_id] ?? '—' }}</td>
                                <td class="money fw-semibold">{{ money(Money::sub($l->debit, $l->credit)) }}</td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="5" icon="ri-percent-line" message="This tax wasn't paid on any payment yet." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->lines->onEachSide(1)->links() }}</div>
    </div>
</div>
