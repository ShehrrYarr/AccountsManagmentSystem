<?php

namespace Tests\Feature\Ui;

use App\Models\Cheque;
use App\Models\User;
use App\Services\MasterDataService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * The browser keeps the Deposit Cheque / Pay Department pages' unsaved work and hands it back
 * through restoreDraft(). What comes back from the browser is checked before it is used.
 */
class FormDraftTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        $this->setUpLedger();
    }

    private function chequePage()
    {
        return Volt::test('cheques.register-cheque', ['asPage' => true]);
    }

    /** What the browser stores: the page's fields, as amsDraft copies them. */
    private function draftOf($page): array
    {
        return collect(['cheque_date', 'company_id', 'deposit_account_id', 'issuing_branch', 'department_id', 'cheque_number', 'amount',
            'bank_charges', 'notes', 'deposit_reference', 'rows', 'editingRow', 'rowScanPath', 'rowScanName', 'heldBatch', 'draftToken'])
            ->mapWithKeys(fn ($f) => [$f => $page->get($f)])->all();
    }

    public function test_a_cheque_draft_comes_back_with_only_its_own_pictures_and_is_not_saved_twice(): void
    {
        $page = $this->chequePage()
            ->set('cheque_number', '700001')->set('amount', '25000')->set('scan', UploadedFile::fake()->image('cheque.jpg'))
            ->call('addRow')->assertHasNoErrors()
            ->set('cheque_number', '700002')->set('amount', '1200');
        $own = $page->get('rows')[0]['scan_path'];
        Storage::disk('local')->assertExists($own);

        // A row pointing at someone else's picture (e.g. a saved cheque's) loses the picture.
        Storage::disk('local')->put('cheques/2026/01/other.jpg', 'x');
        $draft = $this->draftOf($page);
        $draft['rows'][] = array_merge($draft['rows'][0], ['cheque_number' => '700003', 'scan_path' => 'cheques/2026/01/other.jpg', 'scan_name' => 'other.jpg']);
        $draft['rows'][] = ['cheque_date' => 'not a date', 'amount' => '5']; // unusable: dropped

        $back = $this->chequePage()->call('restoreDraft', $draft)->assertReturned(['restored' => true])
            ->assertSet('cheque_number', '700002')->assertSet('amount', '1200')->assertCount('rows', 2);
        $this->assertSame($own, $back->get('rows')[0]['scan_path']);
        $this->assertNull($back->get('rows')[1]['scan_path']);
        $this->assertNull($back->get('rows')[1]['scan_name']);

        $back->call('saveAll')->assertDispatched('draft-saved')->assertCount('rows', 0);
        $this->assertSame(2, Cheque::count());
        $this->assertSame($own, Cheque::where('cheque_number', '700001')->value('scan_path'));

        // The same copy left in a browser is thrown away rather than saved again.
        $this->chequePage()->call('restoreDraft', $draft)->assertReturned(['restored' => false])->assertCount('rows', 0);

        // Its picture now belongs to a saved cheque: a new draft can't claim (or delete) it.
        $stale = $this->draftOf($this->chequePage());
        $stale['rows'] = [array_merge($draft['rows'][0], ['cheque_number' => '700009'])];
        $again = $this->chequePage()->call('restoreDraft', $stale)->assertReturned(['restored' => true]);
        $this->assertNull($again->get('rows')[0]['scan_path']);
        $again->call('discardDraft');
        Storage::disk('local')->assertExists($own);
    }

    public function test_discard_empties_the_table_and_deletes_its_pictures(): void
    {
        $page = $this->chequePage()
            ->set('cheque_number', '710001')->set('amount', '9000')->set('scan', UploadedFile::fake()->image('a.jpg'))
            ->call('addRow')->assertHasNoErrors()
            ->set('amount', '50');
        $path = $page->get('rows')[0]['scan_path'];

        $page->call('discardDraft')->assertCount('rows', 0)->assertSet('amount', '')->assertSet('company_id', $this->company->id);
        Storage::disk('local')->assertMissing($path);
        $this->assertSame(0, Cheque::count());
    }

    public function test_a_payment_draft_is_restored_within_the_agents_rules(): void
    {
        $agent = User::factory()->create();
        app(MasterDataService::class)->ensureAgentCash($agent, $this->admin);
        $this->actingAs($agent);

        $today = now()->toDateString();
        $page = Volt::test('payments.create', ['asPage' => true])->call('restoreDraft', [
            'date' => $today, 'method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '300', 'item_description' => 'Fuel',
            'rows' => [['date' => $today, 'method' => 'cash', 'department_id' => $this->dept->id, 'amount' => '100', 'receipt_path' => '../../.env']],
        ])->assertReturned(['restored' => true]);

        // Agents only pay by bank transfer; a path outside the receipts is ignored.
        $page->assertSet('method', 'bank_transfer')->assertSet('amount', '300')->assertSet('item_description', 'Fuel');
        $this->assertSame('bank_transfer', $page->get('rows')[0]['method']);
        $this->assertSame('100.00', $page->get('rows')[0]['amount']);
        $this->assertNull($page->get('rows')[0]['receipt_path']);
    }
}
