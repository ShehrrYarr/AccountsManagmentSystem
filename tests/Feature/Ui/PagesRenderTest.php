<?php

namespace Tests\Feature\Ui;

use App\Models\Cheque;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * Every screen renders for an administrator; guests and non-admins are kept out.
 */
class PagesRenderTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
        $this->fundBank('50000');
        $this->cheque(['department_id' => $this->makeDepartment()->id, 'amount' => '20000']);
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'on_credit' => true, 'account_id' => null, 'amount' => '7000', 'item_description' => 'Chairs']);
    }

    public static function pages(): array
    {
        return [
            ['/dashboard'], ['/approvals'], ['/cheques'], ['/cheques/deposit'], ['/payments'], ['/supplier-payments'], ['/expenses'], ['/transfers'],
            ['/companies'], ['/accounts'], ['/departments'], ['/suppliers'], ['/transactions'],
            ['/opening-balances'], ['/expense-categories'], ['/users'], ['/audit-log'], ['/profile'],
        ];
    }

    #[DataProvider('pages')]
    public function test_pages_render_for_admin(string $url): void
    {
        $this->actingAs($this->admin)->get($url)->assertOk();
    }

    public function test_detail_pages_and_statements_render(): void
    {
        $this->get("/companies/{$this->company->id}")->assertOk()->assertSee('Al-Noor Traders')->assertSee('Company ledger');
        $this->get("/accounts/{$this->bank->id}")->assertOk()->assertSee('Bank Statement');
        $this->get("/accounts/{$this->cash->id}")->assertOk()->assertSee('Cash Statement');
        $this->get("/departments/{$this->dept->id}")->assertOk()->assertSee('Health Dept')->assertSee('Department Ledger');
        $this->get("/suppliers/{$this->supplier->id}")->assertOk()->assertSee('Office Mart')->assertSee('Supplier Ledger');

        foreach ([['account', $this->bank->id], ['department', $this->dept->id], ['supplier', $this->supplier->id], ['company', $this->company->id]] as [$kind, $id]) {
            $this->get("/statements/{$kind}/{$id}/print")->assertOk()->assertSee('Opening balance');
            $this->get("/statements/{$kind}/{$id}/pdf")->assertOk()->assertHeader('content-type', 'application/pdf');
        }

        $this->get("/statements/department/{$this->dept->id}/print?company={$this->company->id}&from=".now()->subYear()->toDateString())->assertOk();
        $this->get('/statements/vendor/1/print')->assertNotFound();
    }

    public function test_redirects_stay_inside_a_sub_path_install(): void
    {
        // Simulate http://host/ams/... (app served from a sub-folder, as on the server).
        $get = function (string $path) {
            $request = \Illuminate\Http\Request::create('http://localhost/ams'.$path, 'GET', [], [], [], [
                'SCRIPT_NAME' => '/ams/index.php',
                'SCRIPT_FILENAME' => public_path('index.php'),
                'PHP_SELF' => '/ams/index.php',
            ]);

            return app(\Illuminate\Contracts\Http\Kernel::class)->handle($request);
        };

        \Illuminate\Support\Facades\Auth::guard('web')->setUser($this->admin);
        $this->assertSame('http://localhost/ams/dashboard', $get('/')->headers->get('Location'));

        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        $this->assertSame('http://localhost/ams/login', $get('/dashboard')->headers->get('Location'));
    }

    public function test_guests_are_sent_to_login(): void
    {
        auth()->logout();
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/login')->assertOk()->assertSee('Sign In');
    }

    public function test_inactive_users_are_signed_out(): void
    {
        $agent = User::factory()->create(['is_active' => false]);
        $this->actingAs($agent)->get('/cheques')->assertRedirect('/login');
        $this->assertGuest();

        $this->admin->update(['is_active' => false]);
        $this->actingAs($this->admin->fresh())->get('/dashboard')->assertRedirect('/login');
    }

    public function test_agents_only_reach_their_cheques_and_accounts(): void
    {
        $agent = User::factory()->create(['name' => 'Bilal Agent']);
        $this->actingAs($agent);

        $this->get('/')->assertRedirect(route('cheques.index'));
        $this->get('/cheques')->assertOk()->assertSee('My Govt Cheques')->assertDontSee('Received by anyone');
        $this->get('/cheques/deposit')->assertOk()->assertSee('Batch details')->assertDontSee('+ New department');
        $this->get('/my-accounts')->assertOk()->assertSee('My cash &amp; bank accounts', false);
        $this->get('/profile')->assertOk();

        foreach (['/dashboard', '/approvals', '/payments', '/transfers', '/companies', '/accounts', '/departments', '/suppliers',
            '/transactions', '/opening-balances', '/expense-categories', '/users', '/audit-log',
            "/statements/company/{$this->company->id}/print", "/accounts/{$this->bank->id}"] as $url) {
            $this->get($url)->assertForbidden();
        }

        // Pictures: only of cheques they received.
        $theirs = Cheque::first(); // entered by the admin in setUp
        $this->get(route('files.show', ['cheque', $theirs->id]))->assertForbidden();
    }
}
