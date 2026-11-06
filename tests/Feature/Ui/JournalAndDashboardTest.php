<?php

namespace Tests\Feature\Ui;

use App\Enums\TransactionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

class JournalAndDashboardTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    public function test_datatable_filters_sorting_and_expand(): void
    {
        $other = $this->makeCompany('Omega Builders');
        $this->clearedCheque('11111');
        app(\App\Services\ChequeService::class)->performClear(
            $this->registerCheque(['company_id' => $other->id, 'amount' => '22222', 'cheque_number' => 'OMEGA-1']),
            $this->clearData(['clearing_method' => 'encashment']), $this->admin
        );

        // Company names also appear inside the filter dropdown options, so assert on the rows.
        $companies = fn ($t) => $t->get('rows')->getCollection()->pluck('company.name')->filter()->unique()->sort()->values()->all();

        $t = Volt::test('transactions.datatable');
        $this->assertSame(['Acme Traders', 'Omega Builders'], $companies($t));

        $t->set('filterCompany', $other->id);
        $this->assertSame(['Omega Builders'], $companies($t));

        $t->set('filterCompany', null)->set('account', $this->vault->id);
        $this->assertSame(['Omega Builders'], $companies($t));

        $t->set('account', null)->set('type', TransactionType::ChequeDeposit->value);
        $this->assertSame(['Acme Traders'], $companies($t));

        $t->set('type', '')
            ->call('sortBy', 'amount')->assertSet('sortField', 'amount')->assertSet('sortDir', 'asc')
            ->call('sortBy', 'amount')->assertSet('sortDir', 'desc');

        $this->assertSame('22222.00', (string) $t->get('rows')->first()->amount);
        $this->assertSame('33333.00', $t->get('totals')['in']);

        $first = \App\Models\Transaction::where('type', TransactionType::ChequeEncashment)->first();
        $t->call('toggle', $first->id)->assertSee('Company Payable')->assertSee('Cheques In Hand (memo)');
    }

    public function test_datatable_date_range_and_void_filter(): void
    {
        $cheque = $this->clearedCheque('5000');
        app(\App\Services\ChequeService::class)->performUpdate($cheque, ['amount' => '6000']);

        $t = Volt::test('transactions.datatable')->set('status', 'void');
        $this->assertGreaterThan(0, $t->get('rows')->total());
        $this->assertTrue($t->get('rows')->getCollection()->every(fn ($r) => $r->status->value === 'void'));

        $t->set('status', 'posted');
        $this->assertTrue($t->get('rows')->getCollection()->every(fn ($r) => $r->status->value === 'posted'));

        $t->set('from', now()->addDay()->toDateString())->assertSee('No transactions match');
    }

    public function test_csv_export(): void
    {
        $this->clearedCheque('7500', ['commission_type' => 'fixed', 'commission_rate' => '250']);

        Volt::test('transactions.datatable')
            ->call('exportCsv')
            ->assertFileDownloaded();
    }

    public function test_csv_export_content(): void
    {
        $this->clearedCheque('7500');

        $component = Volt::test('transactions.datatable');
        $response = $component->instance()->exportCsv();
        ob_start();
        $response->sendContent();
        $csv = ob_get_clean();

        $this->assertStringContainsString('Date,Type,Company', $csv);
        $this->assertStringContainsString('Cheque Deposit', $csv);
        $this->assertStringContainsString('7500.00', $csv);
    }

    public function test_overview_metrics_and_live_refresh(): void
    {
        $this->clearedCheque('100000', ['commission_type' => 'percent', 'commission_rate' => '2']);
        $this->registerCheque(['amount' => '5000']);

        $m = Volt::test('dashboard.overview-metrics');
        $metrics = $m->get('metrics');
        $this->assertSame('5000.00', $metrics['pendingAmount']);
        $this->assertSame(1, $metrics['pendingCount']);
        $this->assertSame('100000.00', $metrics['bank']);
        $this->assertSame('98000.00', $metrics['payables']);
        $this->assertSame('2000.00', $metrics['commission']);

        app(\App\Services\InternalTransferService::class)->create(['from_account_id' => $this->bank->id, 'to_account_id' => $this->vault->id, 'amount' => '30000'], $this->admin);
        $m->dispatch('transaction-updated');
        $this->assertSame('30000.00', $m->get('metrics')['vault']);
        $m->assertSee('Rs. 30,000.00');
    }

    public function test_charts_data_and_refresh_event(): void
    {
        $this->clearedCheque('50000');
        app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'bank_transfer', 'source_account_id' => $this->bank->id,
            'lines' => [['company_bank_account_id' => $this->companyAccount()->id, 'amount' => '20000']],
        ], $this->admin);

        $c = Volt::test('dashboard.charts');
        $data = $c->get('chartData');

        $this->assertCount(12, $data['monthly']['labels']);
        $this->assertSame(50000.0, (float) end($data['monthly']['in']));
        $this->assertSame(20000.0, (float) end($data['monthly']['out']));
        $this->assertSame(['HBL Main'], $data['liquidity']['labels']);
        $this->assertSame(['Acme Traders'], $data['topCompanies']['labels']);
        $this->assertSame([0.0, 20000.0, 0.0], $data['payoutMix']['values']);

        $c->dispatch('transaction-updated')->assertDispatched('charts-refresh');
        $c->set('months', 6)->assertDispatched('charts-refresh');
        $this->assertCount(6, $c->get('chartData')['monthly']['labels']);
    }

    public function test_company_statement_component_running_balances(): void
    {
        $this->clearedCheque('10000', ['clearing_method' => 'encashment', 'commission_type' => 'fixed', 'commission_rate' => '500']);
        app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '4000',
        ], $this->admin);
        $this->registerCheque(['amount' => '3000']);

        $s = Volt::test('companies.statement', ['companyId' => $this->company->id]);
        $data = $s->get('statement');

        $this->assertCount(2, $data['rows']);
        $this->assertSame('9500.00', $data['rows'][0]['credit']);
        $this->assertSame('9500.00', $data['rows'][0]['payable']);
        $this->assertSame('4000.00', $data['rows'][1]['debit']);
        $this->assertSame('5500.00', $data['closingPayable']);
        $this->assertSame('3000.00', $data['pendingTotal']);
        $s->assertSee('received but not yet cleared');

        // A period starting tomorrow opens with the full balance and has no rows.
        $s->set('from', now()->addDay()->toDateString());
        $this->assertSame('5500.00', $s->get('statement')['openingPayable']);
        $this->assertCount(0, $s->get('statement')['rows']);
    }
}
