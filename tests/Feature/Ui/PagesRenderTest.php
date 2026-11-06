<?php

namespace Tests\Feature\Ui;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * Every screen renders for the right role, and is protected for the wrong one.
 */
class PagesRenderTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
        $this->clearedCheque('50000');
        $this->registerCheque();
    }

    public static function sharedPages(): array
    {
        return [
            ['/dashboard'], ['/cheques'], ['/disbursements'], ['/transfers'], ['/transactions'],
            ['/companies'], ['/bank-accounts'], ['/vendors'], ['/departments'], ['/profile'],
        ];
    }

    public static function adminPages(): array
    {
        return [['/adjustments'], ['/approvals'], ['/users'], ['/audit-log']];
    }

    #[DataProvider('sharedPages')]
    public function test_shared_pages_render_for_staff(string $url): void
    {
        $this->actingAs($this->staff)->get($url)->assertOk();
    }

    #[DataProvider('adminPages')]
    public function test_admin_pages_render_for_admin(string $url): void
    {
        $this->actingAs($this->admin)->get($url)->assertOk();
    }

    #[DataProvider('adminPages')]
    public function test_admin_pages_are_forbidden_for_staff(string $url): void
    {
        $this->actingAs($this->staff)->get($url)->assertForbidden();
    }

    public function test_company_statement_page_and_pdf(): void
    {
        $this->actingAs($this->staff)->get("/companies/{$this->company->id}")->assertOk()->assertSee('Acme Traders');
        $this->actingAs($this->staff)->get("/companies/{$this->company->id}/statement/print")->assertOk()->assertSee('Statement of Account');
        $this->actingAs($this->staff)->get("/companies/{$this->company->id}/statement.pdf")->assertOk()->assertHeader('content-type', 'application/pdf');
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
        $this->staff->update(['is_active' => false]);
        $this->actingAs($this->staff)->get('/dashboard')->assertRedirect('/login');
    }
}
