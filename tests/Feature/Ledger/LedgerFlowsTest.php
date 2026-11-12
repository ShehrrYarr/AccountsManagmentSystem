<?php

namespace Tests\Feature\Ledger;

use App\Enums\TransactionStatus;
use App\Exceptions\BusinessRuleException;
use App\Models\JournalLedgerEntry;
use App\Models\Transaction;
use App\Services\Balances;
use App\Services\ChequeService;
use App\Services\DealService;
use App\Services\LedgerService;
use App\Services\MasterDataService;
use App\Services\PaymentService;
use App\Services\TransferService;
use App\Support\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * Accounting rules of the middle-man model: my companies, govt-department customers,
 * suppliers and inter-company balances.
 */
class LedgerFlowsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    protected function tearDown(): void
    {
        $this->assertJournalConsistent();
        parent::tearDown();
    }

    /** Every posted transaction balances (overall and per company) and cached balances match the journal. */
    private function assertJournalConsistent(): void
    {
        foreach (Transaction::posted()->with('entries')->get() as $t) {
            foreach ($t->entries->groupBy('company_id') as $lines) {
                $this->assertSame(0, Money::cmp($lines->sum('debit'), $lines->sum('credit')), "Transaction #{$t->id} unbalanced");
            }
        }

        $before = \App\Models\Account::withTrashed()->pluck('current_balance', 'id')->map(fn ($v) => (string) $v);
        app(LedgerService::class)->recalculateAll();
        $after = \App\Models\Account::withTrashed()->pluck('current_balance', 'id')->map(fn ($v) => (string) $v);
        $this->assertEquals($before->all(), $after->all(), 'cached balances drifted from the journal');
    }

    // ---------------------------------------------------------------- companies & accounts

    public function test_companies_share_the_admin_cash_in_hand(): void
    {
        $co = $this->makeCompany('Zamzam Enterprises');
        $this->assertCount(0, $co->accounts, 'a company has no cash account of its own');
        $this->assertTrue($this->cash->isAdminCash());

        // Cash openings are per company, on the admin's cash.
        $deals = app(\App\Services\DealService::class);
        $deals->saveOpening(null, ['company_id' => $this->company->id, 'account_id' => $this->cash->id, 'amount' => '30000', 'date' => now()->subMonth()->toDateString()]);
        $deals->saveOpening(null, ['company_id' => $co->id, 'account_id' => $this->cash->id, 'amount' => '20000', 'date' => now()->subMonth()->toDateString()]);
        $this->assertMoney('50000.00', $this->cash);
        $this->assertSame('30000.00', Balances::money($this->company->id)['cash']);
        $this->assertSame('20000.00', Balances::money($co->id)['cash']);
        $this->assertSame('50000.00', Balances::money()['cash']);

        // Zamzam pays cash for a department: the admin's cash goes down, Zamzam's share too.
        $this->pay(['company_id' => $co->id, 'method' => 'cash', 'account_id' => null, 'amount' => '5000']);
        $this->assertMoney('45000.00', $this->cash);
        $this->assertSame('15000.00', Balances::money($co->id)['cash']);

        try {
            app(MasterDataService::class)->saveAccount(null, ['company_id' => $co->id, 'type' => 'cash', 'name' => 'Company cash']);
            $this->fail('A company cash account was allowed.');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('bank accounts only', $e->getMessage());
        }

        $this->expectException(BusinessRuleException::class);
        $deals->saveOpening(null, ['company_id' => $co->id, 'account_id' => $this->cash->id, 'amount' => '-10', 'date' => now()->toDateString()]);
    }

    public function test_agents_have_their_own_accounts_kept_out_of_the_books(): void
    {
        $agent = \App\Models\User::factory()->create(['name' => 'Bilal']);
        $master = app(MasterDataService::class);
        $cash = $master->ensureAgentCash($agent, $this->admin);
        $this->assertSame($cash->id, $master->ensureAgentCash($agent)->id, 'one cash in hand per agent');

        $bank = $master->saveAccount(null, ['agent_id' => $agent->id, 'type' => 'bank', 'name' => 'Meezan', 'bank_name' => 'Meezan Bank', 'opening_balance' => '9999'], $this->admin);
        $this->assertTrue($bank->addedByAdmin());
        $this->assertSame('0.00', (string) $bank->opening_balance, 'agent accounts are not used yet');
        $this->assertSame(0, Transaction::count() - Transaction::where('source_type', '!=', 'account')->count());
        $this->assertNotContains($bank->id, array_column(\App\Support\Options::accounts(), 'value'));
        $this->assertNotContains($cash->id, array_column(\App\Support\Options::accounts($this->company->id), 'value'));

        $this->expectException(BusinessRuleException::class);
        $master->deleteAccount($cash);
    }

    public function test_changing_an_opening_balance_reposts_it(): void
    {
        $bank = $this->makeBank($this->company, 'MCB Current', '5000');
        app(MasterDataService::class)->saveAccount($bank, ['opening_balance' => '7500']);

        $this->assertMoney('7500.00', $bank);
        $this->assertSame(1, Transaction::posted()->where('source_type', 'account')->where('source_id', $bank->id)->count());
    }

    // ---------------------------------------------------------------- cheques

    public function test_a_cheque_is_deposited_in_one_step(): void
    {
        $cheque = $this->cheque(['amount' => '50000', 'bank_charges' => '150']);

        $this->assertMoney('49850.00', $this->bank);
        $this->assertSame('-50000.00', Balances::departmentBalance($this->dept->id, $this->company->id), 'department sees the full cheque');
        $this->assertSame('150.00', Balances::profit($this->company->id)['charges']);
        $this->assertSame(1, $cheque->transactions()->count(), 'one journal transaction per cheque');
        $this->assertStringContainsString('deposited into HBL Current (bank charges Rs. 150.00)', $cheque->transactions()->first()->description);
    }

    public function test_a_cheque_can_only_go_into_the_same_companys_bank(): void
    {
        $other = $this->makeCompany('Zamzam Enterprises');
        $otherBank = $this->makeBank($other);

        try {
            $this->cheque(['deposit_account_id' => $otherBank->id]);
            $this->fail('Deposit into another company was allowed.');
        } catch (BusinessRuleException $e) {
            $this->assertSame('deposit_account_id', $e->field);
        }

        $this->expectException(BusinessRuleException::class);
        $this->cheque(['deposit_account_id' => $this->cash->id]);
    }

    public function test_expired_and_post_dated_cheques_are_blocked(): void
    {
        $this->cheque(['cheque_date' => now()->subMonths(6)->toDateString(), 'date' => now()->toDateString()]); // last valid day

        try {
            $this->cheque(['cheque_date' => now()->subMonths(6)->subDay()->toDateString(), 'date' => now()->toDateString()]);
            $this->fail('Expired cheque was accepted.');
        } catch (BusinessRuleException $e) {
            $this->assertSame('cheque_date', $e->field);
            $this->assertStringContainsString('expired', $e->getMessage());
        }

        $this->expectException(BusinessRuleException::class);
        $this->cheque(['cheque_date' => now()->toDateString(), 'date' => now()->subDay()->toDateString()]);
    }

    public function test_editing_and_deleting_cheques_rebuild_the_ledger(): void
    {
        $svc = app(ChequeService::class);
        $cheque = $this->fundBank('80000');
        $mcb = $this->makeBank($this->company, 'MCB Current');

        $svc->save($cheque, ['amount' => '90000', 'deposit_account_id' => $mcb->id]);
        $this->assertMoney('0.00', $this->bank);
        $this->assertMoney('90000.00', $mcb);
        $this->assertSame('-90000.00', Balances::departmentBalance($this->dept->id));

        $svc->delete($cheque->fresh());
        $this->assertMoney('0.00', $mcb);
        $this->assertSame('0.00', Balances::departmentBalance($this->dept->id));
        $this->assertSoftDeleted($cheque);
    }

    public function test_deleting_a_cheque_is_blocked_when_the_money_was_already_spent(): void
    {
        $cheque = $this->fundBank('50000');
        $this->pay(['amount' => '40000']);

        $this->expectException(BusinessRuleException::class);
        app(ChequeService::class)->delete($cheque->fresh());
    }

    // ---------------------------------------------------------------- spending for departments

    public function test_cash_transfer_and_goods_all_debit_the_department(): void
    {
        $this->fundBank('100000');
        app(TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->cash->id, 'amount' => '30000', 'date' => now()->toDateString()]);

        $cash = $this->pay(['method' => 'cash', 'account_id' => null, 'amount' => '10000', 'received_by' => 'Ali']);
        $this->pay(['method' => 'bank_transfer', 'amount' => '20000', 'reference' => 'IBFT-1']);
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'account_id' => $this->bank->id, 'amount' => '15000', 'item_description' => '10 chairs']);

        $this->assertSame($this->cash->id, $cash->account_id, 'cash payments always use the cash in hand');
        $this->assertMoney('20000.00', $this->cash);
        $this->assertMoney('35000.00', $this->bank);
        // 100,000 cheque − 45,000 spent: I still hold 55,000 of theirs.
        $this->assertSame('-55000.00', Balances::departmentBalance($this->dept->id));
        $this->assertSame('0.00', Balances::supplierOwed($this->supplier->id), 'goods paid on the spot leave nothing owed');
        $this->assertStringContainsString('Cash given to Health Dept (received by Ali)', $cash->transactions()->first()?->description ?? Transaction::where('source_id', $cash->id)->where('source_type', 'payment')->value('description'));
    }

    public function test_goods_on_credit_are_owed_to_the_supplier_until_paid(): void
    {
        $this->fundBank('50000');
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'on_credit' => true, 'account_id' => null, 'amount' => '30000']);

        $this->assertSame('30000.00', Balances::supplierOwed($this->supplier->id, $this->company->id));
        $this->assertMoney('50000.00', $this->bank, 'nothing paid yet');

        $svc = app(PaymentService::class);
        $svc->saveSupplierPayment(null, ['company_id' => $this->company->id, 'supplier_id' => $this->supplier->id, 'account_id' => $this->bank->id, 'amount' => '20000', 'date' => now()->toDateString()]);
        $this->assertSame('10000.00', Balances::supplierOwed($this->supplier->id));
        $this->assertMoney('30000.00', $this->bank);

        try {
            $svc->saveSupplierPayment(null, ['company_id' => $this->company->id, 'supplier_id' => $this->supplier->id, 'account_id' => $this->bank->id, 'amount' => '10000.01', 'date' => now()->toDateString()]);
            $this->fail('Overpaying a supplier was allowed.');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('more than Al-Noor Traders owes Office Mart', $e->getMessage());
        }
        $this->assertMoney('30000.00', $this->bank, 'rolled back');
    }

    public function test_spending_more_than_the_account_holds_is_blocked(): void
    {
        $this->fundBank('5000');

        $this->expectException(BusinessRuleException::class);
        $this->expectExceptionMessage('Not enough money in Al-Noor Traders · HBL Current');
        $this->pay(['amount' => '5000.01']);
    }

    public function test_spending_can_come_before_the_cheque(): void
    {
        $this->fundBank('20000', ['department_id' => $this->makeDepartment()->id]);
        $this->pay(['amount' => '12000']);

        $this->assertSame('12000.00', Balances::departmentBalance($this->dept->id), 'the department owes me until its cheque arrives');
    }

    // ---------------------------------------------------------------- transfers

    public function test_own_transfers_move_money_inside_one_company(): void
    {
        $this->fundBank('40000');
        $t = app(TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->cash->id, 'amount' => '15000', 'date' => now()->toDateString()]);

        $this->assertFalse($t->isInterCompany());
        $this->assertSame('Cash withdrawal', $t->kind());
        $this->assertMoney('25000.00', $this->bank);
        $this->assertMoney('15000.00', $this->cash);
        $this->assertSame([], Balances::interCompany($this->company->id)->all());
    }

    public function test_inter_company_transfers_track_who_owes_whom(): void
    {
        $this->fundBank('60000');
        $other = $this->makeCompany('Zamzam Enterprises');
        $otherBank = $this->makeBank($other);
        $svc = app(TransferService::class);

        $svc->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $otherBank->id, 'amount' => '25000', 'date' => now()->toDateString()]);
        $this->assertSame('25000.00', Balances::owedBetween($this->company->id, $other->id), 'Zamzam owes Al-Noor');
        $this->assertSame('-25000.00', Balances::owedBetween($other->id, $this->company->id));
        $this->assertMoney('35000.00', $this->bank);
        $this->assertMoney('25000.00', $otherBank);

        // Zamzam sends 10,000 back into the admin's cash, for Al-Noor.
        $t = $svc->save(null, ['from_account_id' => $otherBank->id, 'to_company_id' => $this->company->id, 'to_account_id' => $this->cash->id, 'amount' => '10000', 'date' => now()->toDateString()]);
        $this->assertSame('15000.00', Balances::owedBetween($this->company->id, $other->id));
        $this->assertTrue($t->isInterCompany());
        $this->assertSame('10000.00', Balances::money($this->company->id)['cash']);

        // An ATM withdrawal stays inside one company.
        $atm = $svc->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->cash->id, 'amount' => '5000', 'date' => now()->toDateString()]);
        $this->assertFalse($atm->isInterCompany());
        $this->assertSame('Cash withdrawal', $atm->kind());
        $this->assertSame('15000.00', Balances::money($this->company->id)['cash']);
    }

    public function test_editing_a_transfer_to_overdraw_is_blocked_and_rolled_back(): void
    {
        $this->fundBank('10000');
        $t = app(TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->cash->id, 'amount' => '4000', 'date' => now()->toDateString()]);

        try {
            app(TransferService::class)->save($t, ['amount' => '12000']);
            $this->fail('Overdraft allowed.');
        } catch (BusinessRuleException) {
        }

        $this->assertMoney('6000.00', $this->bank);
        $this->assertMoney('4000.00', $this->cash);
    }

    // ---------------------------------------------------------------- expenses, deals, openings

    public function test_expenses_reduce_money_and_profit(): void
    {
        $this->fundBank('10000');
        app(PaymentService::class)->saveExpense(null, [
            'company_id' => $this->company->id, 'expense_category_id' => $this->category()->id, 'account_id' => $this->bank->id,
            'amount' => '1200', 'date' => now()->toDateString(), 'description' => 'Generator diesel',
        ]);

        $this->assertMoney('8800.00', $this->bank);
        $this->assertSame('1200.00', Balances::profit($this->company->id)['expenses']);
        $this->assertSame('-1200.00', Balances::profit($this->company->id)['net']);
    }

    public function test_closing_a_deal_turns_the_leftover_into_profit_or_loss(): void
    {
        $this->fundBank('50000');                 // cheque 50,000 for Health Dept
        $this->pay(['amount' => '45000']);        // spent 45,000 → I hold 5,000

        $closing = app(DealService::class)->close(null, ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'date' => now()->toDateString()]);
        $this->assertTrue($closing->isProfit());
        $this->assertSame('5000.00', (string) $closing->amount);
        $this->assertSame('0.00', Balances::departmentBalance($this->dept->id));
        $this->assertSame('5000.00', Balances::profit()['deals']);

        // A second department where I spent more than the cheque: loss.
        $edu = $this->makeDepartment();
        $this->cheque(['department_id' => $edu->id, 'amount' => '1000']);
        $this->pay(['department_id' => $edu->id, 'amount' => '1500']);
        $loss = app(DealService::class)->close(null, ['company_id' => $this->company->id, 'department_id' => $edu->id, 'date' => now()->toDateString()]);
        $this->assertSame('-500.00', (string) $loss->amount);
        $this->assertSame('4500.00', Balances::profit()['deals']);

        $this->expectException(BusinessRuleException::class);
        app(DealService::class)->close(null, ['company_id' => $this->company->id, 'department_id' => $edu->id, 'date' => now()->toDateString()]);
    }

    public function test_editing_a_closing_remeasures_the_balance(): void
    {
        $this->fundBank('50000');
        $this->pay(['amount' => '45000', 'date' => now()->subDays(5)->toDateString()]);
        $closing = app(DealService::class)->close(null, ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'date' => now()->toDateString()]);

        app(PaymentService::class)->savePayment(\App\Models\Payment::first(), ['amount' => '40000']);
        $this->assertSame('-5000.00', Balances::departmentBalance($this->dept->id), 'the earlier closing no longer zeroes it');

        app(DealService::class)->close($closing->fresh(), ['date' => now()->toDateString()]);
        $this->assertSame('10000.00', (string) $closing->fresh()->amount);
        $this->assertSame('0.00', Balances::departmentBalance($this->dept->id));
    }

    public function test_department_and_supplier_opening_balances(): void
    {
        $svc = app(DealService::class);
        $svc->saveOpening(null, ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'amount' => '-7000', 'date' => now()->subMonth()->toDateString()]);
        $svc->saveOpening(null, ['company_id' => $this->company->id, 'supplier_id' => $this->supplier->id, 'amount' => '3000', 'date' => now()->subMonth()->toDateString()]);

        $this->assertSame('-7000.00', Balances::departmentBalance($this->dept->id));
        $this->assertSame('3000.00', Balances::supplierOwed($this->supplier->id));

        $this->expectException(BusinessRuleException::class);
        $svc->saveOpening(null, ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'amount' => '100', 'date' => now()->toDateString()]);
    }

    public function test_balances_are_kept_per_company(): void
    {
        $other = $this->makeCompany('Zamzam Enterprises');
        $otherBank = $this->makeBank($other);

        $this->cheque(['amount' => '10000']);
        $this->cheque(['company_id' => $other->id, 'deposit_account_id' => $otherBank->id, 'amount' => '4000']);

        $this->assertSame('-10000.00', Balances::departmentBalance($this->dept->id, $this->company->id));
        $this->assertSame('-4000.00', Balances::departmentBalance($this->dept->id, $other->id));
        $this->assertSame('-14000.00', Balances::departmentBalance($this->dept->id));
        $this->assertCount(2, Balances::departments(departmentId: $this->dept->id));
        $this->assertMoney('4000.00', $otherBank);
    }

    public function test_voided_history_is_kept(): void
    {
        $cheque = $this->cheque(['amount' => '1000']);
        app(ChequeService::class)->save($cheque, ['amount' => '2000']);

        $this->assertSame(1, Transaction::where('status', TransactionStatus::Void)->count());
        $this->assertSame(1, Transaction::posted()->where('source_type', 'cheque')->count());
        $this->assertSame(0, JournalLedgerEntry::whereNull('company_id')->count());
    }
}
