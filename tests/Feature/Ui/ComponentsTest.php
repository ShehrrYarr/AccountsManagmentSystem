<?php

namespace Tests\Feature\Ui;

use App\Models\Cheque;
use App\Models\Company;
use App\Models\DealClosing;
use App\Models\Department;
use App\Models\Expense;
use App\Models\OpeningBalance;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\Transfer;
use App\Services\Balances;
use App\Services\StatementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\Concerns\BuildsLedgerFixtures;
use Tests\TestCase;

/**
 * The Volt screens drive the services correctly: validation, business-rule errors and
 * the 'transaction-updated' broadcast.
 */
class ComponentsTest extends TestCase
{
    use BuildsLedgerFixtures, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpLedger();
    }

    public function test_entering_a_cheque_deposits_it(): void
    {
        Volt::test('cheques.register-cheque')
            ->call('save')
            ->assertHasErrors(['cheque_date', 'company_id', 'department_id', 'cheque_number', 'amount', 'deposit_account_id'])
            ->assertHasNoErrors(['issuing_branch']);

        Volt::test('cheques.register-cheque')
            ->dispatch('cheque-create', companyId: $this->company->id, departmentId: $this->dept->id)
            ->assertSet('company_id', $this->company->id)
            ->assertSet('deposit_account_id', $this->bank->id) // the company's only bank is preselected
            ->set('cheque_date', now()->subDays(10)->toDateString())
            ->set('issuing_branch', '0423')
            ->set('cheque_number', '77001')
            ->set('amount', '60000')
            ->set('bank_charges', '100')
            ->assertSee('Settled')
            ->assertSee('59,900.00')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('transaction-updated');

        $cheque = Cheque::firstOrFail();
        $this->assertSame(now()->toDateString(), $cheque->date->toDateString(), 'deposited the day it is entered');
        $this->assertSame('0423', $cheque->issuing_branch);
        $this->assertNull($cheque->issuing_bank);
        $this->assertMoney('59900.00', $this->bank);
        $this->assertSame('-60000.00', Balances::departmentBalance($this->dept->id));

        // An edit keeps the original deposit date.
        $cheque->forceFill(['date' => now()->subDays(2)->toDateString()])->saveQuietly();
        Volt::test('cheques.register-cheque')
            ->dispatch('cheque-edit', id: $cheque->id)
            ->assertSet('deposit_account_id', $this->bank->id)
            ->assertSee('Deposit date: '.now()->subDays(2)->format('d M Y'))
            ->set('bank_charges', '')
            ->call('save')->assertHasNoErrors();
        $this->assertMoney('60000.00', $this->bank);
        $this->assertSame(now()->subDays(2)->toDateString(), $cheque->fresh()->date->toDateString());
    }

    public function test_cheque_deposit_page_builds_a_table_and_saves_it_together(): void
    {
        $this->get(route('cheques.create', ['company' => $this->company->id, 'department' => $this->dept->id]))
            ->assertOk()->assertSee('Batch details')->assertSee('Cheque details')->assertSee('Add to table')->assertDontSee('Drawn on');

        $page = Volt::test('cheques.register-cheque', ['asPage' => true, 'company' => (string) $this->company->id, 'department' => (string) $this->dept->id]);

        // Prefilled from the URL; the modal events are ignored by the page form.
        $page->assertSet('company_id', $this->company->id)
            ->assertSet('department_id', $this->dept->id)
            ->assertSet('deposit_account_id', $this->bank->id)
            ->dispatch('cheque-create')->assertSet('company_id', $this->company->id)
            ->assertNotDispatched('modal-show');

        $fill = function ($c, string $number, string $amount, array $extra = []) {
            $c->set('cheque_date', now()->subDays(5)->toDateString())
                ->set('company_id', $this->company->id)
                ->set('deposit_account_id', $this->bank->id)
                ->set('department_id', $this->dept->id)
                ->set('cheque_number', $number)
                ->set('amount', $amount);
            foreach ($extra as $k => $v) {
                $c->set($k, $v);
            }

            return $c;
        };

        // Add to table: nothing is saved yet; the cheque details clear, the batch details stay.
        $fill($page, '88001', '40000', ['bank_charges' => '50', 'notes' => 'Bill 12', 'deposit_reference' => 'S-1', 'issuing_branch' => '0423'])->call('addRow')
            ->assertHasNoErrors()
            ->assertSet('cheque_number', '')->assertSet('amount', '')->assertSet('bank_charges', '')->assertSet('notes', '')->assertSet('deposit_reference', '')
            ->assertSet('cheque_date', now()->subDays(5)->toDateString())->assertSet('company_id', $this->company->id)
            ->assertSet('deposit_account_id', $this->bank->id)->assertSet('issuing_branch', '0423')->assertSet('department_id', $this->dept->id)
            ->assertCount('rows', 1)
            ->assertSee('#88001')->assertSee('39,950.00');
        $this->assertSame(0, Cheque::count());

        // Editing a row loads both cards; Cancel brings the batch details back.
        $other = $this->makeDepartment('Police Dept');
        $page->set('cheque_date', now()->subDays(2)->toDateString())->set('department_id', $other->id)->set('issuing_branch', '')
            ->call('editRow', 0)
            ->assertSet('cheque_date', now()->subDays(5)->toDateString())->assertSet('department_id', $this->dept->id)
            ->assertSet('issuing_branch', '0423')->assertSet('cheque_number', '88001')
            ->call('cancelEdit')
            ->assertSet('editingRow', null)->assertSet('cheque_number', '')
            ->assertSet('cheque_date', now()->subDays(2)->toDateString())->assertSet('department_id', $other->id)->assertSet('issuing_branch', '');

        // A number already in the table is refused.
        $fill($page, '88001', '100')->call('addRow')->assertHasErrors('cheque_number')->assertCount('rows', 1);

        $fill($page, '88002', '10000')->call('addRow')->assertHasNoErrors()->assertCount('rows', 2)
            ->assertSee('50,000.00'); // table total

        // Edit a row in the form, then update it; the batch details return afterwards.
        $page->set('department_id', $other->id)
            ->call('editRow', 1)->assertSet('cheque_number', '88002')->assertSet('editingRow', 1)->assertSet('department_id', $this->dept->id)
            ->assertSee('Update row')
            ->set('amount', '12000')->call('addRow')->assertHasNoErrors()
            ->assertSet('editingRow', null)->assertSet('rows.1.amount', '12000.00')->assertSet('rows.1.department_id', $this->dept->id)
            ->assertSet('department_id', $other->id)->assertCount('rows', 2);

        // Remove a row.
        $fill($page, '88003', '700')->call('addRow')->assertCount('rows', 3);
        $page->call('removeRow', 2)->assertCount('rows', 2)->assertDontSee('#88003');

        // Final save: both deposited today; stay on the page with an empty table and the batch details kept.
        $page->call('saveAll')->assertHasNoErrors()->assertNoRedirect()
            ->assertDispatched('toast', type: 'success')->assertDispatched('transaction-updated')
            ->assertCount('rows', 0)
            ->assertSet('company_id', $this->company->id)->assertSet('department_id', $this->dept->id) // as last filled for 88003
            ->assertSet('cheque_date', now()->subDays(5)->toDateString());

        $this->assertSame(['88001', '88002'], Cheque::orderBy('cheque_number')->pluck('cheque_number')->all());
        $this->assertSame([now()->toDateString()], Cheque::pluck('date')->map->toDateString()->unique()->values()->all());
        $this->assertMoney('51950.00', $this->bank);
    }

    public function test_cheque_deposit_page_opens_with_defaults(): void
    {
        // Alphabetically first company / department; the company's first bank; today's date.
        $first = $this->makeCompany('Aaa Enterprises');
        $this->makeBank($first, 'UBL Main');
        $firstBank = $this->makeBank($first, 'Askari Current');
        $firstDept = $this->makeDepartment('Agriculture Dept');

        $page = Volt::test('cheques.register-cheque', ['asPage' => true])
            ->assertSet('cheque_date', now()->toDateString())
            ->assertSet('company_id', $first->id)
            ->assertSet('deposit_account_id', $firstBank->id)
            ->assertSet('department_id', $firstDept->id);

        // Switching company picks that company's first bank.
        $page->set('company_id', $this->company->id)->assertSet('deposit_account_id', $this->bank->id);

        // The modal still starts empty and only preselects a company's sole bank.
        Volt::test('cheques.register-cheque')->dispatch('cheque-create')
            ->assertSet('company_id', null)->assertSet('cheque_date', '')
            ->set('company_id', $first->id)->assertSet('deposit_account_id', null);
    }

    public function test_cheque_batch_is_all_or_nothing(): void
    {
        $page = Volt::test('cheques.register-cheque', ['asPage' => true]);

        foreach (['91001' => '1000', '91002' => '2000'] as $number => $amount) {
            $page->set('cheque_date', now()->subDay()->toDateString())->set('company_id', $this->company->id)
                ->set('deposit_account_id', $this->bank->id)->set('department_id', $this->dept->id)
                ->set('cheque_number', (string) $number)->set('amount', $amount)
                ->call('addRow')->assertHasNoErrors();
        }

        // Someone enters 91002 elsewhere before the batch is saved.
        $this->cheque(['cheque_number' => '91002']);

        $page->call('saveAll')
            ->assertNoRedirect()
            ->assertSet('rowErrors', [1 => 'This cheque number is already entered.'])
            ->assertDispatched('toast', type: 'error')
            ->assertSee('This cheque number is already entered.');

        $this->assertSame(['91002'], Cheque::pluck('cheque_number')->all(), 'nothing from the batch was saved');

        // Fix the row and save again.
        $page->call('editRow', 1)->set('cheque_number', '91003')->call('addRow')->assertHasNoErrors()
            ->assertSet('rowErrors', [])
            ->call('saveAll')->assertNoRedirect()->assertCount('rows', 0)->assertSet('rowErrors', []);
        $this->assertSame(3, Cheque::count());

        // Saving an empty table does nothing.
        Volt::test('cheques.register-cheque', ['asPage' => true])->call('saveAll')->assertDispatched('toast', type: 'error')->assertNoRedirect();
    }

    public function test_cheque_form_rejects_duplicates_and_expired_cheques(): void
    {
        $this->cheque(['cheque_number' => '555', 'issuing_branch' => '0001']);

        $form = fn () => Volt::test('cheques.register-cheque')
            ->dispatch('cheque-create', companyId: $this->company->id, departmentId: $this->dept->id)
            ->set('cheque_date', now()->subDay()->toDateString())->set('amount', '10');

        // Duplicate by number alone, whatever the branch.
        $form()->set('cheque_number', '555')->set('issuing_branch', '0002')->call('save')->assertHasErrors(['cheque_number' => 'unique']);

        $form()->set('cheque_number', '556')->set('cheque_date', now()->subMonths(7)->toDateString())
            ->assertSee('Expired on')
            ->call('save')->assertHasErrors(['cheque_date'])->assertDispatched('toast', type: 'error');

        $form()->set('cheque_number', '557')->set('cheque_date', now()->addDay()->toDateString())
            ->call('save')->assertHasErrors(['cheque_date' => 'before_or_equal']);

        $this->assertSame(1, Cheque::count());
    }

    public function test_cheque_list_and_delete(): void
    {
        $cheque = $this->fundBank('5000');

        Volt::test('cheques.list')
            ->assertSee('#'.$cheque->cheque_number)
            ->assertSee('HBL Current')
            ->call('delete', $cheque->id)
            ->assertDispatched('transaction-updated');

        $this->assertSoftDeleted($cheque);
        $this->assertMoney('0.00', $this->bank);
    }

    public function test_payment_form_handles_all_three_methods(): void
    {
        $this->fundBank('100000');
        app(\App\Services\TransferService::class)->save(null, ['from_account_id' => $this->bank->id, 'to_account_id' => $this->cash->id, 'amount' => '20000', 'date' => now()->toDateString()]);

        $base = fn (string $method) => Volt::test('payments.create')
            ->dispatch('payment-create', companyId: $this->company->id, departmentId: $this->dept->id, method: $method)
            ->set('date', now()->toDateString());

        $base('cash')->set('amount', '5000')->set('received_by', 'Ali')->call('save')->assertHasNoErrors();
        $base('bank_transfer')->set('amount', '8000')->call('save')->assertHasErrors(['account_id']);
        $base('bank_transfer')->set('account_id', $this->bank->id)->set('amount', '8000')->set('reference', 'IBFT-9')->call('save')->assertHasNoErrors();
        $base('goods')->set('amount', '3000')->call('save')->assertHasErrors(['supplier_id', 'item_description', 'account_id']);
        $base('goods')->set('supplier_id', $this->supplier->id)->set('on_credit', '1')->set('item_description', 'Fans')->set('amount', '3000')->call('save')->assertHasNoErrors();

        $this->assertSame(3, Payment::count());
        $this->assertMoney('15000.00', $this->cash);
        $this->assertSame('3000.00', Balances::supplierOwed($this->supplier->id));
        $this->assertSame('-84000.00', Balances::departmentBalance($this->dept->id));
        $this->assertStringContainsString('Bank transfer to Health Dept from HBL Current — ref IBFT-9', Payment::where('method', 'bank_transfer')->first()->describe());
    }

    public function test_overspending_shows_the_business_error(): void
    {
        Volt::test('payments.create')
            ->dispatch('payment-create', companyId: $this->company->id, departmentId: $this->dept->id, method: 'cash')
            ->set('amount', '1')
            ->call('save')
            ->assertHasErrors(['amount'])
            ->assertDispatched('toast', type: 'error');

        $this->assertSame(0, Payment::count());
    }

    public function test_payment_edit_and_inline_department(): void
    {
        $this->fundBank('10000');
        $p = $this->pay(['amount' => '1000']);

        Volt::test('payments.create')
            ->dispatch('payment-edit', id: $p->id)
            ->assertSet('method', 'bank_transfer')
            ->set('addingDepartment', true)->set('newDepartment', 'Water Board')->call('addDepartment')
            ->set('amount', '2500')
            ->call('save')
            ->assertHasNoErrors();

        $p->refresh();
        $this->assertSame('2500.00', (string) $p->amount);
        $this->assertSame('Water Board', $p->department->name);
        $this->assertMoney('7500.00', $this->bank);
    }

    public function test_supplier_payments_expenses_and_transfers(): void
    {
        $this->fundBank('50000');
        $this->pay(['method' => 'goods', 'supplier_id' => $this->supplier->id, 'on_credit' => true, 'account_id' => null, 'amount' => '9000', 'item_description' => 'Desks']);

        Volt::test('supplier-payments.manage')
            ->dispatch('supplier-payment-create', companyId: $this->company->id, supplierId: $this->supplier->id)
            ->set('account_id', $this->bank->id)
            ->call('payAll')->assertSet('amount', '9000.00')
            ->call('save')->assertHasNoErrors();
        $this->assertSame('0.00', Balances::supplierOwed($this->supplier->id));

        Volt::test('expenses.manage')
            ->dispatch('expense-create', companyId: $this->company->id)
            ->set('addingCategory', true)->set('newCategory', 'Fuel')->call('addCategory')
            ->set('account_id', $this->bank->id)->set('amount', '1500')->set('description', 'Diesel')
            ->call('save')->assertHasNoErrors();
        $this->assertSame(1, Expense::count());

        $other = $this->makeCompany('Zamzam Enterprises');
        $otherBank = $this->makeBank($other);
        Volt::test('transfers.manage')
            ->dispatch('transfer-create', companyId: $this->company->id, mode: 'intercompany')
            ->set('from_account_id', $this->bank->id)
            ->set('to_company_id', $other->id)
            ->set('to_account_id', $otherBank->id)
            ->set('amount', '10000')
            ->call('save')->assertHasNoErrors();
        $this->assertSame('10000.00', Balances::owedBetween($this->company->id, $other->id));

        Volt::test('transfers.manage')
            ->dispatch('transfer-create', companyId: $other->id, mode: 'intercompany')
            ->set('to_company_id', $this->company->id)
            ->assertSee('Zamzam Enterprises owes Al-Noor Traders'); // shown from the sender's side

        $this->assertMoney('29500.00', $this->bank);
        $this->assertSame(1, Transfer::count());
        $this->assertSame(1, SupplierPayment::count());
    }

    public function test_close_deal_from_the_modal(): void
    {
        $this->fundBank('50000');
        $this->pay(['amount' => '42000']);

        Volt::test('departments.close-deal')
            ->dispatch('deal-close', companyId: $this->company->id, departmentId: $this->dept->id)
            ->assertSee('8,000.00 profit')
            ->call('save')->assertHasNoErrors();

        $this->assertSame('8000.00', (string) DealClosing::first()->amount);

        Volt::test('departments.closings', ['departmentId' => $this->dept->id])
            ->assertSee('Profit')
            ->call('delete', DealClosing::first()->id);
        $this->assertSame('-8000.00', Balances::departmentBalance($this->dept->id));
    }

    public function test_companies_accounts_departments_suppliers_and_openings(): void
    {
        Volt::test('companies.list')
            ->call('create')->set('name', 'Crescent Supplies')->set('cash_opening', '12000')
            ->call('save')->assertHasNoErrors();
        $crescent = Company::where('name', 'Crescent Supplies')->firstOrFail();
        $this->assertMoney('12000.00', $crescent->cashAccount);

        Volt::test('accounts.manage')
            ->dispatch('account-create', companyId: $crescent->id)
            ->set('name', 'Meezan Current')->set('bank_name', 'Meezan Bank')->set('opening_balance', '3000')
            ->call('save')->assertHasNoErrors();
        $this->assertSame('3000.00', Balances::money($crescent->id)['bank']);

        Volt::test('departments.list')->call('create')->set('name', 'Irrigation Dept')->call('save')->assertHasNoErrors();
        Volt::test('suppliers.list')->call('create')->set('name', 'Hardware Hub')->call('save')->assertHasNoErrors();

        Volt::test('opening-balances.manage')
            ->call('create', 'department')
            ->set('company_id', $crescent->id)->set('department_id', Department::where('name', 'Irrigation Dept')->value('id'))
            ->set('direction', 'held')->set('amount', '4000')
            ->call('save')->assertHasNoErrors();
        $this->assertSame('-4000.00', (string) OpeningBalance::first()->amount);

        Volt::test('opening-balances.manage')
            ->call('create', 'supplier')
            ->set('company_id', $crescent->id)->set('supplier_id', Supplier::where('name', 'Hardware Hub')->value('id'))->set('amount', '2500')
            ->call('save')->assertHasNoErrors();
        $this->assertSame('2500.00', Balances::supplierOwed(Supplier::where('name', 'Hardware Hub')->value('id')));

        Volt::test('companies.list')->assertSee('Crescent Supplies')->assertSee('12,000.00')->assertSee('3,000.00');
        Volt::test('departments.list')->set('filter', 'held')->assertSee('Irrigation Dept')->assertSee('4,000.00');
        Volt::test('suppliers.list')->set('filter', 'owed')->assertSee('Hardware Hub')->assertSee('2,500.00');
    }

    public function test_statements_running_balances(): void
    {
        $this->fundBank('30000');                                    // dept −30,000 (cheque)
        $this->pay(['amount' => '12000', 'date' => now()->toDateString()]);   // dept −18,000

        $s = app(StatementService::class)->build('department', $this->dept->id);
        $this->assertSame(['-30000.00', '-18000.00'], array_column($s['rows'], 'balance'));
        $this->assertSame('-18000.00', $s['closing']);

        $bank = app(StatementService::class)->build('account', $this->bank->id);
        $this->assertSame('18000.00', $bank['closing']);

        $company = app(StatementService::class)->build('company', $this->company->id);
        $this->assertCount(2, $company['rows'], 'cheque deposit, payment');
        $this->assertSame(['30000.00', null], array_column($company['rows'], 'debit'));
        $this->assertSame('18000.00', $company['closing']);

        $filtered = app(StatementService::class)->build('department', $this->dept->id, null, now()->toDateString());
        $this->assertSame('-30000.00', $filtered['opening']);

        Volt::test('statements.ledger', ['kind' => 'department', 'subjectId' => $this->dept->id])
            ->assertSee('Spent for them')->assertSee('18,000.00')
            ->call('preset', 'month')->assertSet('from', now()->startOfMonth()->toDateString());
    }

    public function test_dashboard_and_journal(): void
    {
        $this->fundBank('25000');

        Volt::test('dashboard.overview-metrics')->assertSee('25,000.00')
            ->set('company', $this->company->id)->assertDispatched('dashboard-company');
        Volt::test('dashboard.charts')->assertOk()->dispatch('dashboard-company', company: $this->company->id)->assertDispatched('charts-refresh');
        Volt::test('dashboard.attention')->assertSee('Latest cheques')->assertSee('25,000.00');

        Volt::test('transactions.datatable')
            ->assertSee('deposited into HBL Current')
            ->set('type', 'cheque_deposit')->assertSee('deposited')
            ->set('department', $this->dept->id)->assertSee('Cheque');
        Volt::test('transactions.datatable')->call('exportCsv')->assertOk();
    }
}
