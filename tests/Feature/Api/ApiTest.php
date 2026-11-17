<?php

namespace Tests\Feature\Api;

use App\Models\Account;
use App\Models\Cheque;
use App\Models\ChequeChangeRequest;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Balances;
use App\Services\DealService;
use App\Services\MasterDataService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * The mobile app's API (v1): sign-in and devices, the agents' daily work with the admin's
 * approvals, idempotent replays of offline entries, statements and who may see what.
 */
class ApiTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    private User $agent;

    private Account $agentBank;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        $this->setUpLedger();
        $this->fundBank('100000');
        app(DealService::class)->saveOpening(null, ['account_id' => $this->cash->id, 'amount' => '50000', 'date' => now()->subMonth()->toDateString()]);

        $master = app(MasterDataService::class);
        $this->agent = User::factory()->create(['name' => 'Bilal Ahmed', 'email' => 'bilal@ams.test', 'password' => 'secret-pass']);
        $master->ensureAgentCash($this->agent, $this->admin);
        $this->agentBank = $master->saveAccount(null, ['agent_id' => $this->agent->id, 'type' => 'bank', 'name' => 'Meezan Savings', 'bank_name' => 'Meezan Bank'], $this->admin);
    }

    private function asAdmin(): static
    {
        Sanctum::actingAs($this->admin);

        return $this;
    }

    private function asAgent(): static
    {
        Sanctum::actingAs($this->agent);

        return $this;
    }

    public function test_sign_in_devices_and_sign_out(): void
    {
        $this->postJson('/api/v1/auth/login', ['email' => 'bilal@ams.test', 'password' => 'wrong', 'device_name' => 'Pixel 8'])
            ->assertUnprocessable()->assertJsonValidationErrors('email');

        $token = $this->postJson('/api/v1/auth/login', ['email' => 'bilal@ams.test', 'password' => 'secret-pass', 'device_name' => 'Pixel 8'])
            ->assertCreated()->assertJsonPath('user.role', 'agent')->assertJsonPath('token_type', 'Bearer')->json('token');
        $this->postJson('/api/v1/auth/login', ['email' => 'bilal@ams.test', 'password' => 'secret-pass', 'device_name' => 'Old phone'])->assertCreated();

        $this->withToken($token)->getJson('/api/v1/auth/me')->assertOk()->assertJsonPath('data.email', 'bilal@ams.test');
        $this->withToken($token)->getJson('/api/v1/auth/devices')->assertOk()->assertJsonCount(2, 'data')
            ->assertJsonFragment(['name' => 'Pixel 8', 'current' => true]);
        $this->app['auth']->forgetGuards(); // the test client otherwise keeps the user between requests
        $this->getJson('/api/v1/auth/me', ['Authorization' => ''])->assertUnauthorized();
        $this->app['auth']->forgetGuards();
        $this->getJson('/api/v1/auth/me', ['Authorization' => 'Bearer nope'])->assertUnauthorized();

        // The admin sees the agent's devices and signs the old phone out.
        $old = $this->agent->tokens()->where('name', 'Old phone')->first();
        $this->asAdmin()->getJson("/api/v1/users/{$this->agent->id}")->assertOk()->assertJsonCount(2, 'data.devices');
        $this->deleteJson("/api/v1/users/{$this->agent->id}/devices/{$old->id}")->assertOk();
        $this->assertSame(1, $this->agent->tokens()->count());

        // Deactivating the agent signs out every device.
        $this->patchJson("/api/v1/users/{$this->agent->id}", ['is_active' => false])->assertOk()->assertJsonPath('data.is_active', false);
        $this->assertSame(0, $this->agent->tokens()->count());
        $this->postJson('/api/v1/auth/login', ['email' => 'bilal@ams.test', 'password' => 'secret-pass', 'device_name' => 'x'])
            ->assertUnprocessable()->assertJsonFragment(['Your account has been deactivated.']);
    }

    public function test_agents_cannot_reach_admin_endpoints(): void
    {
        $this->asAgent();
        foreach (['companies', 'departments', 'suppliers', 'expense-categories', 'users', 'agents', 'approvals', 'expenses',
            'supplier-payments', 'opening-balances', 'deal-closings', 'transactions', 'audit-log'] as $path) {
            $this->getJson("/api/v1/{$path}")->assertForbidden();
        }
        $this->getJson("/api/v1/statements/company/{$this->company->id}")->assertForbidden();
        $this->getJson("/api/v1/statements/agent/{$this->agent->id}")->assertOk();
        $this->postJson('/api/v1/transfers', [])->assertForbidden();

        $this->getJson('/api/v1/lookups')->assertOk()
            ->assertJsonPath('data.agents', [])->assertJsonCount(1, 'data.payment_methods')
            ->assertJsonPath('data.my_accounts.0.short_label', 'Meezan Savings (Meezan Bank)')
            ->assertJsonPath('data.my_accounts.0.label', 'Bilal Ahmed · Meezan Savings (Meezan Bank)')
            ->assertJsonPath('data.my_accounts.1.short_label', 'Cash in hand');
    }

    public function test_every_admin_list_answers(): void
    {
        $this->asAdmin();
        foreach (['lookups', 'dashboard', 'notifications', 'cheques', 'payments', 'transfers', 'approvals', 'supplier-payments', 'expenses',
            'companies', "companies/{$this->company->id}", 'accounts', "accounts/{$this->bank->id}", 'agents', "agents/{$this->agent->id}",
            'departments', "departments/{$this->dept->id}", 'suppliers', "suppliers/{$this->supplier->id}", 'expense-categories',
            'opening-balances', 'deal-closings', 'users', 'transactions?with_lines=1', 'audit-log',
            "statements/account/{$this->bank->id}", "statements/department/{$this->dept->id}?company_id=none",
            "statements/company/{$this->company->id}", "statements/agent/{$this->agent->id}"] as $path) {
            $this->getJson("/api/v1/{$path}")->assertOk();
        }
        $this->get("/api/v1/statements/account/{$this->bank->id}/pdf")->assertOk()->assertHeader('content-type', 'application/pdf');
    }

    public function test_an_agent_deposits_cheques_and_edits_go_to_the_admin(): void
    {
        $this->asAgent();
        $row = fn (string $no, array $extra = []) => [
            'cheque_date' => now()->subDay()->toDateString(), 'company_id' => $this->company->id, 'deposit_account_id' => $this->bank->id,
            'department_id' => $this->dept->id, 'cheque_number' => $no, 'amount' => '25000', 'bank_charges' => '100',
        ] + $extra;

        $id = $this->post('/api/v1/cheques', $row('900001', ['picture' => UploadedFile::fake()->image('cheque.jpg'), 'deposited_on' => now()->subDay()->toDateString()]), ['Accept' => 'application/json'])
            ->assertCreated()->assertJsonPath('data.net_deposit', '24900.00')->assertJsonPath('data.has_picture', true)
            ->assertJsonPath('data.deposited_on', now()->subDay()->toDateString())->json('data.id');
        $this->get("/api/v1/files/cheque/{$id}")->assertOk();

        // Batch: all-or-nothing, a bad row named.
        $this->postJson('/api/v1/cheques/batch', ['rows' => [$row('900002'), $row('900001')]])
            ->assertUnprocessable()->assertJsonValidationErrors('rows.1.cheque_number');
        $this->postJson('/api/v1/cheques/batch', ['rows' => [$row('900002'), $row('900003')]])->assertCreated()->assertJsonCount(2, 'data');
        $this->assertSame(3, Cheque::count() - 1); // + the setUp cheque

        // An agent sees only their cheques; an edit becomes a request.
        $this->getJson('/api/v1/cheques')->assertOk()->assertJsonCount(3, 'data');
        $this->patchJson("/api/v1/cheques/{$id}", ['amount' => '26000', 'reason' => 'Typo'])->assertStatus(202)->assertJsonPath('data.changes.amount', '26000.00');
        $this->assertSame('25000.00', (string) Cheque::find($id)->amount);
        $this->getJson('/api/v1/notifications')->assertJsonPath('data.waiting_for_admin.cheque_requests', 1);

        $request = ChequeChangeRequest::first();
        $this->asAdmin()->getJson('/api/v1/approvals')->assertOk()->assertJsonPath('data.cheque_requests.0.cheque.cheque_number', '900001');
        $this->postJson("/api/v1/approvals/cheque-requests/{$request->id}/approve")->assertOk();
        $this->assertSame('26000.00', (string) Cheque::find($id)->amount);
    }

    public function test_payments_batch_and_offline_replay_saves_once(): void
    {
        app(\App\Services\TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->agentBank->id, 'amount' => '30000', 'date' => now()->toDateString()]);
        $this->asAgent();

        $entry = ['company_id' => $this->company->id, 'department_id' => $this->dept->id, 'account_id' => $this->agentBank->id,
            'amount' => '12000', 'date' => now()->toDateString(), 'description' => 'Lab kits'];

        // The offline queue sends the same entry twice: saved once, the second answer is a replay.
        $first = $this->postJson('/api/v1/payments', $entry, ['Idempotency-Key' => 'pay-123'])->assertCreated();
        $this->postJson('/api/v1/payments', $entry, ['Idempotency-Key' => 'pay-123'])->assertCreated()
            ->assertHeader('Idempotent-Replayed', 'true')->assertJsonPath('data.id', $first->json('data.id'));
        $this->assertSame(1, Payment::count());
        $this->postJson('/api/v1/payments/batch', ['rows' => [$entry]], ['Idempotency-Key' => 'pay-123'])->assertUnprocessable();

        // A failed entry isn't stored: fixed and resent with the same key, it saves.
        $this->postJson('/api/v1/payments', ['amount' => '0'] + $entry, ['Idempotency-Key' => 'pay-124'])->assertUnprocessable()->assertJsonValidationErrors('amount');
        $this->postJson('/api/v1/payments', $entry, ['Idempotency-Key' => 'pay-124'])->assertCreated();

        // Agents only pay by bank transfer from their own bank; paying more than they hold is allowed.
        $this->postJson('/api/v1/payments', ['method' => 'cash'] + $entry)->assertUnprocessable()->assertJsonValidationErrors('method');
        $this->postJson('/api/v1/payments', ['account_id' => $this->bank->id] + $entry)->assertUnprocessable()->assertJsonValidationErrors('account_id');
        $this->postJson('/api/v1/payments', ['amount' => '10000'] + $entry)->assertCreated()->assertJsonPath('data.paid_by_agent.name', 'Bilal Ahmed');
        $this->assertSame('-4000.00', Balances::agentOwed($this->agent->id, $this->company->id));

        // A delete request, approved by the admin.
        $p = Payment::first();
        $this->deleteJson("/api/v1/payments/{$p->id}", ['reason' => 'Duplicate'])->assertStatus(202);
        $this->asAdmin()->postJson('/api/v1/approvals/payment-requests/'.PaymentChangeRequest::first()->id.'/approve')->assertOk();
        $this->assertSoftDeleted($p);

        // Admin batch: cash (no company) + bank, all-or-nothing on the cash total.
        $this->postJson('/api/v1/payments/batch', ['rows' => [
            ['method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '40000', 'date' => now()->toDateString()],
            ['method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '40000', 'date' => now()->toDateString()],
        ]])->assertUnprocessable();
        $this->postJson('/api/v1/payments/batch', ['rows' => [
            ['method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '4000', 'date' => now()->toDateString(), 'received_by' => 'Ali'],
            ['method' => 'bank_transfer', 'company_id' => $this->company->id, 'account_id' => $this->bank->id, 'department_id' => $this->dept->id, 'amount' => '5000', 'date' => now()->toDateString()],
        ]])->assertCreated()->assertJsonPath('data.0.company', null)->assertJsonPath('data.1.company.id', $this->company->id);
    }

    public function test_advances_and_returns(): void
    {
        $this->asAdmin()->postJson('/api/v1/transfers', ['from_account_id' => $this->bank->id, 'to_account_id' => $this->agentBank->id, 'amount' => '20000', 'date' => now()->toDateString()])
            ->assertCreated()->assertJsonPath('data.type', 'advance');
        $this->postJson('/api/v1/transfers', ['from_account_id' => $this->bank->id, 'to_account_id' => $this->cash->id, 'amount' => '5000', 'date' => now()->toDateString()])
            ->assertCreated()->assertJsonPath('data.kind', 'Moved to cash')->assertJsonPath('data.to_company', null);

        $this->asAgent();
        $id = $this->postJson('/api/v1/transfers/returns', ['from_account_id' => $this->agentBank->id, 'from_company_id' => $this->company->id, 'to_account_id' => $this->cash->id, 'amount' => '3000', 'date' => now()->toDateString()])
            ->assertCreated()->assertJsonPath('data.status', 'pending')->json('data.id');
        $this->getJson('/api/v1/transfers')->assertOk()->assertJsonCount(2, 'data');

        $this->asAdmin()->postJson("/api/v1/approvals/returns/{$id}/approve")->assertOk();
        $this->assertSame(Transfer::POSTED, Transfer::find($id)->status);
        $this->assertSame('17000.00', Balances::agentOwed($this->agent->id));
        $this->getJson("/api/v1/statements/agent/{$this->agent->id}")->assertOk()->assertJsonPath('data.closing', '17000.00');
    }

    public function test_setup_endpoints(): void
    {
        $this->asAdmin();
        $co = $this->postJson('/api/v1/companies', ['name' => 'Crescent Supplies'])->assertCreated()->json('data.id');
        $bank = $this->postJson('/api/v1/accounts', ['company_id' => $co, 'name' => 'Meezan Current', 'bank_name' => 'Meezan Bank', 'opening_balance' => '3000', 'opening_date' => now()->toDateString()])
            ->assertCreated()->assertJsonPath('data.balance', '3000.00')->json('data.id');
        $this->patchJson("/api/v1/accounts/{$bank}", ['branch' => 'Saddar'])->assertOk()->assertJsonPath('data.branch', 'Saddar');
        $this->patchJson("/api/v1/accounts/{$this->cash->id}", ['name' => 'x'])->assertForbidden();

        $dept = $this->postJson('/api/v1/departments', ['name' => 'Water Board'])->assertCreated()->json('data.id');
        $this->postJson('/api/v1/departments', ['name' => 'Water Board'])->assertUnprocessable()->assertJsonValidationErrors('name');
        $this->postJson('/api/v1/opening-balances', ['party' => 'department', 'company_id' => $co, 'department_id' => $dept, 'amount' => '-4000', 'date' => now()->toDateString()])->assertCreated();
        $this->postJson('/api/v1/opening-balances', ['party' => 'cash', 'amount' => '1000', 'date' => now()->toDateString()])
            ->assertUnprocessable()->assertJsonFragment(['There is already an opening balance for Cash in hand. Edit that one instead.']);
        $this->postJson('/api/v1/deal-closings', ['company_id' => $co, 'department_id' => $dept, 'date' => now()->toDateString()])
            ->assertCreated()->assertJsonPath('data.result', 'profit')->assertJsonPath('data.amount', '4000.00');
        $this->deleteJson("/api/v1/departments/{$dept}")->assertOk()->assertJsonPath('result', 'deactivated');
        $this->postJson('/api/v1/expense-categories', ['name' => 'Tea'])->assertCreated();

        // Agents add their own banks; the ones the admin added stay read-only to them.
        $this->asAgent();
        $mine = $this->postJson('/api/v1/accounts', ['name' => 'JazzCash', 'bank_name' => 'JazzCash', 'company_id' => $co])
            ->assertCreated()->assertJsonPath('data.agent.id', $this->agent->id)->assertJsonPath('data.can_edit', true)->json('data.id');
        $this->deleteJson("/api/v1/accounts/{$mine}")->assertOk();
        $this->patchJson("/api/v1/accounts/{$this->agentBank->id}", ['branch' => 'x'])->assertForbidden();
        $this->getJson('/api/v1/accounts')->assertOk()->assertJsonCount(2, 'data');
    }
}
