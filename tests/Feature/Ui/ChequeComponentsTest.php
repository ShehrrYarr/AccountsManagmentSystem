<?php

namespace Tests\Feature\Ui;

use App\Enums\ApprovalAction;
use App\Enums\ChequeStatus;
use App\Models\ApprovalRequest;
use App\Models\Cheque;
use App\Models\GovernmentDepartment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

class ChequeComponentsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    private function fillCheque($component, array $overrides = [])
    {
        foreach (array_merge([
            'company_id' => $this->company->id,
            'cheque_number' => '55501',
            'issuing_bank' => 'National Bank of Pakistan',
            'amount' => '250000',
            'cheque_date' => now()->subDays(3)->toDateString(),
            'received_date' => now()->toDateString(),
        ], $overrides) as $k => $v) {
            $component->set($k, $v);
        }

        return $component;
    }

    public function test_register_cheque_with_scan_and_inline_department(): void
    {
        Storage::fake('local');

        $c = Volt::test('cheques.register-cheque')
            ->dispatch('cheque-create', companyId: $this->company->id)
            ->assertDispatched('modal-show', id: 'chequeFormModal')
            ->assertSet('company_id', $this->company->id)
            ->set('addingDepartment', true)
            ->set('newDepartment', 'Accountant General Punjab')
            ->call('addDepartment')
            ->assertHasNoErrors();

        $dept = GovernmentDepartment::sole();
        $c->assertSet('government_department_id', $dept->id);

        $this->fillCheque($c)->set('scan', UploadedFile::fake()->image('cheque.jpg'))
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('transaction-updated')
            ->assertDispatched('modal-hide', id: 'chequeFormModal')
            ->assertDispatched('toast');

        $cheque = Cheque::sole();
        $this->assertSame(ChequeStatus::Received, $cheque->status);
        $this->assertSame($dept->id, $cheque->government_department_id);
        Storage::disk('local')->assertExists($cheque->scan_path);
    }

    public function test_register_validation_and_duplicate_cheque_numbers(): void
    {
        Volt::test('cheques.register-cheque')->call('save')
            ->assertHasErrors(['company_id', 'cheque_number', 'issuing_bank', 'amount']);

        $this->registerCheque(['cheque_number' => '777', 'issuing_bank' => 'HBL']);

        $c = Volt::test('cheques.register-cheque')->dispatch('cheque-create');
        $this->fillCheque($c, ['cheque_number' => '777', 'issuing_bank' => 'HBL'])->call('save')
            ->assertHasErrors(['cheque_number' => 'unique']);

        // Same number from a different bank is fine.
        $this->fillCheque(Volt::test('cheques.register-cheque')->dispatch('cheque-create'), ['cheque_number' => '777', 'issuing_bank' => 'UBL'])
            ->call('save')->assertHasNoErrors();
    }

    public function test_received_date_cannot_precede_cheque_date(): void
    {
        $c = Volt::test('cheques.register-cheque')->dispatch('cheque-create');
        $this->fillCheque($c, ['cheque_date' => now()->toDateString(), 'received_date' => now()->subDays(5)->toDateString()])
            ->call('save')->assertHasErrors(['received_date']);
    }

    public function test_expiry_preview_updates_live(): void
    {
        $c = Volt::test('cheques.register-cheque')->dispatch('cheque-create')
            ->set('cheque_date', now()->subMonths(7)->toDateString());

        $this->assertTrue($c->get('expiry')['expired']);
        $c->assertSee('Expired on');
    }

    public function test_clear_cheque_deposit_with_live_preview(): void
    {
        $cheque = $this->registerCheque(['amount' => '200000']);

        $c = Volt::test('cheques.clear-cheque')
            ->dispatch('cheque-clear', id: $cheque->id)
            ->assertDispatched('modal-show', id: 'clearChequeModal')
            ->set('cleared_into_account_id', $this->bank->id)
            ->set('commission_type', 'percent')
            ->set('commission_rate', '1.5')
            ->set('bank_charges', '200');

        $preview = $c->get('preview');
        $this->assertSame('3000.00', $preview['commission']);
        $this->assertSame('197000.00', $preview['toCompany']);
        $this->assertSame('199800.00', $preview['toAccount']);

        $c->call('save')->assertHasNoErrors()->assertDispatched('transaction-updated');

        $this->assertSame(ChequeStatus::Cleared, $cheque->fresh()->status);
        $this->assertBalances(payable: '197000.00', bank: '199800.00');
    }

    public function test_clear_by_encashment_uses_vault(): void
    {
        $cheque = $this->registerCheque(['amount' => '1000']);

        Volt::test('cheques.clear-cheque')
            ->dispatch('cheque-clear', id: $cheque->id)
            ->call('setMethod', 'encashment')
            ->call('save')->assertHasNoErrors();

        $this->assertBalances(payable: '1000.00', vault: '1000.00', bank: '0.00');
    }

    public function test_deposit_requires_an_account_and_sane_commission(): void
    {
        $cheque = $this->registerCheque(['amount' => '1000']);

        Volt::test('cheques.clear-cheque')->dispatch('cheque-clear', id: $cheque->id)
            ->set('cleared_into_account_id', null)
            ->call('save')->assertHasErrors(['cleared_into_account_id']);

        Volt::test('cheques.clear-cheque')->dispatch('cheque-clear', id: $cheque->id)
            ->set('cleared_into_account_id', $this->bank->id)
            ->set('commission_type', 'fixed')->set('commission_rate', '5000')
            ->call('save')->assertHasErrors(['commission_rate'])->assertDispatched('toast', type: 'error');

        $this->assertSame(ChequeStatus::Received, $cheque->fresh()->status);
    }

    public function test_staff_clearing_goes_to_approval(): void
    {
        $this->actingAs($this->staff);
        $cheque = $this->registerCheque([], $this->staff);

        Volt::test('cheques.clear-cheque')->dispatch('cheque-clear', id: $cheque->id)
            ->set('cleared_into_account_id', $this->bank->id)
            ->call('save')->assertHasNoErrors()
            ->assertDispatched('toast', type: 'info');

        $this->assertSame(ChequeStatus::Received, $cheque->fresh()->status);
        $this->assertSame(ApprovalAction::ClearCheque, ApprovalRequest::sole()->action);
    }

    public function test_bounce_modal_shows_block_reason(): void
    {
        $cheque = $this->clearedCheque('10000');
        app(\App\Services\DisbursementService::class)->create([
            'company_id' => $this->company->id, 'type' => 'vendor_purchase', 'source_account_id' => $this->bank->id,
            'vendor_id' => $this->vendor()->id, 'amount' => '9000', 'item_description' => 'Stationery',
        ], $this->admin);

        Volt::test('cheques.close-cheque')
            ->dispatch('cheque-close', id: $cheque->id, action: 'bounce')
            ->set('closed_reason', 'Returned unpaid')
            ->call('save')
            ->assertHasErrors(['closed_reason'])
            ->assertSee('manual adjustment');

        $this->assertSame(ChequeStatus::Cleared, $cheque->fresh()->status);
    }

    public function test_cancel_pending_cheque(): void
    {
        $cheque = $this->registerCheque();

        Volt::test('cheques.close-cheque')
            ->dispatch('cheque-close', id: $cheque->id, action: 'cancel')
            ->call('save')->assertHasErrors(['closed_reason'])
            ->set('closed_reason', 'Sent back to department')
            ->call('save')->assertHasNoErrors();

        $this->assertSame(ChequeStatus::Cancelled, $cheque->fresh()->status);
    }

    public function test_list_filters_search_and_delete(): void
    {
        $other = $this->makeCompany('Zeta Works');
        $this->registerCheque(['cheque_number' => 'AAA111']);
        $this->registerCheque(['cheque_number' => 'BBB222', 'company_id' => $other->id]);
        $cleared = $this->clearedCheque('500');

        $list = Volt::test('cheques.list')
            ->assertSee('AAA111')->assertSee('BBB222')->assertDontSee('#'.$cleared->cheque_number)
            ->set('search', 'Zeta')->assertSee('BBB222')->assertDontSee('AAA111')
            ->set('search', '')->set('status', 'all')->assertSee('#'.$cleared->cheque_number)
            ->set('filterCompany', $other->id)->assertSee('BBB222')->assertDontSee('AAA111')
            ->call('clearFilters')->assertSee('AAA111');

        $target = Cheque::where('cheque_number', 'AAA111')->first();
        $list->call('delete', $target->id)->assertDispatched('transaction-updated');
        $this->assertSoftDeleted($target);
    }

    public function test_list_refreshes_on_transaction_updated(): void
    {
        $list = Volt::test('cheques.list')->assertDontSee('NEW999');
        $this->registerCheque(['cheque_number' => 'NEW999']);
        $list->dispatch('transaction-updated')->assertSee('NEW999');
    }
}
