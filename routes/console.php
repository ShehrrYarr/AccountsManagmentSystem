<?php

use App\Services\LedgerService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('ams:recalculate-balances', function (LedgerService $ledger) {
    $ledger->recalculateAll();
    $this->info('Company payables / receivables and account balances rebuilt from the journal.');
})->purpose('Rebuild cached running balances from posted journal entries');
