<?php

namespace Tests\Feature\Ui;

use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Company;
use App\Models\JournalLedgerEntry;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Balances;
use App\Services\DealService;
use App\Services\MasterDataService;
use App\Services\StatementService;
use App\Services\TransferService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * Advances to agents (company money the agent owes back) and their returns, which wait for the
 * admin when the agent records them.
 */
class AgentAdvancesTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    private User $agent;

    private Account $agentCash;

    private Account $agentBank;

    private Company $other;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
        $this->fundBank('100000');

        $this->other = $this->makeCompany('Al-Majeed Enterprises');
        app(DealService::class)->saveOpening(null, ['company_id' => $this->other->id, 'account_id' => $this->cash->id, 'amount' => '50000', 'date' => now()->subMonth()->toDateString()]);

        $master = app(MasterDataService::class);
        $this->agent = User::factory()->create(['name' => 'Bilal Ahmed']);
        $this->agentCash = $master->ensureAgentCash($this->agent, $this->admin);
        $this->agentBank = $master->saveAccount(null, ['agent_id' => $this->agent->id, 'type' => 'bank', 'name' => 'Meezan Savings', 'bank_name' => 'Meezan Bank'], $this->admin);
    }

    private function transfer(array $data): Transfer
    {
        return app(TransferService::class)->save(null, $data + ['date' => now()->toDateString()]);
    }

    private function advance(string $amount, ?Account $from = null, ?Account $to = null, ?int $companyId = null): Transfer
    {
        return $this->transfer([
            'from_account_id' => ($from ?? $this->bank)->id, 'to_account_id' => ($to ?? $this->agentBank)->id,
            'from_company_id' => $companyId ?? $this->company->id, 'amount' => $amount,
        ]);
    }

    private function assertJournalBalanced(): void
    {
        foreach (Transaction::posted()->with('entries')->get() as $t) {
            foreach ($t->entries->groupBy('company_id') as $lines) {
                $this->assertSame(0, bccomp((string) $lines->sum('debit'), (string) $lines->sum('credit'), 2), "transaction {$t->id} unbalanced");
            }
        }
    }

    public function test_an_advance_leaves_the_company_and_is_owed_by_the_agent(): void
    {
        $t = $this->advance('30000');

        $this->assertSame('Advance to agent', $t->kind());
        $this->assertMoney('70000.00', $this->bank, 'company bank goes down');
        $this->assertMoney('30000.00', $this->agentBank, 'agent account goes up');
        $this->assertSame('30000.00', Balances::agentOwed($this->agent->id));
        $this->assertSame('30000.00', Balances::agentOwed($this->agent->id, $this->company->id));
        $this->assertSame('0.00', Balances::agentOwed($this->agent->id, $this->other->id));
        $this->assertSame('70000.00', Balances::money($this->company->id)['total'], 'not counted in company money');
        $this->assertSame('30000.00', Balances::withAgents($this->company->id));
        $this->assertSame(TransactionType::AgentAdvance, Transaction::posted()->latest('id')->first()->type);
        $this->assertJournalBalanced();

        // Admin cash advance for the other company.
        $this->advance('20000', $this->cash, $this->agentCash, $this->other->id);
        $this->assertSame('50000.00', Balances::agentOwed($this->agent->id));
        $this->assertSame('-20000.00', Balances::money($this->other->id)['moved'], 'taken from the cash pot for the other company');

        // On every statement involved.
        $statements = app(StatementService::class);
        $bank = $statements->build('account', $this->bank->id);
        $this->assertSame('70000.00', $bank['closing']);
        $this->assertStringContainsString('Advance to Bilal Ahmed', collect($bank['rows'])->last()['description']);

        $agentBank = $statements->build('account', $this->agentBank->id);
        $this->assertSame('30000.00', $agentBank['closing']);
        $this->assertTrue($agentBank['companyFilter']);

        $ledger = $statements->build('agent', $this->agent->id);
        $this->assertSame('Agent Ledger', $ledger['title']);
        $this->assertSame('50000.00', $ledger['closing']);
        $this->assertCount(2, $ledger['rows']);
        $this->assertSame('30000.00', $statements->build('agent', $this->agent->id, $this->company->id)['closing']);

        $company = $statements->build('company', $this->company->id);
        $this->assertSame('70000.00', $company['closing'], 'company cash + bank drops');
    }

    public function test_returns_lower_what_is_owed_but_never_below_zero(): void
    {
        $this->advance('30000');

        $r = $this->transfer(['from_account_id' => $this->agentBank->id, 'from_company_id' => $this->company->id, 'to_account_id' => $this->cash->id, 'amount' => '10000']);
        $this->assertSame('Return from agent', $r->kind());
        $this->assertSame(TransactionType::AgentReturn, Transaction::posted()->latest('id')->first()->type);
        $this->assertSame('20000.00', Balances::agentOwed($this->agent->id));
        $this->assertSame('10000.00', Balances::money($this->company->id)['moved'], 'returned into the cash pot for the company');
        $this->assertMoney('20000.00', $this->agentBank);

        // Can't return the other company's money it was never given...
        try {
            $this->transfer(['from_account_id' => $this->agentBank->id, 'from_company_id' => $this->other->id, 'to_account_id' => $this->cash->id, 'amount' => '5000']);
            $this->fail('returned money the agent does not owe');
        } catch (BusinessRuleException $e) {
            $this->assertStringContainsString('more than Bilal Ahmed owes Al-Majeed Enterprises', $e->getMessage());
        }

        // ...or more than the account holds.
        $this->expectException(BusinessRuleException::class);
        $this->transfer(['from_account_id' => $this->agentBank->id, 'from_company_id' => $this->company->id, 'to_account_id' => $this->bank->id, 'amount' => '25000']);
    }

    public function test_agent_moves_stay_inside_one_company(): void
    {
        $otherBank = $this->makeBank($this->other, 'UBL Current');
        $this->advance('10000');

        $this->expectException(BusinessRuleException::class);
        $this->transfer(['from_account_id' => $this->agentBank->id, 'from_company_id' => $this->company->id, 'to_account_id' => $otherBank->id, 'amount' => '5000']);
    }

    public function test_no_moves_between_agents(): void
    {
        $this->expectExceptionMessage('between an agent and a company account');
        $this->transfer(['from_account_id' => $this->agentCash->id, 'from_company_id' => $this->company->id, 'to_account_id' => $this->agentBank->id, 'amount' => '1']);
    }

    public function test_an_agents_return_waits_for_approval(): void
    {
        $this->advance('30000');
        $this->actingAs($this->agent);

        $page = Volt::test('agents.returns', ['agentId' => $this->agent->id])
            ->dispatch('agent-return-create')
            ->assertSet('from_company_id', $this->company->id)
            ->set('from_account_id', $this->agentBank->id)->set('to_account_id', $this->bank->id)->set('amount', '12000')
            ->call('save')->assertHasNoErrors()->assertDispatched('approval-updated');

        $t = Transfer::firstWhere('status', Transfer::PENDING);
        $this->assertNotNull($t);
        $this->assertSame('30000.00', Balances::agentOwed($this->agent->id), 'nothing counts before approval');
        $this->assertMoney('70000.00', $this->bank);
        $page->assertSee('Waiting for approval');

        // Too much is refused at once.
        Volt::test('agents.returns', ['agentId' => $this->agent->id])->dispatch('agent-return-create')
            ->set('from_account_id', $this->agentBank->id)->set('to_account_id', $this->bank->id)->set('amount', '99000')
            ->call('save')->assertHasErrors('amount');
        $this->assertSame(1, Transfer::pending()->count());

        // The admin sees it on the bell and the Approvals page, and approves.
        $this->actingAs($this->admin);
        Volt::test('approvals.bell')->assertSee('Bilal Ahmed')->assertSee('returned');
        Volt::test('approvals.manage')->assertSee('Money returned by agents')->assertSee('12,000.00')
            ->call('approveReturn', $t->id)->assertHasNoErrors()->assertDispatched('transaction-updated');

        $this->assertTrue($t->fresh()->isPosted());
        $this->assertSame('18000.00', Balances::agentOwed($this->agent->id));
        $this->assertMoney('82000.00', $this->bank);
        $this->assertSame($this->admin->id, $t->fresh()->decided_by);
        Volt::test('transfers.manage')->assertSee('Return from agent')->assertSee('by agent');
    }

    public function test_rejected_and_withdrawn_returns_never_count(): void
    {
        $this->advance('30000');
        $service = app(TransferService::class);
        $data = ['from_account_id' => $this->agentBank->id, 'from_company_id' => $this->company->id, 'to_account_id' => $this->cash->id, 'amount' => '5000', 'date' => now()->toDateString()];

        $first = $service->requestReturn($data, $this->agent);
        Volt::test('approvals.manage')->call('startReject', $first->id, 'return')->set('rejectNote', 'Not received')->call('reject')->assertHasNoErrors();
        $this->assertSame(Transfer::REJECTED, $first->fresh()->status);

        $this->actingAs($this->agent);
        Volt::test('agents.returns', ['agentId' => $this->agent->id])->assertSee('Rejected')->assertSee('Not received');

        $second = $service->requestReturn($data, $this->agent);
        Volt::test('agents.returns', ['agentId' => $this->agent->id])->call('withdraw', $second->id);
        $this->assertNull(Transfer::find($second->id));

        $this->assertSame('30000.00', Balances::agentOwed($this->agent->id));
        $this->assertSame(0, Transfer::pending()->count());

        // Not from someone else's account.
        $otherAgent = User::factory()->create();
        $this->expectException(BusinessRuleException::class);
        $service->requestReturn($data, $otherAgent);
    }

    public function test_opening_amount_held_by_an_agent(): void
    {
        $o = app(DealService::class)->saveOpening(null, ['company_id' => $this->company->id, 'account_id' => $this->agentCash->id, 'amount' => '8000', 'date' => now()->subMonth()->toDateString()]);

        $this->assertTrue($o->isAgent());
        $this->assertSame('Bilal Ahmed · Cash in hand', $o->partyName());
        $this->assertSame('8000.00', Balances::agentOwed($this->agent->id, $this->company->id));
        $this->assertMoney('8000.00', $this->agentCash);
        $this->assertMoney('100000.00', $this->bank, 'company money is untouched');

        Volt::test('opening-balances.manage')->call('create', 'agent')
            ->set('company_id', $this->other->id)->set('agent_account_id', $this->agentBank->id)->set('amount', '2500')->set('date', now()->toDateString())
            ->call('save')->assertHasNoErrors();
        $this->assertSame('10500.00', Balances::agentOwed($this->agent->id));
        Volt::test('opening-balances.manage')->assertSee('Held by agent')->assertSee('agent holds, owes you');
        $this->assertJournalBalanced();

        // The account can't be deleted while it carries an opening amount.
        $this->expectException(BusinessRuleException::class);
        app(MasterDataService::class)->deleteAccount($this->agentBank);
    }

    public function test_the_transfers_screen_sends_and_takes_back(): void
    {
        Volt::test('transfers.manage')
            ->dispatch('transfer-create', mode: 'advance', agentId: $this->agent->id)
            ->assertSet('to_account_id', $this->agentCash->id)
            ->set('from_company_id', $this->company->id)->set('from_account_id', $this->bank->id)->set('amount', '15000')
            ->call('save')->assertHasNoErrors()
            ->assertSee('Advance to agent')
            ->set('filterKind', 'agent')->assertSee('Bilal Ahmed');

        $this->assertSame('15000.00', Balances::agentOwed($this->agent->id));

        Volt::test('transfers.manage')
            ->dispatch('transfer-create', mode: 'return', agentId: $this->agent->id)
            ->assertSet('from_account_id', $this->agentCash->id)
            ->set('from_company_id', $this->company->id)->set('to_account_id', $this->cash->id)
            ->assertSee('owes Al-Noor Traders')
            ->set('amount', '5000')->call('save')->assertHasNoErrors();

        $this->assertSame('10000.00', Balances::agentOwed($this->agent->id));

        // Editing an advance keeps it an advance.
        $advance = Transfer::latest('id')->get()->first(fn ($t) => $t->isAdvance());
        Volt::test('transfers.manage')->call('edit', $advance->id)->assertSet('mode', 'advance')->set('amount', '16000')->call('save')->assertHasNoErrors();
        $this->assertSame('11000.00', Balances::agentOwed($this->agent->id));
        $this->assertSame(0, JournalLedgerEntry::posted()->where('journal_ledger_entries.ledger_account', 'agent')->where('journal_ledger_entries.company_id', $this->other->id)->count());
    }

    public function test_pages_for_admin_and_agent(): void
    {
        $this->advance('30000');

        $this->get('/agents')->assertOk()->assertSee('Money with agents')->assertSee('Bilal Ahmed')->assertSee('30,000.00');
        $this->get("/agents/{$this->agent->id}")->assertOk()->assertSee('Agent Ledger')->assertSee('Send advance');
        $this->get("/accounts/{$this->agentBank->id}")->assertOk()->assertSee('Bank Statement');
        $this->get("/statements/agent/{$this->agent->id}/print")->assertOk()->assertSee('Agent owes');
        $this->get("/companies/{$this->company->id}")->assertOk()->assertSee('With agents');
        $this->get('/dashboard')->assertOk()->assertSee('With agents');
        $this->get('/accounts')->assertOk()->assertSee('Owes');

        $this->actingAs($this->agent);
        $this->get('/my-ledger')->assertOk()->assertSee('My Ledger')->assertSee('You owe the companies')->assertSee('30,000.00');
        $this->get('/my-accounts')->assertOk()->assertSee('Return money');
        $this->get("/my-accounts/{$this->agentBank->id}")->assertOk()->assertSee('Bank Statement');
        $this->get("/statements/agent/{$this->agent->id}/pdf")->assertOk()->assertHeader('content-type', 'application/pdf');
        $this->get("/statements/account/{$this->agentBank->id}/print")->assertOk();

        $other = User::factory()->create();
        $theirs = app(MasterDataService::class)->ensureAgentCash($other, $this->admin);
        $this->get("/statements/agent/{$other->id}/print")->assertForbidden();
        $this->get("/statements/account/{$theirs->id}/print")->assertForbidden();
        $this->get("/statements/account/{$this->bank->id}/print")->assertForbidden();
        $this->get("/my-accounts/{$theirs->id}")->assertForbidden();
        $this->get('/agents')->assertForbidden();
        $this->get("/agents/{$this->agent->id}")->assertForbidden();
    }
}
