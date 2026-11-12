<?php

namespace Tests\Feature\Ui;

use App\Models\Account;
use App\Models\Cheque;
use App\Models\ChequeChangeRequest;
use App\Models\User;
use App\Services\Balances;
use App\Services\MasterDataService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * Agents: their own cheques and accounts; edits and deletes of saved cheques wait for the admin.
 */
class AgentsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    private User $agent;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();

        Volt::test('users.manage')
            ->call('create', 'agent')
            ->set('name', 'Bilal Ahmed')->set('email', 'bilal@ams.test')->set('password', 'Secret-12345')->set('password_confirmation', 'Secret-12345')
            ->call('save')->assertHasNoErrors();
        $this->agent = User::where('email', 'bilal@ams.test')->firstOrFail();
    }

    /** A cheque entered by the agent through the deposit page. */
    private function agentCheque(string $number, string $amount): Cheque
    {
        $this->actingAs($this->agent);
        Volt::test('cheques.register-cheque', ['asPage' => true])
            ->set('department_id', $this->dept->id)->set('cheque_number', $number)->set('amount', $amount)
            ->call('addRow')->assertHasNoErrors()
            ->call('saveAll')->assertHasNoErrors();

        return Cheque::where('cheque_number', $number)->firstOrFail();
    }

    public function test_a_new_agent_gets_a_cash_in_hand(): void
    {
        $this->assertTrue($this->agent->isAgent());
        $this->assertCount(1, $this->agent->agentAccounts);
        $this->assertTrue($this->agent->agentAccounts->first()->isCash());
    }

    public function test_agents_receive_cheques_and_see_only_their_own(): void
    {
        $this->cheque(['cheque_number' => 'ADMIN-1']);                 // received by the admin
        $mine = $this->agentCheque('AG-1', '25000');

        $this->assertSame($this->agent->id, $mine->created_by);
        $this->assertMoney('125000.00', $this->bank, 'the money still lands in the company bank');

        Volt::test('cheques.list')->assertSee('#AG-1')->assertDontSee('#ADMIN-1')->assertDontSee('Received by anyone');

        $this->actingAs($this->admin);
        Volt::test('cheques.list')->assertSee('#AG-1')->assertSee('#ADMIN-1')->assertSee('Bilal Ahmed')
            ->set('filterReceiver', $this->agent->id)->assertSee('#AG-1')->assertDontSee('#ADMIN-1');

        // Agents can't add departments.
        $this->actingAs($this->agent);
        Volt::test('cheques.register-cheque', ['asPage' => true])->assertDontSee('+ New department')
            ->set('newDepartment', 'Sneaky Dept')->call('addDepartment')->assertForbidden();
    }

    public function test_an_agents_edit_waits_for_approval(): void
    {
        $cheque = $this->agentCheque('AG-2', '40000');

        // The agent edits: a request is made, the cheque doesn't change.
        Volt::test('cheques.register-cheque')
            ->dispatch('cheque-edit', id: $cheque->id)
            ->assertSee('Request a Change to this Cheque')->assertSee('Send for approval')
            ->set('amount', '42000')->set('changeReason', 'Typed it wrong')
            ->call('save')->assertHasNoErrors()->assertDispatched('approval-updated');

        $request = ChequeChangeRequest::firstOrFail();
        $this->assertSame(['amount' => '42000.00'], $request->changes);
        $this->assertSame('40000.00', (string) $cheque->fresh()->amount);
        Volt::test('cheques.list')->assertSee('Edit pending');

        // A second request on the same cheque is refused.
        Volt::test('cheques.register-cheque')->dispatch('cheque-edit', id: $cheque->id)->assertDispatched('toast', type: 'error');

        // The admin sees it, with old and new values, and approves.
        $this->actingAs($this->admin);
        Volt::test('approvals.bell')->assertSee('Bilal Ahmed')->assertSee('#AG-2');
        Volt::test('approvals.manage')->assertSee('Typed it wrong')->assertSee('40,000.00')->assertSee('42,000.00')
            ->call('approve', $request->id)->assertHasNoErrors()->assertDispatched('transaction-updated');

        $this->assertSame('42000.00', (string) $cheque->fresh()->amount);
        $this->assertSame(ChequeChangeRequest::APPROVED, $request->fresh()->status);
        $this->assertSame('-42000.00', Balances::departmentBalance($this->dept->id));
        Volt::test('approvals.bell')->assertSee('Nothing waiting');
    }

    public function test_a_rejected_change_leaves_the_cheque_alone(): void
    {
        $cheque = $this->agentCheque('AG-3', '15000');
        Volt::test('cheques.register-cheque')->dispatch('cheque-edit', id: $cheque->id)
            ->set('cheque_number', 'AG-3X')->call('save')->assertHasNoErrors();

        $this->actingAs($this->admin);
        $request = ChequeChangeRequest::firstOrFail();
        Volt::test('approvals.manage')->call('startReject', $request->id)->set('rejectNote', 'Number is right')->call('reject')->assertHasNoErrors();

        $this->assertSame('AG-3', $cheque->fresh()->cheque_number);
        $this->actingAs($this->agent);
        Volt::test('cheques.list')->assertSee('Edit rejected')->assertSee('Number is right');
    }

    public function test_an_agents_delete_waits_for_approval_and_can_be_withdrawn(): void
    {
        $cheque = $this->agentCheque('AG-4', '30000');

        Volt::test('cheques.list')->call('delete', $cheque->id)->assertForbidden();
        Volt::test('cheques.list')->call('requestDelete', $cheque->id)->assertDispatched('toast', type: 'success');
        $this->assertFalse($cheque->fresh()->trashed());

        // Withdrawn by the agent...
        Volt::test('cheques.list')->call('withdrawRequest', ChequeChangeRequest::firstOrFail()->id);
        $this->assertSame(0, ChequeChangeRequest::count());

        // ...asked again and approved by the admin.
        Volt::test('cheques.list')->call('requestDelete', $cheque->id);
        $this->actingAs($this->admin);
        Volt::test('approvals.manage')->call('approve', ChequeChangeRequest::firstOrFail()->id)->assertHasNoErrors();
        $this->assertSoftDeleted($cheque);
        $this->assertMoney('0.00', $this->bank);
    }

    public function test_agents_cannot_touch_other_peoples_cheques(): void
    {
        $adminCheque = $this->cheque(['cheque_number' => 'ADMIN-2']);
        $this->actingAs($this->agent);

        Volt::test('cheques.list')->call('requestDelete', $adminCheque->id)->assertNotFound();
        Volt::test('cheques.register-cheque')->dispatch('cheque-edit', id: $adminCheque->id)->assertNotFound();
        $this->assertSame(0, ChequeChangeRequest::count());
    }

    public function test_my_accounts_for_agents(): void
    {
        $master = app(MasterDataService::class);
        $byAdmin = $master->saveAccount(null, ['agent_id' => $this->agent->id, 'type' => 'bank', 'name' => 'Meezan Savings', 'bank_name' => 'Meezan Bank'], $this->admin);

        $this->actingAs($this->agent);
        $page = Volt::test('accounts.manage', ['mine' => true])
            ->assertSee('Cash in hand')->assertSee('Meezan Savings')->assertSee('Admin')->assertDontSee('Al-Noor Traders');

        // Adds their own bank account.
        $page->dispatch('account-create')->set('name', 'JazzCash Wallet')->set('bank_name', 'JazzCash')->set('account_number', '0300-1112223')
            ->call('save')->assertHasNoErrors();
        $own = Account::where('name', 'JazzCash Wallet')->firstOrFail();
        $this->assertSame($this->agent->id, $own->agent_id);
        $this->assertFalse($own->addedByAdmin());

        // Can change their own, not the admin's or the cash in hand.
        $page->dispatch('account-edit', id: $own->id)->set('branch', 'Online')->call('save')->assertHasNoErrors();
        $page->dispatch('account-edit', id: $byAdmin->id)->assertForbidden();
        Volt::test('accounts.manage', ['mine' => true])->call('delete', $this->agent->agentAccounts()->cash()->first()->id)->assertForbidden();

        // The admin sees and manages them on Cash & Bank.
        $this->actingAs($this->admin);
        Volt::test('accounts.manage')->assertSee('Admin cash in hand')->assertSee('Bilal Ahmed')->assertSee('JazzCash Wallet')
            ->dispatch('account-edit', id: $own->id)->assertSet('holder', 'agent');
    }
}
