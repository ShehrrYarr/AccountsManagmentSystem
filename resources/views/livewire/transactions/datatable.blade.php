<?php

/**
 * Transaction journal: live filtering (date range, company, account, type, status),
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
    abort_unless(in_array($field, ['date', 'type', 'amount', 'cheque_number', 'id'], true), 400);
    $this->sortDir = $this->sortField === $field && $this->sortDir === 'asc' ? 'desc' : 'asc';
    $this->sortField = $field;
};

$toggle = function (int $id) {
    $this->expanded = in_array($id, $this->expanded, true)
        ? array_values(array_diff($this->expanded, [$id]))
        : [...$this->expanded, $id];
};

$baseQuery = computed(fn () => Transaction::query()
    ->when($this->companyId ?? $this->filterCompany, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->account, fn ($q, $acc) => $q->where(fn ($q) => $q
        ->where('source_account_id', $acc)
        ->orWhere('destination_account_id', $acc)
        ->orWhereHas('entries', fn ($e) => $e->where('bank_account_id', $acc))))
    ->when($this->type, fn ($q) => $q->where('type', $this->type))
    ->when($this->status !== 'all' && $this->status !== '', fn ($q) => $q->where('status', $this->status))
    ->when($this->from, fn ($q) => $q->whereDate('date', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('date', '<=', $this->to))
    ->when($this->search, function ($q) {
        $s = '%'.trim($this->search).'%';
        $q->where(fn ($q) => $q->where('description', 'like', $s)
            ->orWhere('cheque_number', 'like', $s)
            ->orWhere('notes', 'like', $s)
            ->orWhereHas('company', fn ($c) => $c->where('name', 'like', $s)));
    }));

$rows = computed(fn () => (clone $this->baseQuery)
    ->with(['company', 'sourceAccount', 'destinationAccount', 'creator', 'entries.bankAccount', 'entries.company'])
    ->orderBy($this->sortField, $this->sortDir)->orderBy('id', $this->sortDir)
    ->paginate($this->compact ? 10 : $this->perPage, pageName: 'txPage'));

$totals = computed(function () {
    $q = (clone $this->baseQuery)->where('status', TransactionStatus::Posted);

    return [
        'in' => Money::of((clone $q)->whereIn('type', TransactionType::inflows())->sum('amount')),
        'out' => Money::of((clone $q)->whereIn('type', TransactionType::outflows())->sum('amount')),
        'count' => (clone $this->baseQuery)->count(),
    ];
});

$companyOptions = computed(fn () => Options::companies(false));
$accountOptions = computed(fn () => Options::bankAccounts());

on(['transaction-updated' => function () {
    unset($this->baseQuery, $this->rows, $this->totals);
}]);

$clearFilters = function () {
    // Volt state has no class defaults, so set them explicitly instead of reset().
    $this->fill(['search' => '', 'from' => '', 'to' => '', 'filterCompany' => null, 'account' => null, 'type' => '']);
    $this->status = 'posted';
    $this->resetPage('txPage');
};

$exportCsv = function (): StreamedResponse {
    $query = (clone $this->baseQuery)
        ->with(['company', 'sourceAccount', 'destinationAccount', 'creator'])
        ->orderBy($this->sortField, $this->sortDir)->orderBy('id', $this->sortDir);

    $filename = 'transactions-'.now()->format('Ymd-His').'.csv';

    return response()->streamDownload(function () use ($query) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM so Excel shows "Rs." / names correctly
        fputcsv($out, ['ID', 'Date', 'Type', 'Company', 'Source Account', 'Destination Account', 'Cheque #', 'Description', 'Amount', 'Status', 'Notes', 'Entered By']);

        $query->chunk(500, function ($rows) use ($out) {
            foreach ($rows as $t) {
                fputcsv($out, [
                    $t->id,
                    $t->date->toDateString(),
                    $t->type->label(),
                    $t->company?->name,
                    $t->sourceAccount?->name,
                    $t->destinationAccount?->name,
                    $t->cheque_number,
                    $t->description,
                    Money::of($t->amount),
                    $t->status->label(),
                    $t->notes,
                    $t->creator?->name,
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
                <input type="search" class="form-control form-control-sm" placeholder="Search description, cheque #, company…" wire:model.live.debounce.350ms="search">
            </div>
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" title="From date">
            <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" title="To date">
            @unless ($companyId)
                <div style="min-width:190px">
                    <x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" />
                </div>
            @endunless
            <div style="min-width:170px">
                <x-searchable-select wire:model.live="account" :options="$this->accountOptions" placeholder="All accounts" />
            </div>
            <select class="form-select form-select-sm w-auto" wire:model.live="type">
                <option value="">All types</option>
                @foreach (TransactionType::cases() as $t)
                    <option value="{{ $t->value }}">{{ $t->label() }}</option>
                @endforeach
            </select>
            <select class="form-select form-select-sm w-auto" wire:model.live="status">
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
        <div class="px-4 py-2 border-bottom d-flex flex-wrap gap-4 fs-13 bg-light-subtle">
            <span><span class="text-muted">Records:</span> <strong>{{ number_format($this->totals['count']) }}</strong></span>
            <span><span class="text-muted">Cheque inflows:</span> <strong class="text-success">{{ money($this->totals['in']) }}</strong></span>
            <span><span class="text-muted">Company outflows:</span> <strong class="text-danger">{{ money($this->totals['out']) }}</strong></span>
        </div>
    @endunless

    <div class="card-body p-0">
        <div class="table-responsive" wire:loading.class="ams-loading" wire:target="search,from,to,filterCompany,account,type,status,sortBy,gotoPage,nextPage,previousPage,perPage">
            <table class="table table-hover align-middle mb-0 ams-table">
                <thead class="table-light">
                    <tr>
                        <th style="width:32px"></th>
                        <x-sort-th field="date" :sort="$sortField" :dir="$sortDir">Date</x-sort-th>
                        <x-sort-th field="type" :sort="$sortField" :dir="$sortDir">Type</x-sort-th>
                        <th>Description</th>
                        @unless ($companyId)<th>Company</th>@endunless
                        <th>Source → Destination</th>
                        <x-sort-th field="cheque_number" :sort="$sortField" :dir="$sortDir">Cheque #</x-sort-th>
                        <x-sort-th field="amount" :sort="$sortField" :dir="$sortDir" class="money">Amount</x-sort-th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->rows as $t)
                        <tr wire:key="tx-{{ $t->id }}" class="{{ $t->status === TransactionStatus::Void ? 'text-muted text-decoration-line-through' : '' }}">
                            <td>
                                <button type="button" class="btn btn-sm btn-text-primary icon-btn-sm" wire:click="toggle({{ $t->id }})" title="Show ledger lines">
                                    <i class="{{ in_array($t->id, $expanded) ? 'ri-subtract-line' : 'ri-add-line' }}"></i>
                                </button>
                            </td>
                            <td class="fs-13 text-nowrap">{{ $t->date->format('d M Y') }}</td>
                            <td><span class="badge {{ $t->type->badge() }}">{{ $t->type->label() }}</span></td>
                            <td class="fs-13" style="max-width:320px">
                                <div class="text-truncate" title="{{ $t->description }}">{{ $t->description }}</div>
                                @if ($t->notes)<div class="fs-11 text-muted text-truncate">{{ $t->notes }}</div>@endif
                            </td>
                            @unless ($companyId)
                                <td class="fs-13">
                                    @if ($t->company)
                                        <a href="{{ route('companies.show', $t->company_id) }}" class="text-body">{{ $t->company->name }}</a>
                                    @else — @endif
                                </td>
                            @endunless
                            <td class="fs-13 text-nowrap">
                                {{ $t->sourceAccount?->name ?? ($t->company && in_array($t->type, TransactionType::inflows()) ? 'Govt cheque' : '—') }}
                                <i class="ri-arrow-right-s-line text-muted"></i>
                                {{ $t->destinationAccount?->name ?? ($t->company ? $t->company->name : '—') }}
                            </td>
                            <td class="fs-13">{{ $t->cheque_number ?? '—' }}</td>
                            <td class="money fw-semibold">{{ money($t->amount) }}</td>
                            <td><span class="badge {{ $t->status->badge() }}">{{ $t->status->label() }}</span></td>
                        </tr>
                        @if (in_array($t->id, $expanded))
                            <tr wire:key="tx-lines-{{ $t->id }}" class="bg-light-subtle">
                                <td></td>
                                <td colspan="{{ $companyId ? 7 : 8 }}">
                                    <table class="table table-sm mb-0 fs-12">
                                        <thead><tr><th>Ledger account</th><th>Party</th><th class="text-end">Debit</th><th class="text-end">Credit</th></tr></thead>
                                        <tbody>
                                            @foreach ($t->entries as $e)
                                                <tr>
                                                    <td>{{ $e->ledger_account->label() }}</td>
                                                    <td>{{ $e->bankAccount?->name ?? $e->company?->name ?? '—' }}</td>
                                                    <td class="text-end">{{ \App\Support\Money::isPositive($e->debit) ? money($e->debit, false) : '' }}</td>
                                                    <td class="text-end">{{ \App\Support\Money::isPositive($e->credit) ? money($e->credit, false) : '' }}</td>
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
                        <x-empty-row :colspan="$companyId ? 8 : 9" icon="ri-book-2-line" message="No transactions match these filters." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex flex-wrap align-items-center gap-3">
        <div class="text-muted fs-13 me-auto">Showing {{ $this->rows->firstItem() ?? 0 }}–{{ $this->rows->lastItem() ?? 0 }} of {{ $this->rows->total() }}</div>
        @unless ($compact)
            <select class="form-select form-select-sm w-auto" wire:model.live="perPage">
                @foreach ([25, 50, 100, 250] as $n)
                    <option value="{{ $n }}">{{ $n }} / page</option>
                @endforeach
            </select>
        @endunless
        {{ $this->rows->onEachSide(1)->links() }}
    </div>
</div>
