<?php

namespace Tests\Feature\Ui;

use App\Models\SupplierPayment;
use App\Models\User;
use App\Services\Balances;
use App\Services\DealService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/** The Pay Supplier page (batch entry like Pay Department) and the shared pop-up. */
class SupplierPaymentsPageTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        $this->setUpLedger();
        $this->fundBank('100000');
        app(DealService::class)->saveOpening(null, ['account_id' => $this->cash->id, 'amount' => '40000', 'date' => now()->subMonth()->toDateString()]);
        // Goods bought on credit: the company owes the supplier 30,000.
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'on_credit' => true, 'account_id' => null, 'amount' => '30000', 'item_description' => 'Desks']);
    }

    private function page()
    {
        return Volt::test('supplier-payments.create', ['asPage' => true]);
    }

    public function test_the_page_builds_a_table_and_saves_it_together(): void
    {
        $page = $this->page()->assertSet('method', 'cash')->assertSet('supplier_id', $this->supplier->id)
            ->assertSee('Payment details')->assertSee('Amount &amp; reference', false);

        // Bank: the company's bank is picked; the item card clears, the payment details stay.
        $page->set('method', 'bank_transfer')->set('company_id', $this->company->id)->assertSet('account_id', $this->bank->id)
            ->set('amount', '12000')->set('reference', 'CHQ-77')->set('receipt', UploadedFile::fake()->image('slip.jpg'))
            ->call('addRow')->assertHasNoErrors()
            ->assertSet('amount', '')->assertSet('reference', '')->assertSet('method', 'bank_transfer')->assertCount('rows', 1);

        // Cash: no company.
        $page->set('method', 'cash')->assertSet('company_id', null)->set('amount', '5000')->call('addRow')->assertHasNoErrors();
        $this->assertNull($page->get('rows')[1]['company_id']);

        // More than is owed (30,000 - 17,000 in the table) is refused when added.
        $page->set('amount', '13000.01')->call('addRow')->assertHasErrors('amount')->assertCount('rows', 2);

        $page->call('saveAll')->assertHasNoErrors()->assertDispatched('draft-saved')->assertCount('rows', 0);
        $this->assertSame(2, SupplierPayment::count());
        $bank = SupplierPayment::where('reference', 'CHQ-77')->firstOrFail();
        $this->assertSame([$this->company->id, $this->bank->id], [$bank->company_id, $bank->account_id]);
        Storage::disk('local')->assertExists($bank->receipt_path);
        $cash = SupplierPayment::whereNull('company_id')->firstOrFail();
        $this->assertSame($this->cash->id, $cash->account_id);
        $this->assertSame('13000.00', Balances::supplierOwed($this->supplier->id));
    }

    public function test_a_bank_must_belong_to_the_company(): void
    {
        $other = $this->makeCompany('Zamzam Enterprises');
        $this->page()->set('method', 'bank_transfer')->set('company_id', $other->id)
            ->set('account_id', $this->bank->id)->set('amount', '1000')
            ->call('addRow')->assertHasErrors('account_id')->assertCount('rows', 0);
    }

    public function test_the_pop_up_edits_a_payment_and_its_receipt(): void
    {
        Volt::test('supplier-payments.create')
            ->dispatch('supplier-payment-create', companyId: $this->company->id, supplierId: $this->supplier->id)
            ->set('amount', '4000')->call('save')->assertHasNoErrors();
        $p = SupplierPayment::firstOrFail();

        Volt::test('supplier-payments.create')
            ->dispatch('supplier-payment-edit', id: $p->id)
            ->assertSet('method', 'bank_transfer')->assertSet('company_id', $this->company->id)->assertSet('account_id', $this->bank->id)
            ->set('amount', '4500')->set('receipt', UploadedFile::fake()->image('r.jpg'))
            ->call('save')->assertHasNoErrors();
        $p->refresh();
        $this->assertSame('4500.00', $p->amount);
        Storage::disk('local')->assertExists($p->receipt_path);
        $this->get(route('files.show', ['supplier-payment', $p->id]))->assertOk();

        // Agents never pay suppliers.
        $this->actingAs(User::factory()->create());
        $this->get(route('supplier-payments.create'))->assertForbidden();
    }
}
