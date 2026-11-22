<?php

namespace Tests\Feature\Ui;

use App\Enums\TransactionType;
use App\Models\Account;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use App\Models\Tax;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Balances;
use App\Services\DealService;
use App\Services\MasterDataService;
use App\Services\PaymentApprovalService;
use App\Services\PaymentService;
use App\Services\StatementService;
use App\Services\TransferService;
use App\Support\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * Taxes on bank payments: paid from the same bank on top of the payment, the company's cost,
 * each on its own line of the bank statement. The department / supplier get the full amount.
 */
class TaxesTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    private Tax $wht;

    private Tax $sales;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
        $this->fundBank('1500000');
        app(DealService::class)->saveOpening(null, ['account_id' => $this->cash->id, 'amount' => '40000', 'date' => now()->subMonth()->toDateString()]);
        $this->wht = Tax::create(['name' => 'Withholding tax']);
        $this->sales = Tax::create(['name' => 'Sales tax']);
    }

    protected function tearDown(): void
    {
        foreach (Transaction::posted()->with('entries')->get() as $t) {
            foreach ($t->entries->groupBy(fn ($e) => (string) $e->company_id) as $lines) {
                $this->assertSame(0, Money::cmp($lines->sum('debit'), $lines->sum('credit')), "transaction {$t->id} unbalanced");
            }
        }
        parent::tearDown();
    }

    public function test_a_department_bank_transfer_with_taxes(): void
    {
        $before = Balances::departmentBalance($this->dept->id, $this->company->id);

        $page = Volt::test('payments.create', ['asPage' => true])
            ->set('method', 'bank_transfer')->set('company_id', $this->company->id)->assertSet('account_id', $this->bank->id)
            ->assertSee('Taxes')
            ->set('amount', '1000000')->call('addTaxRow')->set('taxes.0.tax_id', $this->wht->id)->set('taxes.0.amount', '2000')
            ->call('addTaxRow')->set('taxes.1.tax_id', $this->sales->id)->set('taxes.1.amount', '500')
            ->assertSee('Rs. 1,002,500.00')
            ->call('addRow')->assertHasNoErrors()->assertSet('taxes', [])
            ->assertSee('+ Withholding tax Rs. 2,000.00');

        $page->call('saveAll')->assertHasNoErrors()->assertCount('rows', 0);

        // The bank paid 1,002,500; the department moved by 1,000,000 only; the taxes are a cost.
        $this->assertMoney('497500.00', $this->bank);
        $this->assertSame(Money::add($before, '1000000'), Balances::departmentBalance($this->dept->id, $this->company->id));
        $this->assertSame('2500.00', Balances::profit($this->company->id)['taxes']);
        $this->assertSame('2000.00', Balances::taxes()->get($this->wht->id)->paid);

        // The bank statement shows the payment and each tax on its own line.
        $rows = collect(app(StatementService::class)->build('account', $this->bank->id)['rows']);
        $this->assertSame(['1000000.00', '2000.00', '500.00'], $rows->slice(-3)->pluck('credit')->values()->all());
        $this->assertStringStartsWith('Withholding tax on: Bank transfer', $rows->slice(-2)->first()['description']);

        // Editing the payment: removing its taxes gives the bank the taxes back.
        $p = Payment::firstOrFail();
        $this->assertCount(2, $p->taxes);
        app(PaymentService::class)->savePayment($p, ['taxes' => []]);
        $this->assertCount(0, $p->fresh()->taxes);
        $this->assertSame(0, Transaction::posted()->where('type', TransactionType::Tax->value)->count());
        $this->assertMoney('500000.00', $this->bank);
    }

    public function test_goods_on_credit_and_cash_carry_no_taxes(): void
    {
        $page = Volt::test('payments.create', ['asPage' => true])->set('method', 'goods')->set('company_id', $this->company->id)
            ->set('supplier_id', $this->supplier->id)->assertSee('Taxes')
            ->call('addTaxRow')->set('taxes.0.tax_id', $this->wht->id)->set('taxes.0.amount', '100')
            ->set('on_credit', '1')->assertSet('taxes', [])->assertDontSee('+ New tax');

        $cash = app(PaymentService::class)->savePayment(null, ['method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '500',
            'date' => now()->toDateString(), 'taxes' => [['tax_id' => $this->wht->id, 'amount' => '50']]]);
        $this->assertCount(0, $cash->fresh()->taxes);
        $this->assertMoney('39500.00', $this->cash);
    }

    public function test_a_supplier_bank_payment_with_a_tax(): void
    {
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'on_credit' => true, 'account_id' => null, 'amount' => '30000', 'item_description' => 'Desks']);

        Volt::test('supplier-payments.create', ['asPage' => true])
            ->set('method', 'bank_transfer')->set('company_id', $this->company->id)
            ->set('amount', '10000')->call('addTaxRow')->set('taxes.0.tax_id', $this->wht->id)->set('taxes.0.amount', '150')
            ->call('addRow')->assertHasNoErrors()->call('saveAll')->assertHasNoErrors();

        $this->assertSame('20000.00', Balances::supplierOwed($this->supplier->id), 'the supplier got the full 10,000');
        $this->assertMoney('1489850.00', $this->bank);

        // Cash supplier payments have no tax fields.
        Volt::test('supplier-payments.create', ['asPage' => true])->assertSet('method', 'cash')->assertDontSee('+ New tax');
    }

    public function test_an_agents_tax_comes_out_of_their_bank_and_edits_go_to_the_admin(): void
    {
        $agent = User::factory()->create();
        $master = app(MasterDataService::class);
        $master->ensureAgentCash($agent, $this->admin);
        $agentBank = $master->saveAccount(null, ['agent_id' => $agent->id, 'type' => 'bank', 'name' => 'Meezan Savings', 'bank_name' => 'Meezan Bank'], $this->admin);
        app(TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $agentBank->id, 'amount' => '30000', 'date' => now()->toDateString()]);
        $this->actingAs($agent);

        Volt::test('payments.create', ['asPage' => true])->assertSee('Taxes')->assertDontSee('+ New tax')
            ->set('amount', '10000')->call('addTaxRow')->set('taxes.0.tax_id', $this->wht->id)->set('taxes.0.amount', '200')
            ->call('addRow')->assertHasNoErrors()->call('saveAll')->assertHasNoErrors();
        $this->assertSame('19800.00', Balances::agentOwed($agent->id, $this->company->id));
        $this->assertMoney('19800.00', $agentBank);

        // Only the admin adds tax names.
        Volt::test('payments.create', ['asPage' => true])->set('newTax', 'Agent tax')->call('addTax')->assertForbidden();

        // An agent's change to the taxes waits for the admin.
        $p = Payment::firstOrFail();
        $request = app(PaymentApprovalService::class)->requestEdit($p, ['taxes' => [['tax_id' => $this->wht->id, 'amount' => '300']]], $agent);
        $this->assertSame([['tax_id' => $this->wht->id, 'amount' => '300.00']], $request->changes['taxes']);
        $this->assertSame('200.00', $p->fresh()->taxTotal());

        app(PaymentApprovalService::class)->approve($request, $this->admin);
        $this->assertSame('300.00', $p->fresh()->taxTotal());
        $this->assertSame('19700.00', Balances::agentOwed($agent->id, $this->company->id));
        $this->assertSame(PaymentChangeRequest::APPROVED, $request->fresh()->status);
    }

    public function test_the_taxes_page_and_adding_a_tax_while_paying(): void
    {
        $page = Volt::test('payments.create', ['asPage' => true])->set('method', 'bank_transfer')->set('company_id', $this->company->id)
            ->set('addingTax', true)->set('newTax', 'Stamp duty')->call('addTax')->assertHasNoErrors();
        $stamp = Tax::where('name', 'Stamp duty')->firstOrFail();
        $page->assertSet('taxes', [['tax_id' => $stamp->id, 'amount' => '']])->assertSet('addingTax', false)
            ->set('amount', '5000')->set('taxes.0.amount', '25')->call('addRow')->assertHasNoErrors()->call('saveAll')->assertHasNoErrors();

        Volt::test('taxes.manage')->assertSee('Stamp duty')->assertSee('Rs. 25.00');
        Volt::test('taxes.payments', ['taxId' => $stamp->id])->assertSee('Bank transfer to Health Dept')->assertSee('Rs. 25.00');
        $this->get(route('taxes.show', $stamp))->assertOk();

        // A used tax is turned off rather than deleted; an unused one is deleted.
        Volt::test('taxes.manage')->call('delete', $stamp->id)->call('delete', $this->sales->id);
        $this->assertFalse($stamp->fresh()->is_active);
        $this->assertNull(Tax::find($this->sales->id));
    }
}
