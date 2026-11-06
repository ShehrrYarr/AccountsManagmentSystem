<?php

namespace Tests\Feature\Ui;

use App\Enums\ApprovalStatus;
use App\Enums\UserRole;
use App\Models\ApprovalRequest;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\GovernmentDepartment;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

class AdminComponentsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    public function test_login_component(): void
    {
        auth()->logout();

        Volt::test('auth.login')
            ->set('email', $this->staff->email)->set('password', 'wrong')
            ->call('login')->assertHasErrors(['email']);

        Volt::test('auth.login')
            ->set('email', $this->staff->email)->set('password', 'password')
            ->call('login')->assertHasNoErrors()->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($this->staff);
        $this->assertNotNull($this->staff->fresh()->last_login_at);
    }

    public function test_inactive_user_cannot_log_in(): void
    {
        auth()->logout();
        $this->staff->update(['is_active' => false]);

        Volt::test('auth.login')
            ->set('email', $this->staff->email)->set('password', 'password')
            ->call('login')->assertHasErrors(['email']);

        $this->assertGuest();
    }

    public function test_company_crud_and_opening_balances_admin_only(): void
    {
        Volt::test('companies.list')
            ->call('create')
            ->set('name', 'Delta Corp')->set('opening_payable', '12000')
            ->call('save')->assertHasNoErrors()->assertDispatched('transaction-updated');

        $delta = Company::where('name', 'Delta Corp')->sole();
        $this->assertSame('12000.00', (string) $delta->payable_balance);

        // Staff edits keep the existing opening balance even if they try to change it.
        $this->actingAs($this->staff);
        Volt::test('companies.list')
            ->call('edit', $delta->id)
            ->set('opening_payable', '999999')->set('phone', '0300-1234567')
            ->call('save')->assertHasNoErrors();

        $this->assertSame('12000.00', (string) $delta->fresh()->payable_balance);
        $this->assertSame('0300-1234567', $delta->fresh()->phone);

        Volt::test('companies.list')->set('name', 'Acme Traders')->call('save')->assertHasErrors(['name' => 'unique']);
    }

    public function test_company_list_filters(): void
    {
        $this->clearedCheque('500');
        $this->makeCompany('Idle Co');

        Volt::test('companies.list')
            ->set('filter', 'owed')->assertSee('Acme Traders')->assertDontSee('Idle Co')
            ->set('filter', 'all')->assertSee('Idle Co')
            ->set('search', 'idle')->assertSee('Idle Co')->assertDontSee('Acme Traders');
    }

    public function test_delete_company_blocked_when_it_has_history(): void
    {
        $this->registerCheque();

        Volt::test('companies.list')->call('delete', $this->company->id)->assertHasErrors(['general']);
        $this->assertNotSoftDeleted($this->company);

        $empty = $this->makeCompany('Empty Co');
        Volt::test('companies.list')->call('delete', $empty->id)->assertHasNoErrors();
        $this->assertSoftDeleted($empty);
    }

    public function test_company_bank_accounts_component(): void
    {
        Volt::test('companies.bank-accounts')
            ->dispatch('company-accounts', companyId: $this->company->id)
            ->call('add')->assertSet('account_title', 'Acme Traders')
            ->set('bank_name', 'Allied Bank')->set('account_number', '0101')->set('is_default', true)
            ->call('save')->assertHasNoErrors()
            ->assertSee('Allied Bank')
            ->call('add')->set('bank_name', 'UBL')->set('account_number', '0101')
            ->call('save')->assertHasErrors(['account_number' => 'unique']);
    }

    public function test_bank_account_manage_is_admin_only_and_single_vault(): void
    {
        Volt::test('bank-accounts.manage')
            ->call('create', 'bank')
            ->set('name', 'Meezan Ops')->set('bank_name', 'Meezan')->set('opening_balance', '250000')
            ->call('save')->assertHasNoErrors();

        $this->assertSame('250000.00', (string) BankAccount::where('name', 'Meezan Ops')->value('current_balance'));

        Volt::test('bank-accounts.manage')
            ->call('create', 'cash')->set('name', 'Second Vault')
            ->call('save')->assertHasErrors(['type']);

        $this->actingAs($this->staff);
        Volt::test('bank-accounts.manage')->call('create', 'bank')->assertForbidden();
    }

    public function test_vendor_and_department_simple_crud(): void
    {
        Volt::test('master.simple-crud', ['entity' => 'vendors'])
            ->call('create')->set('form.name', 'Office World')->set('form.phone', '042-111')
            ->call('save')->assertHasNoErrors();
        $this->assertDatabaseHas('vendors', ['name' => 'Office World', 'phone' => '042-111']);

        Volt::test('master.simple-crud', ['entity' => 'departments'])
            ->call('create')->set('form.name', 'AGPR Islamabad')->set('form.city', 'Islamabad')
            ->call('save')->assertHasNoErrors()
            ->assertSee('AGPR Islamabad');

        // In-use records are deactivated instead of deleted.
        $dept = GovernmentDepartment::sole();
        $this->registerCheque(['government_department_id' => $dept->id]);
        Volt::test('master.simple-crud', ['entity' => 'departments'])->call('delete', $dept->id);
        $this->assertFalse($dept->fresh()->is_active);

        $vendor = Vendor::sole();
        Volt::test('master.simple-crud', ['entity' => 'vendors'])->call('delete', $vendor->id);
        $this->assertModelMissing($vendor);
    }

    public function test_adjustments_component(): void
    {
        Volt::test('adjustments.manage')
            ->call('create')
            ->set('company_id', $this->company->id)
            ->set('kind', 'receivable_charge')->set('amount', '7000')->set('reason', 'Advance against contract')
            ->call('save')->assertHasNoErrors();

        $this->assertBalances(receivable: '7000.00');

        Volt::test('adjustments.manage')
            ->call('create')
            ->set('company_id', $this->company->id)->set('kind', 'receivable_settlement')
            ->set('bank_account_id', $this->vault->id)->set('amount', '8000')->set('reason', 'Repaid')
            ->call('save')->assertHasErrors(['amount']);

        $this->assertBalances(receivable: '7000.00', vault: '0.00');
    }

    public function test_approval_queue_reject_with_note(): void
    {
        $cheque = $this->registerCheque();
        app(\App\Services\ChequeService::class)->delete($cheque, $this->staff);

        Volt::test('approvals.queue')
            ->assertSee('Delete Record')
            ->set('notes.'.ApprovalRequest::sole()->id, 'Keep it')
            ->call('reject', ApprovalRequest::sole()->id)
            ->assertDispatched('approvals-updated');

        $this->assertSame(ApprovalStatus::Rejected, ApprovalRequest::sole()->status);
        $this->assertSame('Keep it', ApprovalRequest::sole()->review_notes);
        $this->assertNotSoftDeleted($cheque);
    }

    public function test_approval_failure_keeps_request_pending(): void
    {
        $this->clearedCheque('1000', ['clearing_method' => 'encashment']);
        app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '1000',
        ], $this->staff);
        // Admin pays the company in the meantime, using up the balance.
        app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'cash_payout', 'source_account_id' => $this->vault->id, 'amount' => '1000',
        ], $this->admin);

        Volt::test('approvals.queue')
            ->call('approve', ApprovalRequest::sole()->id)
            ->assertHasErrors()->assertDispatched('toast', type: 'error');

        $this->assertSame(ApprovalStatus::Pending, ApprovalRequest::sole()->status);
    }

    public function test_user_management(): void
    {
        Volt::test('users.manage')
            ->call('create')
            ->set('name', 'New Cashier')->set('email', 'cashier@example.test')->set('role', 'staff')
            ->set('password', 'Secret#2026')->set('password_confirmation', 'Secret#2026')
            ->call('save')->assertHasNoErrors();

        $u = User::where('email', 'cashier@example.test')->sole();
        $this->assertSame(UserRole::Staff, $u->role);
        $this->assertTrue(Hash::check('Secret#2026', $u->password));

        // Cannot demote yourself
        Volt::test('users.manage')->call('edit', $this->admin->id)->set('role', 'staff')
            ->call('save')->assertHasErrors(['role']);

        Volt::test('users.manage')->call('toggleActive', $u->id);
        $this->assertFalse($u->fresh()->is_active);

        $this->actingAs($this->staff);
        Volt::test('users.manage')->assertForbidden();
    }

    public function test_profile_password_change(): void
    {
        Volt::test('users.profile')
            ->set('current_password', 'wrong')->set('password', 'NewPass#123')->set('password_confirmation', 'NewPass#123')
            ->call('changePassword')->assertHasErrors(['current_password'])
            ->set('current_password', 'password')
            ->call('changePassword')->assertHasNoErrors();

        $this->assertTrue(Hash::check('NewPass#123', $this->admin->fresh()->password));
    }

    public function test_audit_log_lists_changes(): void
    {
        $this->registerCheque(['cheque_number' => 'AUD-1']);

        Volt::test('audit.log')
            ->assertSee('Cheque')
            ->set('type', 'cheque')->set('event', 'created')
            ->assertSee('Created');
    }

    public function test_private_files_require_login(): void
    {
        \Illuminate\Support\Facades\Storage::fake('local');
        $path = \Illuminate\Http\UploadedFile::fake()->image('c.jpg')->store('cheques', 'local');
        $cheque = $this->registerCheque(['scan_path' => $path]);

        $this->get(route('files.show', ['cheque', $cheque->id]))->assertOk();
        auth()->logout();
        $this->get(route('files.show', ['cheque', $cheque->id]))->assertRedirect('/login');
    }
}
