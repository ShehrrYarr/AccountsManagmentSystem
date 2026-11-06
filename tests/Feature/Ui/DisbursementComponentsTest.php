<?php

namespace Tests\Feature\Ui;

use App\Enums\RecordStatus;
use App\Models\CompanyBankAccount;
use App\Models\Disbursement;
use App\Models\InternalTransfer;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

class DisbursementComponentsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    public function test_cash_payout_defaults_to_vault_and_shows_live_balances(): void
    {
        $this->clearedCheque('40000', ['clearing_method' => 'encashment']);

        $c = Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id, type: 'cash_payout')
            ->assertSet('source_account_id', $this->vault->id)
            ->set('amount', '15000')
            ->set('received_by', 'Imran (CNIC 35202-xxxx)');

        $check = $c->get('check');
        $this->assertSame('40000.00', $check['payable']);
        $this->assertSame('25000.00', $check['payableAfter']);
        $this->assertFalse($check['overPayable']);

        $c->call('save')->assertHasNoErrors()->assertDispatched('transaction-updated');
        $this->assertBalances(payable: '25000.00', vault: '25000.00');
        $this->assertSame('Imran (CNIC 35202-xxxx)', Disbursement::sole()->received_by);
    }

    public function test_over_payable_amount_is_flagged_and_rejected(): void
    {
        $this->clearedCheque('1000', ['clearing_method' => 'encashment']);

        $c = Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id, type: 'cash_payout')
            ->set('amount', '1500');

        $this->assertTrue($c->get('check')['overPayable']);
        $c->assertSee('Advances are not allowed');

        $c->call('save')->assertHasErrors(['amount']);
        $this->assertSame(0, Disbursement::count());
    }

    public function test_split_bank_transfer_with_inline_company_account(): void
    {
        $this->clearedCheque('100000');
        $existing = $this->companyAccount(number: '1111');

        $c = Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id, type: 'bank_transfer')
            ->assertSet('source_account_id', $this->bank->id) // only one bank account → preselected
            ->set('lines.0.company_bank_account_id', $existing->id)
            ->set('lines.0.amount', '60000')
            ->call('addLine')
            ->set('addingAccount', true)
            ->set('newAccount.bank_name', 'Meezan')
            ->set('newAccount.account_title', 'Acme Traders')
            ->set('newAccount.account_number', '2222')
            ->call('addCompanyAccount')
            ->assertHasNoErrors();

        $new = CompanyBankAccount::where('account_number', '2222')->sole();
        $c->assertSet('lines.1.company_bank_account_id', $new->id)
            ->call('fillRemaining', 1)
            ->assertSet('lines.1.amount', '40000.00');

        $this->assertSame('100000.00', $c->get('total'));

        $c->call('save')->assertHasNoErrors();

        $d = Disbursement::with('lines')->sole();
        $this->assertCount(2, $d->lines);
        $this->assertBalances(payable: '0.00', bank: '0.00');
    }

    public function test_transfer_lines_cannot_repeat_an_account(): void
    {
        $this->clearedCheque('1000');
        $a = $this->companyAccount();

        Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id, type: 'bank_transfer')
            ->set('lines.0.company_bank_account_id', $a->id)->set('lines.0.amount', '100')
            ->call('addLine')
            ->set('lines.1.company_bank_account_id', $a->id)->set('lines.1.amount', '100')
            ->call('save')
            ->assertHasErrors(['lines.0.company_bank_account_id' => 'distinct']);
    }

    public function test_vendor_purchase_with_new_vendor_and_receipt(): void
    {
        Storage::fake('local');
        $this->clearedCheque('8000');

        Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id)
            ->call('setType', 'vendor_purchase')
            ->set('source_account_id', $this->bank->id)
            ->set('addingVendor', true)->set('newVendor', 'Paper House')->call('addVendor')
            ->assertSet('vendor_id', Vendor::where('name', 'Paper House')->value('id'))
            ->set('amount', '3500')
            ->call('save')->assertHasErrors(['item_description'])
            ->set('item_description', '20 reams A4 paper')
            ->set('receipt', UploadedFile::fake()->create('receipt.pdf', 50, 'application/pdf'))
            ->call('save')->assertHasNoErrors();

        $d = Disbursement::sole();
        Storage::disk('local')->assertExists($d->receipt_path);
        $this->assertBalances(payable: '4500.00', bank: '4500.00');
    }

    public function test_switching_type_resets_source_account(): void
    {
        Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id, type: 'bank_transfer')
            ->assertSet('source_account_id', $this->bank->id)
            ->call('setType', 'cash_payout')
            ->assertSet('source_account_id', $this->vault->id);
    }

    public function test_staff_payout_awaits_approval_and_shows_in_list(): void
    {
        $this->clearedCheque('5000', ['clearing_method' => 'encashment']);
        $this->actingAs($this->staff);

        Volt::test('disbursements.create')
            ->dispatch('disbursement-create', companyId: $this->company->id, type: 'cash_payout')
            ->set('amount', '2000')
            ->call('save')->assertHasNoErrors()->assertDispatched('toast', type: 'info');

        $this->assertSame(RecordStatus::PendingApproval, Disbursement::sole()->status);
        $this->assertBalances(vault: '5000.00');

        Volt::test('disbursements.list')->assertSee('Awaiting Approval');

        // Approve through the queue as admin
        $this->actingAs($this->admin);
        Volt::test('approvals.queue')
            ->assertSee('Post Disbursement')
            ->call('approve', \App\Models\ApprovalRequest::sole()->id)
            ->assertHasNoErrors()->assertDispatched('transaction-updated');

        $this->assertBalances(payable: '3000.00', vault: '3000.00');
    }

    public function test_edit_posted_disbursement_as_admin(): void
    {
        $this->clearedCheque('5000', ['clearing_method' => 'encashment']);
        [$d] = app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '1000',
        ], $this->admin);

        $c = Volt::test('disbursements.create')->dispatch('disbursement-edit', id: $d->id)
            ->assertSet('amount', '1000.00');

        // The live check adds back the already-posted amount.
        $this->assertSame('5000.00', $c->get('check')['payable']);

        $c->set('amount', '4500')->call('save')->assertHasNoErrors();
        $this->assertBalances(payable: '500.00', vault: '500.00');
    }

    public function test_disbursement_list_filters_and_delete(): void
    {
        $this->clearedCheque('9000');
        [$d] = app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'vendor_purchase', 'source_account_id' => $this->bank->id,
            'vendor_id' => $this->vendor('Hardware Hub')->id, 'amount' => '1200', 'item_description' => 'Locks',
        ], $this->admin);

        Volt::test('disbursements.list')
            ->assertSee('Hardware Hub')
            ->set('type', 'cash_payout')->assertDontSee('Hardware Hub')
            ->set('type', '')->set('search', 'Hardware')->assertSee('Hardware Hub')
            ->call('delete', $d->id)->assertDispatched('transaction-updated');

        $this->assertSoftDeleted($d);
        $this->assertBalances(payable: '9000.00', bank: '9000.00');
    }

    public function test_internal_transfer_component(): void
    {
        $this->clearedCheque('20000');

        Volt::test('transfers.manage')
            ->call('create')->assertDispatched('modal-show', id: 'transferModal')
            ->set('from_account_id', $this->bank->id)
            ->set('to_account_id', $this->bank->id)
            ->set('amount', '5000')
            ->call('save')->assertHasErrors(['to_account_id'])
            ->set('to_account_id', $this->vault->id)
            ->call('save')->assertHasNoErrors();

        $this->assertBalances(bank: '15000.00', vault: '5000.00');

        Volt::test('transfers.manage')
            ->call('create')
            ->set('from_account_id', $this->vault->id)->set('to_account_id', $this->bank->id)->set('amount', '9999')
            ->call('save')->assertHasErrors(['amount']);

        $t = InternalTransfer::sole();
        Volt::test('transfers.manage')->call('delete', $t->id);
        $this->assertBalances(bank: '20000.00', vault: '0.00');
    }
}
