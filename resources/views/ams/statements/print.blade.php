<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title }} — {{ $name }}</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 10px; color: #212529; margin: {{ $forPdf ? '0' : '24px' }}; }
        h1 { font-size: 18px; margin: 0 0 2px; }
        .muted { color: #6c757d; }
        .head { width: 100%; margin-bottom: 14px; }
        .head td { vertical-align: top; }
        .right { text-align: right; }
        table.lines { width: 100%; border-collapse: collapse; }
        table.lines th, table.lines td { border-bottom: 1px solid #dee2e6; padding: 4px 5px; vertical-align: top; }
        table.lines th { background: #f1f3f5; text-align: left; font-size: 9px; text-transform: uppercase; }
        table.lines td.num, table.lines th.num { text-align: right; white-space: nowrap; }
        tr.opening td, tr.closing td { background: #f8f9fa; font-weight: bold; }
        .neg { color: #dc3545; }
        .toolbar { margin-bottom: 16px; }
        .toolbar button, .toolbar a { padding: 6px 12px; font-size: 12px; margin-right: 6px; }
        @media print { .toolbar { display: none; } body { margin: 0; } }
    </style>
</head>
<body>
    @unless ($forPdf)
        <div class="toolbar">
            <button onclick="window.print()">Print</button>
            <a href="{{ route('statements.pdf', [$kind, $subject->id] + $query) }}">Download PDF</a>
        </div>
    @endunless

    <table class="head">
        <tr>
            <td>
                <h1>{{ $title }}</h1>
                <div class="muted">{{ config('app.name') }}</div>
            </td>
            <td class="right">
                <strong>{{ $name }}</strong><br>
                @if ($company && $kind !== 'company'){{ $company->name }}<br>@endif
                @if ($kind === 'account' && $subject->account_number)A/c {{ $subject->account_number }}<br>@endif
                @if ($kind === 'company' && $subject->ntn)NTN {{ $subject->ntn }}<br>@endif
                <span class="muted">Period: {{ $from ? $from->format('d M Y') : 'Beginning' }} – {{ $to->format('d M Y') }}</span>
            </td>
        </tr>
    </table>

    @php($span = 3 + ($showCompany ? 1 : 0) + ($showAmount ? 1 : 0))
    <table class="lines">
        <thead>
            <tr>
                <th>Date</th>
                <th>Particulars</th>
                @if ($showCompany)<th>Company</th>@endif
                <th>Ref</th>
                @if ($showAmount)<th class="num">Value</th>@endif
                <th class="num">{{ $labels['debit'] }}</th>
                <th class="num">{{ $labels['credit'] }}</th>
                <th class="num">{{ $labels['balance'] }}</th>
            </tr>
        </thead>
        <tbody>
            <tr class="opening">
                <td colspan="{{ $span + 2 }}">Opening balance</td>
                <td class="num">{{ money($opening, false) }}</td>
            </tr>
            @forelse ($rows as $r)
                <tr>
                    <td style="white-space:nowrap">{{ $r['date']->format('d M Y') }}</td>
                    <td>{{ $r['description'] }}@if ($r['notes'])<br><span class="muted">{{ $r['notes'] }}</span>@endif</td>
                    @if ($showCompany)<td>{{ $r['company'] }}</td>@endif
                    <td>{{ $r['reference'] }}</td>
                    @if ($showAmount)<td class="num muted">{{ money($r['amount'], false) }}</td>@endif
                    <td class="num">{{ $r['debit'] ? money($r['debit'], false) : '' }}</td>
                    <td class="num">{{ $r['credit'] ? money($r['credit'], false) : '' }}</td>
                    <td class="num {{ \App\Support\Money::isNegative($r['balance']) ? 'neg' : '' }}">{{ money($r['balance'], false) }}</td>
                </tr>
            @empty
                <tr><td colspan="{{ $span + 3 }}" class="muted">No entries in this period.</td></tr>
            @endforelse
            <tr class="closing">
                <td colspan="{{ $span }}">Closing balance</td>
                <td class="num">{{ money($totals['debit'], false) }}</td>
                <td class="num">{{ money($totals['credit'], false) }}</td>
                <td class="num">{{ money($closing, false) }}</td>
            </tr>
        </tbody>
    </table>

    @if ($note)<p class="muted" style="margin-top:10px">{{ $note }}</p>@endif
    <p class="muted" style="margin-top:14px">Generated {{ $generatedAt->format('d M Y H:i') }} · Amounts in PKR.</p>
</body>
</html>
