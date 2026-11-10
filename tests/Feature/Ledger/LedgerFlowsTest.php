<?php

namespace Tests\Feature\Ledger;

use App\Enums\ChequeStatus;
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

    public function test_a_new_company_gets_one_cash_in_hand_with_its_opening_balance(): void
    {
        $co = $this->makeCompany('Zamzam Enterprises', '25000');

        $this->assertCount(1, $co->accounts);
        $this->assertTrue($co->cashAccount->isCash());
        $this->assertMoney('25000.00', $co->cashAccount);

        $this->expectException(BusinessRuleException::class);
        app(MasterDataService::class)->saveAccount(null, ['company_id' => $co->id, 'type' => 'cash', 'name' => 'Second cash']);
    }

    public function test_changing_an_opening_balance_reposts_it(): void
    {
        $bank = $this->makeBank($this->company, 'MCB Current', '5000');
        app(MasterDataService::class)->saveAccount($bank, ['opening_balance' => '7500']);

        $this->assertMoney('7500.00', $bank);
        $this->assertSame(1, Transaction::posted()->where('source_type', 'account')->where('source_id', $bank->id)->count());
    }

    // ---------------------------------------------------------------- cheques

    public function test_receiving_a_cheque_credits_the_department_immediately(): void
    {
        $this->receiveCheque(['amount' => '50000']);

        $this->assertSame('-50000.00', Balances::departmentBalance($this->dept->id, $this->company->id));
        $this->assertSame(['count' => 1, 'amount' => '50000.00'], Balances::chequesInHand($this->company->id));
        $this->assertMoney('0.00', $this->bank);
    }

    public function test_depositing_puts_the_net_amount_in_the_bank_and_books_charges(): void
    {
        $cheque = $this->deposit($this->receiveCheque(['amount' => '50000']), ['bank_charges' => '150']);

        $this->assertSame(ChequeStatus::Deposited, $cheque->status);
        $this->assertMoney('49850.00', $this->bank);
        $this->assertSame(['count' => 0, 'amount' => '0.00'], Balances::chequesInHand());
        $this->assertSame('150.00', Balances::profit($this->company->id)['charges']);
        $this->assertSame('-50000.00', Balances::departmentBalance($this->dept->id), 'department sees the full cheque');
    }

    public function test_a_cheque_can_only_go_into_the_same_companys_bank(): void
    {
        $other = $this->makeCompany('Zamzam Enterprises');
        $otherBank = $this->makeBank($other);
        $cheque = $this->receiveCheque();

        try {
            $this->deposit($cheque, ['deposit_account_id' => $otherBank->id]);
            $this->fail('Deposit into another company was allowed.');
        } catch (BusinessRuleException $e) {
            $this->assertSame('deposit_account_id', $e->field);
        }

        $this->expectException(BusinessRuleException::class);
        $this->deposit($cheque->fresh(), ['deposit_account_id' => $this->cash->id]);
    }

    public function test_editing_undoing_and_deleting_cheques_rebuild_the_ledger(): void
    {
        $svc = app(ChequeService::class);
        $cheque = $this->fundBank('80000');

        $svc->save($cheque, ['amount' => '90000']);
        $this->assertMoney('90000.00', $this->bank);
        $this->assertSame('-90000.00', Balances::departmentBalance($this->dept->id));

        $svc->undoDeposit($cheque->fresh());
        $this->assertMoney('0.00', $this->bank);
        $this->assertSame(1, Balances::chequesInHand()['count']);

        $svc->delete($cheque->fresh());
        $this->assertSame('0.00', Balances::departmentBalance($this->dept->id));
        $this->assertSame(0, Balances::chequesInHand()['count']);
        $this->assertSoftDeleted($cheque);
    }

    public function test_undoing_a_deposit_is_blocked_when_the_money_was_already_spent(): void
    {
        $cheque = $this->fundBank('50000');
        $this->pay(['amount' => '40000']);

        $this->expectException(BusinessRuleException::class);
        app(ChequeService::class)->undoDeposit($cheque->fresh());
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

        // Zamzam sends 10,000 back into Al-Noor's cash.
        $svc->save(null, ['from_account_id' => $otherBank->id, 'to_account_id' => $this->cash->id, 'amount' => '10000', 'date' => now()->toDateString()]);
        $this->assertSame('15000.00', Balances::owedBetween($this->company->id, $other->id));
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
        $this->receiveCheque(['department_id' => $edu->id, 'amount' => '1000']);
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

        $this->receiveCheque(['amount' => '10000']);
        $this->receiveCheque(['company_id' => $other->id, 'amount' => '4000']);

        $this->assertSame('-10000.00', Balances::departmentBalance($this->dept->id, $this->company->id));
        $this->assertSame('-4000.00', Balances::departmentBalance($this->dept->id, $other->id));
        $this->assertSame('-14000.00', Balances::departmentBalance($this->dept->id));
        $this->assertCount(2, Balances::departments(departmentId: $this->dept->id));
        $this->assertSame(0, Money::cmp($otherBank->fresh()->current_balance, 0));
    }

    public function test_voided_history_is_kept(): void
    {
        $cheque = $this->receiveCheque(['amount' => '1000']);
        app(ChequeService::class)->save($cheque, ['amount' => '2000']);

        $this->assertSame(1, Transaction::where('status', TransactionStatus::Void)->count());
        $this->assertSame(1, Transaction::posted()->where('source_type', 'cheque')->count());
        $this->assertSame(0, JournalLedgerEntry::whereNull('company_id')->count());
    }
}
