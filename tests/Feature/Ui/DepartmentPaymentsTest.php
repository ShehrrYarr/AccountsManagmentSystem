<?php

namespace Tests\Feature\Ui;

use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Balances;
use App\Services\DealService;
use App\Services\MasterDataService;
use App\Services\PaymentApprovalService;
use App\Services\PaymentService;
use App\Services\TransferService;
use App\Support\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * The Pay Department page (batch entry like the Deposit Cheque page), cash with no company,
 * and agents paying departments from their own banks (their edits wait for the admin).
 */
class DepartmentPaymentsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    private User $agent;

    private Account $agentBank;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
        $this->fundBank('100000');
        app(DealService::class)->saveOpening(null, ['account_id' => $this->cash->id, 'amount' => '40000', 'date' => now()->subMonth()->toDateString()]);

        $master = app(MasterDataService::class);
        $this->agent = User::factory()->create(['name' => 'Bilal Ahmed']);
        $master->ensureAgentCash($this->agent, $this->admin);
        $this->agentBank = $master->saveAccount(null, ['agent_id' => $this->agent->id, 'type' => 'bank', 'name' => 'Meezan Savings', 'bank_name' => 'Meezan Bank'], $this->admin);
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

    private function page()
    {
        return Volt::test('payments.create', ['asPage' => true]);
    }

    public function test_the_page_builds_a_table_and_saves_it_together(): void
    {
        $page = $this->page()
            ->assertSet('method', 'cash')
            ->assertSet('department_id', $this->dept->id)
            ->assertSee('Payment details')->assertSee('Amount &amp; description', false);

        // Cash: no company. The item card clears; the payment details stay.
        $page->set('amount', '5000')->set('item_description', 'Stationery')->set('received_by', 'Ali')->call('addRow')->assertHasNoErrors()
            ->assertSet('amount', '')->assertSet('item_description', '')->assertSet('method', 'cash')->assertCount('rows', 1);
        $this->assertNull($page->get('rows')[0]['company_id']);
        $this->assertSame($this->cash->id, $page->get('rows')[0]['account_id']);

        // Bank transfer: the company's (only) bank is picked.
        $page->set('method', 'bank_transfer')->set('company_id', $this->company->id)
            ->assertSet('account_id', $this->bank->id)
            ->set('amount', '20000')->set('reference', 'IBFT-1')->call('addRow')->assertHasNoErrors();

        // Goods on credit.
        $page->set('method', 'goods')->set('company_id', $this->company->id)->set('supplier_id', $this->supplier->id)->set('on_credit', '1')
            ->set('amount', '3000')->call('addRow')->assertHasErrors(['item_description'])
            ->set('item_description', '10 fans')->call('addRow')->assertHasNoErrors()
            ->assertCount('rows', 3)->assertSee('28,000.00');

        // Edit a row, then save everything.
        $page->call('editRow', 0)->assertSet('method', 'cash')->assertSet('amount', '5000.00')
            ->set('amount', '6000')->call('addRow')->assertSet('method', 'goods')
            ->call('saveAll')->assertHasNoErrors()->assertDispatched('transaction-updated')
            ->assertCount('rows', 0)->assertSet('method', 'goods');

        $this->assertSame(3, Payment::count());
        $cash = Payment::where('method', 'cash')->first();
        $this->assertNull($cash->company_id);
        $this->assertSame('Stationery', $cash->item_description);
        $this->assertMoney('34000.00', $this->cash);
        $this->assertMoney('80000.00', $this->bank);
        $this->assertSame('6000.00', Balances::departmentBalance($this->dept->id, Balances::NONE), 'cash: no company part');
        $this->assertSame('-77000.00', Balances::departmentBalance($this->dept->id, $this->company->id));
        $this->assertSame('3000.00', Balances::supplierOwed($this->supplier->id, $this->company->id));
    }

    public function test_save_all_is_all_or_nothing(): void
    {
        $page = $this->page()
            ->set('amount', '30000')->call('addRow')
            ->set('amount', '30000')->call('addRow')   // each fits, together they don't
            ->call('saveAll')->assertDispatched('toast', type: 'error');

        $this->assertSame(0, Payment::count());
        $this->assertMoney('40000.00', $this->cash);
        $page->assertCount('rows', 2);
    }

    public function test_an_agent_pays_from_their_own_bank_for_a_company(): void
    {
        app(TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->agentBank->id, 'amount' => '30000', 'date' => now()->toDateString()]);
        $this->actingAs($this->agent);

        $page = $this->page()
            ->assertSet('method', 'bank_transfer')->assertSet('company_id', $this->company->id)->assertSet('account_id', $this->agentBank->id)
            ->assertSee('Bank transfer from your bank')->assertDontSee('+ New department')->assertSee('You hold Rs. 30,000.00', false);

        // Only bank transfers from their own bank.
        $page->set('method', 'cash')->assertSet('method', 'bank_transfer');
        try {
            app(PaymentService::class)->savePayment(null, ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'method' => 'bank_transfer', 'account_id' => $this->bank->id, 'amount' => '1', 'date' => now()->toDateString()], $this->agent);
            $this->fail('An agent paid from a company bank.');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('your bank account', $e->getMessage());
        }

        // Paying more than they hold is allowed: the company then owes the agent.
        $page->set('amount', '12000')->set('item_description', 'Lab kits')->call('addRow')
            ->set('amount', '25000')->call('addRow')
            ->call('saveAll')->assertHasNoErrors();

        $this->assertSame('-7000.00', Balances::agentOwed($this->agent->id, $this->company->id));
        $this->assertMoney('-7000.00', $this->agentBank, 'an agent account may go below zero');
        $this->assertSame('-63000.00', Balances::departmentBalance($this->dept->id, $this->company->id), '100,000 cheque less 37,000 the agent paid');
        $this->assertSame('7000.00', Balances::owedToAgents());
        $this->assertSame('0.00', Balances::withAgents());
        $this->assertStringContainsString('by Bilal Ahmed from Meezan Savings', Payment::first()->describe());

        // The agent ledger shows the payments as money spent.
        $ledger = app(\App\Services\StatementService::class)->build('agent', $this->agent->id);
        $this->assertSame('-7000.00', $ledger['closing']);

        // An agent sees only their own payments.
        $this->actingAs($this->admin);
        app(PaymentService::class)->savePayment(null, ['method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '100', 'date' => now()->toDateString()]);
        $this->actingAs($this->agent);
        Volt::test('payments.list')->assertSee('Lab kits')->assertDontSee('Cash given');
        $this->get('/payments')->assertOk()->assertSee('My Department Payments');
    }

    public function test_an_agents_edit_and_delete_wait_for_the_admin(): void
    {
        app(TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->agentBank->id, 'amount' => '30000', 'date' => now()->toDateString()]);
        $payment = app(PaymentService::class)->savePayment(null, ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'method' => 'bank_transfer', 'account_id' => $this->agentBank->id, 'amount' => '10000', 'date' => now()->toDateString()], $this->agent);
        $this->assertSame($this->agent->id, $payment->created_by);
        $this->actingAs($this->agent);

        // The edit becomes a request; the payment is unchanged.
        Volt::test('payments.create')->dispatch('payment-edit', id: $payment->id)
            ->set('amount', '10500')->set('changeReason', 'Bank fee')
            ->call('save')->assertHasNoErrors()->assertDispatched('approval-updated');
        $request = PaymentChangeRequest::firstOrFail();
        $this->assertSame(['amount' => '10500.00'], $request->changes);
        $this->assertSame('10000.00', (string) $payment->fresh()->amount);
        Volt::test('payments.list')->assertSee('Edit pending');

        // The admin sees it on the bell and the Approvals page, and approves.
        $this->actingAs($this->admin);
        Volt::test('approvals.bell')->assertSee('asks to edit a payment');
        Volt::test('approvals.manage')->assertSee('Department payment changes waiting for you')->assertSee('Bank fee')
            ->call('approvePayment', $request->id)->assertHasNoErrors();
        $this->assertSame('10500.00', (string) $payment->fresh()->amount);
        $this->assertSame('19500.00', Balances::agentOwed($this->agent->id, $this->company->id));

        // A delete request, rejected: the payment stays.
        $delete = app(PaymentApprovalService::class)->requestDelete($payment->fresh(), $this->agent, 'Duplicate');
        Volt::test('approvals.manage')->call('startReject', $delete->id, 'payment')->set('rejectNote', 'Not a duplicate')->call('reject');
        $this->assertSame(PaymentChangeRequest::REJECTED, $delete->fresh()->status);
        $this->assertNotSoftDeleted($payment);

        // Agents can't delete directly, and can withdraw their own request.
        $this->actingAs($this->agent);
        $again = app(PaymentApprovalService::class)->requestDelete($payment->fresh(), $this->agent);
        Volt::test('payments.list')->call('withdrawRequest', $again->id);
        $this->assertModelMissing($again);
        Volt::test('payments.list')->call('delete', $payment->id)->assertForbidden();
        $this->assertNotSoftDeleted($payment);
    }

    public function test_cash_supplier_payments_and_expenses_have_no_company(): void
    {
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'on_credit' => true, 'account_id' => null, 'amount' => '8000', 'item_description' => 'Chairs']);

        Volt::test('supplier-payments.manage')
            ->dispatch('supplier-payment-create', supplierId: $this->supplier->id)
            ->set('account_id', $this->cash->id)->assertSee('Owed in total')
            ->set('amount', '5000')->call('save')->assertHasNoErrors();
        $this->assertSame('3000.00', Balances::supplierOwed($this->supplier->id));
        $this->assertSame('8000.00', Balances::supplierOwed($this->supplier->id, $this->company->id), 'the company still shows its purchase');
        $this->assertSame('-5000.00', Balances::supplierOwed($this->supplier->id, Balances::NONE));

        // Cash can't pay more than is owed in total.
        try {
            app(PaymentService::class)->saveSupplierPayment(null, ['supplier_id' => $this->supplier->id, 'account_id' => $this->cash->id, 'amount' => '3000.01', 'date' => now()->toDateString()]);
            $this->fail('Overpaid in cash.');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('more than is owed to Office Mart', $e->getMessage());
        }

        Volt::test('expenses.manage')
            ->dispatch('expense-create')
            ->set('expense_category_id', $this->category()->id)->set('description', 'Tea')->set('account_id', $this->bank->id)
            ->assertSee('Counts for')->set('amount', '700')->call('save')->assertHasNoErrors();
        $this->assertSame($this->company->id, \App\Models\Expense::first()->company_id, 'a bank expense is its company\'s');
    }
}
