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
            ->assertHasErrors(['company_id', 'department_id', 'cheque_number', 'issuing_bank', 'amount', 'deposit_account_id']);

        Volt::test('cheques.register-cheque')
            ->dispatch('cheque-create', companyId: $this->company->id, departmentId: $this->dept->id)
            ->assertSet('company_id', $this->company->id)
            ->assertSet('deposit_account_id', $this->bank->id) // the company's only bank is preselected
            ->set('cheque_number', '77001')
            ->set('issuing_bank', 'National Bank of Pakistan')
            ->set('amount', '60000')
            ->set('bank_charges', '100')
            ->assertSee('settled')
            ->assertSee('59,900.00')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('transaction-updated');

        $cheque = Cheque::firstOrFail();
        $this->assertSame(now()->toDateString(), $cheque->date->toDateString());
        $this->assertMoney('59900.00', $this->bank);
        $this->assertSame('-60000.00', Balances::departmentBalance($this->dept->id));

        Volt::test('cheques.register-cheque')
            ->dispatch('cheque-edit', id: $cheque->id)
            ->assertSet('deposit_account_id', $this->bank->id)
            ->set('bank_charges', '')
            ->call('save')->assertHasNoErrors();
        $this->assertMoney('60000.00', $this->bank);
    }

    public function test_cheque_form_rejects_duplicates_and_expired_cheques(): void
    {
        $this->cheque(['cheque_number' => '555', 'issuing_bank' => 'NBP']);

        $form = fn () => Volt::test('cheques.register-cheque')
            ->dispatch('cheque-create', companyId: $this->company->id, departmentId: $this->dept->id)
            ->set('issuing_bank', 'NBP')->set('amount', '10');

        $form()->set('cheque_number', '555')->call('save')->assertHasErrors(['cheque_number' => 'unique']);

        $form()->set('cheque_number', '556')->set('cheque_date', now()->subMonths(7)->toDateString())
            ->assertSee('Expired on')
            ->call('save')->assertHasErrors(['cheque_date'])->assertDispatched('toast', type: 'error');

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
