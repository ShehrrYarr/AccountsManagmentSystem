<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Statement — {{ $company->name }}</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #212529; margin: {{ $forPdf ? '0' : '24px' }}; }
        h1 { font-size: 18px; margin: 0 0 2px; }
        h2 { font-size: 13px; margin: 18px 0 6px; }
        .muted { color: #6c757d; }
        .head { width: 100%; margin-bottom: 14px; }
        .head td { vertical-align: top; }
        .right { text-align: right; }
        table.lines { width: 100%; border-collapse: collapse; }
        table.lines th, table.lines td { border-bottom: 1px solid #dee2e6; padding: 5px 6px; }
        table.lines th { background: #f1f3f5; text-align: left; font-size: 10px; text-transform: uppercase; }
        table.lines td.num, table.lines th.num { text-align: right; white-space: nowrap; }
        tr.opening td, tr.closing td { background: #f8f9fa; font-weight: bold; }
        .summary { width: 100%; margin-top: 10px; border-collapse: collapse; }
        .summary td { padding: 6px 8px; border: 1px solid #dee2e6; }
        .pos { color: #198754; } .neg { color: #dc3545; }
        .toolbar { margin-bottom: 16px; }
        .toolbar button, .toolbar a { padding: 6px 12px; font-size: 12px; margin-right: 6px; }
        @media print { .toolbar { display: none; } body { margin: 0; } }
    </style>
</head>
<body>
    @unless ($forPdf)
        <div class="toolbar">
            <button onclick="window.print()">Print</button>
            <a href="{{ route('companies.statement.pdf', [$company, 'from' => $from?->toDateString(), 'to' => $to->toDateString()]) }}">Download PDF</a>
            <a href="{{ route('companies.show', $company) }}">Back</a>
        </div>
    @endunless

    <table class="head">
        <tr>
            <td>
                <h1>Statement of Account</h1>
                <div class="muted">{{ config('app.name') }}</div>
            </td>
            <td class="right">
                <strong>{{ $company->name }}</strong><br>
                @if ($company->contact_person){{ $company->contact_person }}<br>@endif
                @if ($company->phone){{ $company->phone }}<br>@endif
                @if ($company->ntn)NTN {{ $company->ntn }}<br>@endif
                <span class="muted">Period: {{ $from ? $from->format('d M Y') : 'Beginning' }} – {{ $to->format('d M Y') }}</span>
            </td>
        </tr>
    </table>

    <table class="lines">
        <thead>
            <tr>
                <th>Date</th>
                <th>Particulars</th>
                <th>Cheque / Ref</th>
                <th class="num">Credit (+)</th>
                <th class="num">Debit (-)</th>
                <th class="num">Payable</th>
                @if ($hasReceivable)<th class="num">Receivable</th>@endif
            </tr>
        </thead>
        <tbody>
            <tr class="opening">
                <td colspan="5">Opening balance</td>
                <td class="num">{{ money($openingPayable, false) }}</td>
                @if ($hasReceivable)<td class="num">{{ money($openingReceivable, false) }}</td>@endif
            </tr>
            @forelse ($rows as $r)
                <tr>
                    <td>{{ $r['date']->format('d M Y') }}</td>
                    <td>{{ $r['description'] }}@if ($r['notes'])<br><span class="muted">{{ $r['notes'] }}</span>@endif</td>
                    <td>{{ $r['reference'] }}</td>
                    <td class="num">{{ $r['credit'] ? money($r['credit'], false) : '' }}</td>
                    <td class="num">{{ $r['debit'] ? money($r['debit'], false) : '' }}</td>
                    <td class="num">{{ money($r['payable'], false) }}</td>
                    @if ($hasReceivable)<td class="num">{{ money($r['receivable'], false) }}</td>@endif
                </tr>
            @empty
                <tr><td colspan="{{ $hasReceivable ? 7 : 6 }}" class="muted">No movements in this period.</td></tr>
            @endforelse
            <tr class="closing">
                <td colspan="3">Closing balance</td>
                <td class="num">{{ money($totals['credited'], false) }}</td>
                <td class="num">{{ money($totals['paid'], false) }}</td>
                <td class="num">{{ money($closingPayable, false) }}</td>
                @if ($hasReceivable)<td class="num">{{ money($closingReceivable, false) }}</td>@endif
            </tr>
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td>Amount we hold for you (payable)</td><td class="right pos"><strong>{{ money($closingPayable) }}</strong></td>
            @if ($hasReceivable)<td>Amount you owe us (receivable)</td><td class="right neg"><strong>{{ money($closingReceivable) }}</strong></td>@endif
        </tr>
    </table>

    @if ($pendingCheques->isNotEmpty())
        <h2>Cheques received, not yet cleared ({{ money($pendingTotal) }})</h2>
        <table class="lines">
            <thead><tr><th>Received</th><th>Cheque #</th><th>Bank</th><th>Valid until</th><th class="num">Amount</th></tr></thead>
            <tbody>
                @foreach ($pendingCheques as $c)
                    <tr>
                        <td>{{ $c->received_date->format('d M Y') }}</td>
                        <td>{{ $c->cheque_number }}</td>
                        <td>{{ $c->issuing_bank }}</td>
                        <td>{{ $c->expiry_date->format('d M Y') }}</td>
                        <td class="num">{{ money($c->amount, false) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p class="muted" style="margin-top:18px">Generated {{ $generatedAt->format('d M Y H:i') }} · Amounts in PKR.</p>
</body>
</html>
