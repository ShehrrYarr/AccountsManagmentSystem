<?php

namespace Tests\Feature\Ledger;

use App\Enums\ApprovalAction;
use App\Enums\ApprovalStatus;
use App\Enums\ChequeStatus;
use App\Enums\RecordStatus;
use App\Exceptions\BusinessRuleException;
use App\Models\ApprovalRequest;
use App\Models\AuditLog;
use App\Services\AdjustmentService;
use App\Services\ApprovalService;
use App\Services\ChequeService;
use App\Services\DisbursementService;
use App\Services\InternalTransferService;
use App\Services\MasterDataService;
use App\Services\Outcome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

class DisbursementAndApprovalTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    private function disburse(array $data, $by = null): array
    {
        return app(DisbursementService::class)->create(array_merge(['company_id' => $this->company->id], $data), $by ?? $this->admin);
    }

    public function test_cash_payout_reduces_vault_and_payable(): void
    {
        $this->clearedCheque('50000', ['clearing_method' => 'encashment']);

        [$d, $outcome] = $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '20000', 'received_by' => 'Ali']);

        $this->assertSame(Outcome::Done, $outcome);
        $this->assertSame(RecordStatus::Posted, $d->status);
        $this->assertBalances(payable: '30000.00', vault: '30000.00');
    }

    public function test_payout_cannot_exceed_company_payable(): void
    {
        $this->clearedCheque('10000', ['clearing_method' => 'encashment']);
        // Vault has money from another company's cheque:
        $other = $this->makeCompany();
        $this->clearedCheque('90000', ['clearing_method' => 'encashment']); // same company, adds payable
        app(ChequeService::class)->performClear(
            $this->registerCheque(['company_id' => $other->id, 'amount' => '50000']),
            $this->clearData(['clearing_method' => 'encashment']), $this->admin
        );

        try {
            $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '100000.01']);
            $this->fail('Expected block');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('exceeds what you owe Acme Traders', $e->getMessage());
        }

        $this->assertBalances(payable: '100000.00', vault: '150000.00');
    }

    public function test_payout_cannot_overdraw_the_source_account(): void
    {
        $this->clearedCheque('10000'); // into bank, vault stays empty

        $this->expectException(BusinessRuleException::class);
        $this->expectExceptionMessage('Insufficient funds in Cash Vault');
        $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '5000']);
    }

    public function test_split_bank_transfer_across_company_accounts(): void
    {
        $this->clearedCheque('100000');
        $a = $this->companyAccount(number: '111');
        $b = $this->companyAccount(number: '222');

        [$d] = $this->disburse(['type' => 'bank_transfer', 'source_account_id' => $this->bank->id, 'lines' => [
            ['company_bank_account_id' => $a->id, 'amount' => '30000', 'reference' => 'IBFT-1'],
            ['company_bank_account_id' => $b->id, 'amount' => '45000.50'],
        ]]);

        $this->assertSame('75000.50', (string) $d->amount);
        $this->assertCount(2, $d->lines);
        $this->assertBalances(payable: '24999.50', bank: '24999.50');
    }

    public function test_transfer_lines_must_belong_to_the_company(): void
    {
        $this->clearedCheque('100000');
        $foreign = $this->companyAccount($this->makeCompany(), '999');

        $this->expectException(BusinessRuleException::class);
        $this->disburse(['type' => 'bank_transfer', 'source_account_id' => $this->bank->id, 'lines' => [
            ['company_bank_account_id' => $foreign->id, 'amount' => '100'],
        ]]);
    }

    public function test_vendor_purchase_requires_vendor_and_any_account(): void
    {
        $this->clearedCheque('20000');

        [$d] = $this->disburse(['type' => 'vendor_purchase', 'source_account_id' => $this->bank->id, 'vendor_id' => $this->vendor()->id,
            'amount' => '7500', 'item_description' => 'Printer toner x5']);

        $this->assertSame('Printer toner x5', $d->item_description);
        $this->assertBalances(payable: '12500.00', bank: '12500.00');
    }

    public function test_staff_disbursement_waits_for_approval_then_posts(): void
    {
        $this->clearedCheque('50000', ['clearing_method' => 'encashment']);
        $this->actingAs($this->staff);

        [$d, $outcome] = $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '10000'], $this->staff);

        $this->assertSame(Outcome::PendingApproval, $outcome);
        $this->assertSame(RecordStatus::PendingApproval, $d->status);
        $this->assertBalances(payable: '50000.00', vault: '50000.00');

        $request = ApprovalRequest::sole();
        $this->assertSame(ApprovalAction::PostDisbursement, $request->action);

        $this->actingAs($this->admin);
        app(ApprovalService::class)->approve($request, $this->admin);

        $this->assertSame(RecordStatus::Posted, $d->fresh()->status);
        $this->assertSame(ApprovalStatus::Approved, $request->fresh()->status);
        $this->assertBalances(payable: '40000.00', vault: '40000.00');
    }

    public function test_approval_rechecks_balances_at_approval_time(): void
    {
        $this->clearedCheque('10000', ['clearing_method' => 'encashment']);
        $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '8000'], $this->staff);
        $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '8000'], $this->staff);

        [$first, $second] = ApprovalRequest::orderBy('id')->get();
        app(ApprovalService::class)->approve($first, $this->admin);

        $this->expectException(BusinessRuleException::class);
        try {
            app(ApprovalService::class)->approve($second, $this->admin);
        } finally {
            $this->assertSame(ApprovalStatus::Pending, $second->fresh()->status);
            $this->assertBalances(payable: '2000.00', vault: '2000.00');
        }
    }

    public function test_rejecting_a_staff_disbursement(): void
    {
        $this->clearedCheque('10000', ['clearing_method' => 'encashment']);
        [$d] = $this->disburse(['type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '1000'], $this->staff);

        app(ApprovalService::class)->reject(ApprovalRequest::sole(), $this->admin, 'Not authorised');

        $this->assertSame(RecordStatus::Rejected, $d->fresh()->status);
        $this->assertBalances(payable: '10000.00', vault: '10000.00');
    }

    public function test_staff_cheque_clearing_needs_approval(): void
    {
        $cheque = $this->registerCheque([], $this->staff);
        $outcome = app(ChequeService::class)->clear($cheque, $this->clearData(), $this->staff);

        $this->assertSame(Outcome::PendingApproval, $outcome);
        $this->assertSame(ChequeStatus::Received, $cheque->fresh()->status);

        app(ApprovalService::class)->approve(ApprovalRequest::sole(), $this->admin);
        $this->assertSame(ChequeStatus::Cleared, $cheque->fresh()->status);
        $this->assertBalances(payable: '100000.00', bank: '100000.00');
    }

    public function test_only_one_pending_request_per_record(): void
    {
        $cheque = $this->registerCheque([], $this->staff);
        app(ChequeService::class)->clear($cheque, $this->clearData(), $this->staff);

        $this->expectException(BusinessRuleException::class);
        app(ChequeService::class)->update($cheque, ['amount' => '5'], $this->staff);
    }

    public function test_staff_edit_and_delete_go_through_approval(): void
    {
        $this->clearedCheque('50000');
        [$d] = $this->disburse(['type' => 'bank_transfer', 'source_account_id' => $this->bank->id, 'lines' => [
            ['company_bank_account_id' => $this->companyAccount()->id, 'amount' => '10000'],
        ]]);

        $payload = ['company_id' => $this->company->id, 'type' => 'bank_transfer', 'source_account_id' => $this->bank->id,
            'date' => now()->toDateString(), 'lines' => [['company_bank_account_id' => $d->lines->first()->company_bank_account_id, 'amount' => '15000']]];

        $this->assertSame(Outcome::PendingApproval, app(DisbursementService::class)->update($d, $payload, $this->staff));
        $this->assertBalances(payable: '40000.00');

        app(ApprovalService::class)->approve(ApprovalRequest::sole(), $this->admin);
        $this->assertBalances(payable: '35000.00', bank: '35000.00');

        $this->assertSame(Outcome::PendingApproval, app(DisbursementService::class)->delete($d->fresh(), $this->staff));
        app(ApprovalService::class)->approve(ApprovalRequest::pending()->sole(), $this->admin);
        $this->assertSoftDeleted($d);
        $this->assertBalances(payable: '50000.00', bank: '50000.00');
    }

    public function test_internal_transfer_moves_money_between_my_accounts(): void
    {
        $this->clearedCheque('30000');
        app(InternalTransferService::class)->create([
            'from_account_id' => $this->bank->id, 'to_account_id' => $this->vault->id, 'amount' => '12000',
        ], $this->staff);

        $this->assertBalances(payable: '30000.00', bank: '18000.00', vault: '12000.00');

        $this->expectException(BusinessRuleException::class);
        app(InternalTransferService::class)->create([
            'from_account_id' => $this->vault->id, 'to_account_id' => $this->bank->id, 'amount' => '12000.01',
        ], $this->admin);
    }

    public function test_receivable_settlement_into_an_account(): void
    {
        app(AdjustmentService::class)->create(['company_id' => $this->company->id, 'kind' => 'receivable_charge', 'amount' => '5000', 'reason' => 'Advance'], $this->admin);
        app(AdjustmentService::class)->create(['company_id' => $this->company->id, 'kind' => 'receivable_settlement', 'amount' => '2000',
            'bank_account_id' => $this->vault->id, 'reason' => 'Repaid in cash'], $this->admin);

        $this->assertBalances(receivable: '3000.00', vault: '2000.00');
    }

    public function test_adjustments_are_admin_only(): void
    {
        $this->expectException(BusinessRuleException::class);
        app(AdjustmentService::class)->create(['company_id' => $this->company->id, 'kind' => 'payable_credit', 'amount' => '1', 'reason' => 'x'], $this->staff);
    }

    public function test_opening_balances_are_journalled_and_editable(): void
    {
        $company = $this->makeCompany('Gamma', ['opening_payable' => '25000', 'opening_receivable' => '1000']);
        $this->assertBalances(payable: '25000.00', receivable: '1000.00', company: $company);

        app(MasterDataService::class)->saveCompany($company, ['name' => 'Gamma', 'opening_payable' => '30000', 'opening_receivable' => '0']);
        $this->assertBalances(payable: '30000.00', receivable: '0.00', company: $company);
    }

    public function test_only_one_cash_vault(): void
    {
        $this->expectException(BusinessRuleException::class);
        app(MasterDataService::class)->saveBankAccount(null, ['name' => 'Second vault', 'type' => 'cash']);
    }

    public function test_changes_are_audited_with_before_and_after_values(): void
    {
        $cheque = $this->registerCheque(['amount' => '1000']);
        app(ChequeService::class)->performUpdate($cheque, ['amount' => '2000']);

        $log = AuditLog::where('auditable_type', 'cheque')->where('event', 'updated')->latest('id')->first();
        $this->assertSame('1000.00', $log->old_values['amount']);
        $this->assertSame('2000.00', $log->new_values['amount']);
        $this->assertSame($this->admin->id, $log->user_id);
    }
}
