<?php

namespace Tests\Feature\Ledger;

use App\Enums\ChequeStatus;
use App\Enums\ClearingMethod;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\JournalLedgerEntry;
use App\Models\Transaction;
use App\Services\AdjustmentService;
use App\Services\ChequeService;
use App\Services\DisbursementService;
use App\Services\LedgerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

class ChequeLifecycleTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    public function test_registering_a_cheque_does_not_touch_company_or_account_balances(): void
    {
        $cheque = $this->registerCheque();

        $this->assertSame(ChequeStatus::Received, $cheque->status);
        $this->assertSame(now()->subDays(2)->addMonthsNoOverflow(6)->toDateString(), $cheque->expiry_date->toDateString());
        $this->assertBalances(payable: '0.00', bank: '0.00');
        $this->assertSame('100000.00', $this->company->pendingChequesTotal());
        $this->assertDatabaseHas('transactions', ['type' => TransactionType::ChequeIn->value, 'source_id' => $cheque->id]);
    }

    public function test_deposit_with_commission_and_bank_charges(): void
    {
        $cheque = $this->clearedCheque('100000', [
            'commission_type' => 'percent', 'commission_rate' => '2.5', 'bank_charges' => '150',
        ]);

        $this->assertSame(ChequeStatus::Cleared, $cheque->status);
        $this->assertSame('2500.00', (string) $cheque->commission_amount);
        // Company is owed amount minus commission; bank receives amount minus charges.
        $this->assertBalances(payable: '97500.00', bank: '99850.00', vault: '0.00');
        $this->assertSame('0.00', $this->company->pendingChequesTotal());
    }

    public function test_encashment_always_goes_to_the_cash_vault(): void
    {
        $this->clearedCheque('50000', [
            'clearing_method' => ClearingMethod::Encashment->value,
            'cleared_into_account_id' => $this->bank->id, // ignored
            'commission_type' => 'fixed', 'commission_rate' => '1000',
        ]);

        $this->assertBalances(payable: '49000.00', bank: '0.00', vault: '50000.00');
    }

    public function test_every_posted_transaction_is_balanced(): void
    {
        $this->clearedCheque('123456.78', ['commission_type' => 'percent', 'commission_rate' => '3.33', 'bank_charges' => '99.99']);

        Transaction::with('entries')->get()->each(function (Transaction $t) {
            $this->assertSame(
                number_format((float) $t->entries->sum('debit'), 2, '.', ''),
                number_format((float) $t->entries->sum('credit'), 2, '.', ''),
                "Transaction {$t->id} ({$t->type->value}) is unbalanced"
            );
        });
    }

    public function test_bounce_before_payout_reverses_everything(): void
    {
        $cheque = $this->clearedCheque('100000', ['commission_type' => 'fixed', 'commission_rate' => '500', 'bank_charges' => '100']);

        app(ChequeService::class)->performBounce($cheque, ['closed_reason' => 'Insufficient funds']);

        $this->assertSame(ChequeStatus::Bounced, $cheque->fresh()->status);
        $this->assertBalances(payable: '0.00', bank: '0.00');
    }

    public function test_bounce_blocked_when_paid_out_then_allowed_after_adjustment(): void
    {
        $cheque = $this->clearedCheque('100000');
        $account = $this->companyAccount();

        app(DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'bank_transfer', 'source_account_id' => $this->bank->id,
            'lines' => [['company_bank_account_id' => $account->id, 'amount' => '60000']],
        ], $this->admin);

        $this->assertBalances(payable: '40000.00', bank: '40000.00');

        try {
            app(ChequeService::class)->performBounce($cheque, ['closed_reason' => 'Returned']);
            $this->fail('Bounce should be blocked');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('manual adjustment', $e->getMessage());
        }
        $this->assertSame(ChequeStatus::Cleared, $cheque->fresh()->status);
        $this->assertBalances(payable: '40000.00', bank: '40000.00');

        // Record that the 60,000 already paid out is now owed back by the company.
        app(AdjustmentService::class)->create([
            'company_id' => $this->company->id, 'kind' => 'overpaid_to_receivable', 'amount' => '60000', 'reason' => 'Bounced cheque recovery',
        ], $this->admin);
        $this->assertBalances(payable: '100000.00', receivable: '60000.00');

        // Fund the bank so it can absorb the reversal (it holds 40k, the bank will debit 100k).
        app(\App\Services\MasterDataService::class)->saveBankAccount($this->bank, [
            'name' => 'HBL Main', 'type' => 'bank', 'opening_balance' => '60000', 'is_active' => true,
        ]);

        app(ChequeService::class)->performBounce($cheque, ['closed_reason' => 'Returned']);
        $this->assertBalances(payable: '0.00', receivable: '60000.00', bank: '0.00');
    }

    public function test_cancel_only_from_pending(): void
    {
        $cheque = $this->registerCheque();
        app(ChequeService::class)->performCancel($cheque, ['closed_reason' => 'Wrong company']);
        $this->assertSame(ChequeStatus::Cancelled, $cheque->fresh()->status);

        $this->expectException(BusinessRuleException::class);
        app(ChequeService::class)->performCancel($cheque->fresh(), []);
    }

    public function test_editing_a_cleared_cheque_reposts_the_ledger(): void
    {
        $cheque = $this->clearedCheque('100000');
        $this->assertBalances(payable: '100000.00', bank: '100000.00');

        app(ChequeService::class)->performUpdate($cheque, ['amount' => '120000', 'commission_type' => 'fixed', 'commission_rate' => '2000']);

        $this->assertBalances(payable: '118000.00', bank: '120000.00');
        $this->assertGreaterThan(0, Transaction::where('status', TransactionStatus::Void)->count());
    }

    public function test_deleting_a_cleared_cheque_is_blocked_once_money_was_paid_out(): void
    {
        $cheque = $this->clearedCheque('10000');
        app(DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'bank_transfer', 'source_account_id' => $this->bank->id,
            'lines' => [['company_bank_account_id' => $this->companyAccount()->id, 'amount' => '5000']],
        ], $this->admin);

        $this->expectException(BusinessRuleException::class);
        app(ChequeService::class)->performDelete($cheque);
    }

    public function test_recalculate_rebuilds_cached_balances_from_the_journal(): void
    {
        $this->clearedCheque('75000', ['bank_charges' => '25']);
        \DB::table('companies')->update(['payable_balance' => 0]);
        \DB::table('bank_accounts')->update(['current_balance' => 0]);

        app(LedgerService::class)->recalculateAll();

        $this->assertBalances(payable: '75000.00', bank: '74975.00');
        $this->assertSame(0, JournalLedgerEntry::where('debit', '<', 0)->count());
    }
}
