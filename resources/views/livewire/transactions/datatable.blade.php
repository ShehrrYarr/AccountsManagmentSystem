<?php

/**
 * Transaction journal: live filtering (dates, company, account, department, supplier, type, status),
 * sorting, pagination, expandable double-entry lines and CSV export.
 */

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Support\Money;
use App\Support\Options;
use Symfony\Component\HttpFoundation\StreamedResponse;

use function Livewire\Volt\{computed, on, state, usesPagination};

usesPagination(theme: 'bootstrap');

state(['companyId' => null, 'compact' => false])->locked();

state([
    'search' => '',
    'from' => '',
    'to' => '',
    'filterCompany' => null,
    'account' => null,
    'department' => null,
    'type' => '',
    'status' => 'posted',
    'perPage' => 25,
    'sortField' => 'date',
    'sortDir' => 'desc',
]);

state(['expanded' => []]);

$updated = function ($property) {
    if (! in_array($property, ['sortField', 'sortDir', 'expanded'], true)) {
        $this->resetPage('txPage');
    }
};

$sortBy = function (string $field) {
    abort_unless(in_array($field, ['date', 'type', 'amount', 'reference', 'id'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

$toggle = function (int $id) {
    $this->expanded = in_array($id, $this->expanded, true)
        ? array_values(array_diff($this->expanded, [$id]))
        : [...$this->expanded, $id];
};

$baseQuery = computed(fn () => Transaction::query()
    ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->whereHas('entries', fn ($e) => $e->where('company_id', $id)))
    ->when($this->account, fn ($q, $acc) => $q->whereHas('entries', fn ($e) => $e->where('account_id', $acc)))
    ->when($this->department, fn ($q, $d) => $q->where('department_id', $d))
    ->when($this->type, fn ($q) => $q->where('type', $this->type))
    ->when($this->status !== 'all' && $this->status !== '', fn ($q) => $q->where('status', $this->status))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, function ($q) {
        $s = '%'.trim($this->search).'%';
        $q->where(fn ($q) => $q->where('description', 'like', $s)
            ->orWhere('reference', 'like', $s)
            ->orWhere('notes', 'like', $s));
    }));

$rows = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'counterpartyCompany', 'creator', 'entries.account', 'entries.department', 'entries.supplier', 'entries.counterparty', 'entries.category', 'entries.company'])
    ->orderBy($this->sortField, $this->sortDir)->orderBy('id', $this->sortDir)
    ->paginate($this->compact ? 10 : $this->perPage, pageName: 'txPage'));

$totals = computed(fn () => [
    'count' => (clone $this->baseQuery)->count(),
    'amount' => Money::of((clone $this->baseQuery)->where('status', TransactionStatus::Posted)->sum('amount')),
]);

$companyOptions = computed(fn () => Options::companies());
$accountOptions = computed(fn () => Options::accounts($this->companyId));
$departmentOptions = computed(fn () => Options::departments());

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->rows, $this->totals);
}]);

$clearFilters = function () {
    // Volt state has no class defaults, so set them explicitly instead of reset().
    $this->fill(['search' => '', 'from' => '', 'to' => '', 'filterCompany' => null, 'account' => null, 'department' => null, 'type' => '', 'status' => 'posted']);
    $this->resetPage('txPage');
};

$exportCsv = function (): StreamedResponse {
    $query = (clone $this->baseQuery)
        ->with(['company', 'counterpartyCompany', 'account', 'toAccount', 'department', 'supplier', 'creator'])
        ->orderBy($this->sortField, $this->sortDir)->orderBy('id', $this->sortDir);

    $filename = 'transactions-'.now()->format('Ymd-His').'.csv';

    return response()->streamDownload(function () use ($query) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM so Excel shows "Rs." / names correctly
        fputcsv($out, ['ID', 'Date', 'Type', 'Company', 'Other company', 'From account', 'To account', 'Department', 'Supplier', 'Reference', 'Description', 'Amount', 'Status', 'Notes', 'Entered By']);

        $query->chunk(500, function ($rows) use ($out) {
            foreach ($rows as $t) {
                fputcsv($out, [
                    $t->id, $t->date->toDateString(), $t->type->label(), $t->company?->name, $t->counterpartyCompany?->name,
                    $t->account?->shortLabel(), $t->toAccount?->shortLabel(), $t->department?->name, $t->supplier?->name,
                    $t->reference, $t->description, Money::of($t->amount), $t->status->label(), $t->notes, $t->creator?->name,
                ]);
            }
        });
        fclose($out);
    }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
};

