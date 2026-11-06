<?php

/**
 * On-screen company statement with date range; PDF / print use the same data.
 */

use App\Models\Company;
use App\Services\StatementService;

use function Livewire\Volt\{computed, on, state};

state(['companyId' => null])->locked();
state(['from' => '', 'to' => '']);

$statement = computed(fn () => app(StatementService::class)->build(
    Company::withTrashed()->findOrFail($this->companyId),
    $this->from ?: null,
    $this->to ?: null,
));

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
        <h5 class="card-title mb-0 me-auto">Statement of account</h5>
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-light" wire:click="preset('month')">This month</button>
            <button type="button" class="btn btn-light" wire:click="preset('last-month')">Last month</button>
            <button type="button" class="btn btn-light" wire:click="preset('year')">This year</button>
            <button type="button" class="btn btn-light" wire:click="preset('all')">All time</button>
        </div>
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from" title="From">
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to" title="To">
        @php($q = array_filter(['from' => $from, 'to' => $to]))
        <a class="btn btn-sm btn-light" target="_blank" href="{{ route('companies.statement.print', [$companyId] + $q) }}"><i class="ri-printer-line me-1"></i>Print</a>
        <a class="btn btn-sm btn-danger" href="{{ route('companies.statement.pdf', [$companyId] + $q) }}"><i class="ri-file-pdf-2-line me-1"></i>PDF</a>
    </div>

    @php($s = $this->statement)
    <div class="card-body p-0" wire:loading.class="ams-loading" wire:target="from,to,preset">
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0 ams-table">
                <thead class="table-light">
                    <tr>
                        <th>Date</th><th>Particulars</th><th>Cheque / Ref</th>
                        <th class="money" title="Increases what you owe the company">Credit (+)</th><th class="money" title="Payouts and reversals that reduce what you owe">Debit (−)</th><th class="money">Payable</th>
                        @if ($s['hasReceivable'])<th class="money">Receivable</th>@endif
                    </tr>
                </thead>
                <tbody class="fs-13">
                    <tr class="table-light fw-semibold">
                        <td colspan="5">Opening balance {{ $s['from'] ? 'on '.$s['from']->format('d M Y') : '' }}</td>
                        <td class="money">{{ money($s['openingPayable']) }}</td>
                        @if ($s['hasReceivable'])<td class="money">{{ money($s['openingReceivable']) }}</td>@endif
                    </tr>
                    @forelse ($s['rows'] as $r)
                        <tr>
                            <td class="text-nowrap">{{ $r['date']->format('d M Y') }}</td>
                            <td><span class="badge {{ $r['type']->badge() }} me-1">{{ $r['type']->label() }}</span> {{ $r['description'] }}</td>
                            <td>{{ $r['reference'] ?? '' }}</td>
                            <td class="money text-success">{{ $r['credit'] ? money($r['credit']) : '' }}</td>
                            <td class="money text-danger">{{ $r['debit'] ? money($r['debit']) : '' }}</td>
                            <td class="money fw-medium">{{ money($r['payable']) }}</td>
                            @if ($s['hasReceivable'])<td class="money">{{ money($r['receivable']) }}</td>@endif
                        </tr>
                    @empty
                        <tr><td colspan="{{ $s['hasReceivable'] ? 7 : 6 }}" class="text-center text-muted py-4">No movements in this period.</td></tr>
                    @endforelse
                    <tr class="table-light fw-semibold">
                        <td colspan="3">Closing balance</td>
                        <td class="money text-success">{{ money($s['totals']['credited']) }}</td>
                        <td class="money text-danger">{{ money($s['totals']['paid']) }}</td>
                        <td class="money">{{ money($s['closingPayable']) }}</td>
                        @if ($s['hasReceivable'])<td class="money">{{ money($s['closingReceivable']) }}</td>@endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if ($s['pendingCheques']->isNotEmpty())
        <div class="card-footer fs-13">
            <i class="ri-time-line text-warning me-1"></i>
            {{ $s['pendingCheques']->count() }} cheque(s) worth <strong>{{ money($s['pendingTotal']) }}</strong> received but not yet cleared — not included in the payable above.
        </div>
    @endif
</div>
