<?php

/**
 * On-screen running-balance statement for an account (cash / bank), department, supplier or company.
 * Print and PDF use the same StatementService data.
 *
 *   <livewire:statements.ledger kind="department" :subject-id="$department->id" />
 */

use App\Services\StatementService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, state};

state(['kind' => 'account', 'subjectId' => null, 'companyId' => null])->locked();
state(['filterCompany' => null, 'from' => '', 'to' => '']);

$statement = computed(fn () => app(StatementService::class)->build(
    $this->kind,
    (int) $this->subjectId,
    $this->companyId ?? ($this->filterCompany ? (int) $this->filterCompany : null),
    $this->from ?: null,
    $this->to ?: null,
));

$companyOptions = computed(fn () => Options::companies());

$preset = function (string $range) {
    [$this->from, $this->to] = match ($range) {
        'month' => [now()->startOfMonth()->toDateString(), now()->toDateString()],
        'last-month' => [now()->subMonthNoOverflow()->startOfMonth()->toDateString(), now()->subMonthNoOverflow()->endOfMonth()->toDateString()],
        'year' => [now()->startOfYear()->toDateString(), now()->toDateString()],
        default => ['', ''],
    };
};

on(['transaction-updated' => function () {
    unset($this->statement);
}]);

?>

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center">
        <h5 class="card-title mb-0 me-auto">{{ $this->statement['title'] }}</h5>
        @if ($this->statement['companyFilter'] && ! $companyId)
            <div style="min-width:180px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
        @endif
        <div class="btn-group btn-group-sm" role="group" aria-label="Period">
            <button type="button" class="btn btn-light" wire:click="preset('month')">This month</button>
            <button type="button" class="btn btn-light" wire:click="preset('last-month')">Last month</button>
            <button type="button" class="btn btn-light" wire:click="preset('year')">This year</button>
            <button type="button" class="btn btn-light" wire:click="preset('all')">All</button>
        </div>
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" aria-label="From date">
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" aria-label="To date">
        @php($q = array_filter(['company' => $companyId ?? $filterCompany, 'from' => $from, 'to' => $to]))
        <a class="btn btn-sm btn-light" target="_blank" href="{{ route('statements.print', [$kind, $subjectId] + $q) }}"><i class="ri-printer-line me-1"></i>Print</a>
        <a class="btn btn-sm btn-danger" href="{{ route('statements.pdf', [$kind, $subjectId] + $q) }}"><i class="ri-file-pdf-2-line me-1"></i>PDF</a>
    </div>

    @php($s = $this->statement)
    <div class="card-body p-0" wire:loading.class="ams-loading" wire:target="from,to,preset,filterCompany">
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0 ams-table">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Particulars</th>
                        @if ($s['showCompany'])<th class="d-none d-md-table-cell">Company</th>@endif
                        <th class="d-none d-lg-table-cell">Ref</th>
                        @if ($s['showAmount'])<th class="money d-none d-lg-table-cell">Value</th>@endif
                        <th class="money">{{ $s['labels']['debit'] }}</th>
                        <th class="money">{{ $s['labels']['credit'] }}</th>
                        <th class="money">{{ $s['labels']['balance'] }}</th>
                    </tr>
                </thead>
                @php($span = 2 + ($s['showCompany'] ? 1 : 0) + 1 + ($s['showAmount'] ? 1 : 0))
                <tbody class="fs-13">
                    <tr class="table-light fw-semibold">
                        <td colspan="{{ $span + 2 }}">Opening balance{{ $s['from'] ? ' on '.$s['from']->format('d M Y') : '' }}</td>
                        <td class="money">{{ money($s['opening']) }}</td>
                    </tr>
                    @forelse ($s['rows'] as $r)
                        <tr wire:key="st-{{ $r['id'] }}">
                            <td class="text-nowrap">{{ $r['date']->format('d M Y') }}</td>
                            <td class="ams-desc-cell">
                                <span class="badge {{ $r['type']->badge() }} me-1">{{ $r['type']->label() }}</span>
                                <span class="ams-wrap-sm">{{ $r['description'] }}</span>
                                @if ($r['notes'])<div class="fs-11 text-muted">{{ $r['notes'] }}</div>@endif
                            </td>
                            @if ($s['showCompany'])<td class="d-none d-md-table-cell">{{ $r['company'] }}</td>@endif
                            <td class="d-none d-lg-table-cell">{{ $r['reference'] }}</td>
                            @if ($s['showAmount'])<td class="money text-muted d-none d-lg-table-cell">{{ money($r['amount']) }}</td>@endif
                            <td class="money text-success">{{ $r['debit'] ? money($r['debit']) : '' }}</td>
                            <td class="money text-danger">{{ $r['credit'] ? money($r['credit']) : '' }}</td>
                            <td class="money fw-medium {{ Money::isNegative($r['balance']) ? 'text-danger' : '' }}">{{ money($r['balance']) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ $span + 3 }}" class="text-center text-muted py-4">No entries in this period.</td></tr>
                    @endforelse
                    <tr class="table-light fw-semibold">
                        <td colspan="{{ $span }}">Closing balance</td>
                        <td class="money text-success">{{ money($s['totals']['debit']) }}</td>
                        <td class="money text-danger">{{ money($s['totals']['credit']) }}</td>
                        <td class="money">{{ money($s['closing']) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if ($s['note'])
        <div class="card-footer fs-12 text-muted"><i class="ri-information-line me-1"></i>{{ $s['note'] }}</div>
    @endif
</div>