?>

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center">
        @if ($compact)
            <h5 class="card-title mb-0 me-auto">Recent transactions</h5>
            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-light">View journal <i class="ri-arrow-right-line"></i></a>
        @else
            <div class="flex-grow-1" style="min-width:200px">
                <input type="search" class="form-control form-control-sm" placeholder="Search description, reference, notes…" aria-label="Search transactions" wire:model.live.debounce.350ms="search">
            </div>
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
            @unless ($companyId)
                <div style="min-width:180px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
            @endunless
            <div style="min-width:180px"><x-searchable-select wire:model.live="account" :options="$this->accountOptions" placeholder="All accounts" size="sm" /></div>
            <div style="min-width:170px"><x-searchable-select wire:model.live="department" :options="$this->departmentOptions" placeholder="All departments" size="sm" /></div>
            <select class="form-select form-select-sm w-auto" wire:model.live="type" aria-label="Type">
                <option value="">All types</option>
                @foreach (TransactionType::cases() as $t)
                    <option value="{{ $t->value }}">{{ $t->label() }}</option>
                @endforeach
            </select>
            <select class="form-select form-select-sm w-auto" wire:model.live="status" aria-label="Status">
                <option value="posted">Posted only</option>
                <option value="void">Void only</option>
                <option value="all">All</option>
            </select>
            <button type="button" class="btn btn-sm btn-light" wire:click="clearFilters" title="Reset filters"><i class="ri-refresh-line"></i></button>
            <button type="button" class="btn btn-sm btn-success" wire:click="exportCsv" wire:loading.attr="disabled" wire:target="exportCsv">
                <i class="ri-file-excel-2-line me-1"></i>Export CSV
            </button>
        @endif
    </div>

    @unless ($compact)
        <div class="px-4 py-2 border-bottom d-flex flex-wrap gap-4 fs-13 bg-body-tertiary">
            <span><span class="text-muted">Records:</span> <strong>{{ number_format($this->totals['count']) }}</strong></span>
            <span><span class="text-muted">Total value (posted):</span> <strong>{{ money($this->totals['amount']) }}</strong></span>
        </div>
    @endunless

    <div class="card-body p-0">
        <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,from,to,filterCompany,account,department,type,status,sortBy,gotoPage,nextPage,previousPage,perPage">
            <table class="table table-hover align-middle mb-0 ams-table">
                <thead class="table-light">
                    <tr>
                        <th style="width:32px"></th>
                        <x-sort-th field="date" :sort="$sortField" :dir="$sortDir">Date</x-sort-th>
                        <x-sort-th field="type" :sort="$sortField" :dir="$sortDir" class="d-none d-md-table-cell">Type</x-sort-th>
                        <th>Description</th>
                        @unless ($companyId)<th class="d-none d-lg-table-cell">Company</th>@endunless
                        <x-sort-th field="reference" :sort="$sortField" :dir="$sortDir" class="d-none d-lg-table-cell">Ref</x-sort-th>
                        <x-sort-th field="amount" :sort="$sortField" :dir="$sortDir" class="money d-none d-md-table-cell">Amount</x-sort-th>
                        <th class="d-none d-md-table-cell">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->rows as $t)
                        <tr wire:key="tx-{{ $t->id }}" class="{{ $t->status === TransactionStatus::Void ? 'text-muted text-decoration-line-through' : '' }}">
                            <td>
                                <button type="button" class="btn btn-sm btn-text-primary icon-btn-sm" wire:click="toggle({{ $t->id }})" title="Show ledger lines" aria-label="Show ledger lines">
                                    <i class="{{ in_array($t->id, $expanded) ? 'ri-subtract-line' : 'ri-add-line' }}"></i>
                                </button>
                            </td>
                            <td class="fs-13 text-nowrap">{{ $t->date->format('d M Y') }}</td>
                            <td class="d-none d-md-table-cell"><span class="badge {{ $t->type->badge() }}">{{ $t->type->label() }}</span></td>
                            <td class="fs-13 ams-desc-cell">
                                <div class="d-md-none mb-1">
                                    <span class="badge {{ $t->type->badge() }}">{{ $t->type->label() }}</span>
                                    @if ($t->status === TransactionStatus::Void)<span class="badge {{ $t->status->badge() }}">Void</span>@endif
                                </div>
                                <div class="text-truncate ams-wrap-sm" title="{{ $t->description }}">{{ $t->description }}</div>
                                @if ($t->notes)<div class="fs-11 text-muted text-truncate ams-wrap-sm">{{ $t->notes }}</div>@endif
                                <div class="d-md-none fw-semibold mt-1">{{ money($t->amount) }}</div>
                            </td>
                            @unless ($companyId)
                                <td class="fs-13 d-none d-lg-table-cell">
                                    @if ($t->company)<a href="{{ route('companies.show', $t->company_id) }}" class="text-body">{{ $t->company->name }}</a>@else — @endif
                                    @if ($t->counterpartyCompany)<div class="fs-12 text-muted">→ {{ $t->counterpartyCompany->name }}</div>@endif
                                </td>
                            @endunless
                            <td class="fs-13 d-none d-lg-table-cell">{{ $t->reference ?? '—' }}</td>
                            <td class="money fw-semibold d-none d-md-table-cell">{{ money($t->amount) }}</td>
                            <td class="d-none d-md-table-cell"><span class="badge {{ $t->status->badge() }}">{{ $t->status->label() }}</span></td>
                        </tr>
                        @if (in_array($t->id, $expanded))
                            <tr wire:key="tx-lines-{{ $t->id }}" class="bg-body-tertiary">
                                <td></td>
                                <td colspan="{{ $companyId ? 6 : 7 }}">
                                    <table class="table table-sm mb-0 fs-12">
                                        <thead><tr><th>Ledger account</th><th>Company</th><th>Party</th><th class="text-end">Debit</th><th class="text-end">Credit</th></tr></thead>
                                        <tbody>
                                            @foreach ($t->entries as $e)
                                                <tr>
                                                    <td>{{ $e->ledger_account->label() }}</td>
                                                    <td>{{ $e->company?->name }}</td>
                                                    <td>{{ $e->partyName() }}</td>
                                                    <td class="text-end">{{ Money::isPositive($e->debit) ? money($e->debit, false) : '' }}</td>
                                                    <td class="text-end">{{ Money::isPositive($e->credit) ? money($e->credit, false) : '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="fs-11 text-muted mt-1">
                                        #{{ $t->id }} · entered by {{ $t->creator?->name ?? 'system' }} {{ $t->created_at->diffForHumans() }}
                                        @if ($t->voided_at) · voided {{ $t->voided_at->diffForHumans() }} @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <x-empty-row :colspan="$companyId ? 7 : 8" icon="ri-book-2-line" message="No transactions match these filters." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex flex-wrap align-items-center gap-3">
        <div class="text-muted fs-13 me-auto">Showing {{ $this->rows->firstItem() ?? 0 }}–{{ $this->rows->lastItem() ?? 0 }} of {{ $this->rows->total() }}</div>
        @unless ($compact)
            <select class="form-select form-select-sm w-auto" wire:model.live="perPage" aria-label="Rows per page">
                @foreach ([25, 50, 100, 250] as $n)
                    <option value="{{ $n }}">{{ $n }} / page</option>
                @endforeach
            </select>
        @endunless
        {{ $this->rows->onEachSide(1)->links() }}
    </div>
</div>
