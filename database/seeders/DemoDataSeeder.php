<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Supplier;
use App\Models\User;
use App\Services\ChequeService;
use App\Services\DealService;
use App\Services\MasterDataService;
use App\Services\PaymentService;
use App\Services\TransferService;
use Illuminate\Database\Seeder;

/**
 * Sample data for the middle-man model, posted through the real services so the journal is
 * consistent:  php artisan db:seed --class=DemoDataSeeder
 *
 * Three of my companies, five government departments, three suppliers, about four months of
 * cheques, payments, purchases (paid and on credit), transfers, expenses and one closed deal.
 */
class DemoDataSeeder extends Seeder
{
    private int $chequeNo = 40211870;

    public function run(): void
    {
        $this->call(DatabaseSeeder::class);

        auth()->login(User::where('role', UserRole::Admin)->orderBy('id')->firstOrFail());

        $master = app(MasterDataService::class);
        $opening = now()->subDays(120)->toDateString();

        // ---------------------------------------------------------------- companies & accounts
        $noor = $master->saveCompany(null, ['name' => 'Al-Noor Traders', 'ntn' => '4217893-1', 'phone' => '0300-1234567', 'address' => 'Hall Road, Lahore', 'is_active' => true, 'cash_opening' => 150000, 'opening_date' => $opening]);
        $zamzam = $master->saveCompany(null, ['name' => 'Zamzam Enterprises', 'ntn' => '3520187-6', 'phone' => '0321-7654321', 'address' => 'GT Road, Gujranwala', 'is_active' => true, 'cash_opening' => 80000, 'opening_date' => $opening]);
        $crescent = $master->saveCompany(null, ['name' => 'Crescent Supplies', 'ntn' => '6110452-3', 'phone' => '0333-5551122', 'address' => 'Saddar, Rawalpindi', 'is_active' => true, 'cash_opening' => 50000, 'opening_date' => $opening]);

        $bank = fn (Company $c, string $name, string $bankName, string $number, int $amount) => $master->saveAccount(null, [
            'company_id' => $c->id, 'type' => 'bank', 'name' => $name, 'bank_name' => $bankName, 'branch' => 'Main Branch',
            'account_title' => $c->name, 'account_number' => $number, 'opening_balance' => $amount, 'opening_date' => $opening, 'is_active' => true,
        ]);

        $noorHbl = $bank($noor, 'HBL Current', 'HBL', '0012-7790-4410', 500000);
        $noorMcb = $bank($noor, 'MCB Business', 'MCB', '1450-0098-221', 250000);
        $zamzamUbl = $bank($zamzam, 'UBL Current', 'UBL', '2290-4471-889', 300000);
        $crescentMeezan = $bank($crescent, 'Meezan Current', 'Meezan Bank', '0102-5566-7781', 200000);

        $cash = fn (Company $c) => Account::where('company_id', $c->id)->cash()->first();

        // ---------------------------------------------------------------- customers & suppliers
        $dept = fn (string $name, string $code, string $city) => Department::firstOrCreate(['name' => $name], ['code' => $code, 'city' => $city, 'is_active' => true]);
        $health = $dept('District Health Office Lahore', 'LA4021', 'Lahore');
        $school = $dept('Govt Boys High School No. 1', 'LE1180', 'Lahore');
        $highways = $dept('Punjab Highways Division', 'GW7730', 'Gujranwala');
        $municipal = $dept('Municipal Committee Gujranwala', 'GW1002', 'Gujranwala');
        $agri = $dept('Agriculture Extension Office', 'RW3315', 'Rawalpindi');

        $supplier = fn (string $name, string $phone) => Supplier::firstOrCreate(['name' => $name], ['phone' => $phone, 'is_active' => true]);
        $furniture = $supplier('Al-Fatah Furniture', '042-35761234');
        $officeMart = $supplier('Office Mart', '042-37220011');
        $electronics = $supplier('City Electronics', '055-3841122');

        $deals = app(DealService::class);
        $deals->saveOpening(null, ['company_id' => $zamzam->id, 'supplier_id' => $electronics->id, 'amount' => 15000, 'date' => $opening, 'notes' => 'Old invoice carried over']);

        $cheques = app(ChequeService::class);
        $payments = app(PaymentService::class);
        $transfers = app(TransferService::class);
        $day = fn (int $ago) => now()->subDays($ago)->toDateString();

        // ---------------------------------------------------------------- Al-Noor ↔ Health Office: spent first, cheque later, deal closed
        $payments->savePayment(null, ['company_id' => $noor->id, 'department_id' => $health->id, 'method' => 'goods', 'supplier_id' => $furniture->id, 'on_credit' => true, 'amount' => 180000, 'date' => $day(90), 'item_description' => '30 office chairs and 6 desks', 'reference' => 'INV-2231']);
        $payments->savePayment(null, ['company_id' => $noor->id, 'department_id' => $health->id, 'method' => 'cash', 'amount' => 40000, 'date' => $day(85), 'received_by' => 'Dr. Imran (store officer)']);
        $cheques->save(null, $this->cheque($noor, $health, $noorHbl, 250000, $day(62), $day(58), 150, 'DS-88120'));
        $payments->saveSupplierPayment(null, ['company_id' => $noor->id, 'supplier_id' => $furniture->id, 'account_id' => $noorHbl->id, 'amount' => 120000, 'date' => $day(55), 'reference' => 'CHQ-00412']);
        $deals->close(null, ['company_id' => $noor->id, 'department_id' => $health->id, 'date' => $day(50), 'notes' => 'Furniture supply order complete']);

        // ---------------------------------------------------------------- Al-Noor ↔ School: cheque first, spending after
        $cheques->save(null, $this->cheque($noor, $school, $noorMcb, 120000, $day(42), $day(38)));
        $payments->savePayment(null, ['company_id' => $noor->id, 'department_id' => $school->id, 'method' => 'bank_transfer', 'account_id' => $noorMcb->id, 'amount' => 70000, 'date' => $day(30), 'reference' => 'IBFT-559021']);
        $payments->savePayment(null, ['company_id' => $noor->id, 'department_id' => $school->id, 'method' => 'goods', 'supplier_id' => $officeMart->id, 'account_id' => $noorHbl->id, 'amount' => 35000, 'date' => $day(25), 'item_description' => 'Stationery and 2 printers', 'reference' => 'OM-7781']);

        // ---------------------------------------------------------------- Zamzam ↔ Highways and Municipal Committee
        $transfers->save(null, ['from_account_id' => $noorHbl->id, 'to_account_id' => $zamzamUbl->id, 'amount' => 100000, 'date' => $day(68), 'reference' => 'IBFT-330017', 'notes' => 'Short-term support']);
        $payments->savePayment(null, ['company_id' => $zamzam->id, 'department_id' => $highways->id, 'method' => 'bank_transfer', 'account_id' => $zamzamUbl->id, 'amount' => 200000, 'date' => $day(66), 'reference' => 'IBFT-411290']);
        $payments->savePayment(null, ['company_id' => $zamzam->id, 'department_id' => $highways->id, 'method' => 'goods', 'supplier_id' => $electronics->id, 'on_credit' => true, 'amount' => 90000, 'date' => $day(64), 'item_description' => 'Traffic signal controllers (3)']);
        $cheques->save(null, $this->cheque($zamzam, $highways, $zamzamUbl, 320000, $day(22), $day(20), 200, 'DS-44107'));
        $payments->savePayment(null, ['company_id' => $zamzam->id, 'department_id' => $municipal->id, 'method' => 'cash', 'amount' => 25000, 'date' => $day(15), 'received_by' => 'Naveed (clerk)']);
        $transfers->save(null, ['from_account_id' => $zamzamUbl->id, 'to_account_id' => $cash($noor)->id, 'amount' => 40000, 'date' => $day(12), 'notes' => 'Part repayment']);
        $transfers->save(null, ['from_account_id' => $cash($zamzam)->id, 'to_account_id' => $zamzamUbl->id, 'amount' => 20000, 'date' => $day(10), 'reference' => 'Deposit slip 5521']);

        // ---------------------------------------------------------------- Crescent ↔ Agriculture
        $payments->savePayment(null, ['company_id' => $crescent->id, 'department_id' => $agri->id, 'method' => 'goods', 'supplier_id' => $officeMart->id, 'account_id' => $cash($crescent)->id, 'amount' => 30000, 'date' => $day(35), 'item_description' => 'Seed storage bins']);
        $cheques->save(null, $this->cheque($crescent, $agri, $crescentMeezan, 45000, $day(12), $day(10)));

        // ---------------------------------------------------------------- own transfers & expenses
        $transfers->save(null, ['from_account_id' => $noorHbl->id, 'to_account_id' => $cash($noor)->id, 'amount' => 50000, 'date' => $day(45), 'reference' => 'ATM']);
        $category = fn (string $name) => ExpenseCategory::where('name', $name)->value('id');
        $payments->saveExpense(null, ['company_id' => $noor->id, 'expense_category_id' => $category('Fuel'), 'account_id' => $cash($noor)->id, 'amount' => 8500, 'date' => $day(20), 'description' => 'Delivery van diesel']);
        $payments->saveExpense(null, ['company_id' => $zamzam->id, 'expense_category_id' => $category('Office rent'), 'account_id' => $zamzamUbl->id, 'amount' => 35000, 'date' => $day(5), 'description' => 'Office rent for the month']);
        $payments->saveExpense(null, ['company_id' => $crescent->id, 'expense_category_id' => $category('Utilities'), 'account_id' => $cash($crescent)->id, 'amount' => 6200, 'date' => $day(3), 'description' => 'Electricity bill']);

        auth()->logout();
    }

    private function cheque(Company $company, Department $department, Account $bank, int $amount, string $chequeDate, string $deposited, int $charges = 0, ?string $slip = null): array
    {
        return [
            'company_id' => $company->id,
            'department_id' => $department->id,
            'cheque_number' => (string) $this->chequeNo++,
            'issuing_bank' => 'National Bank of Pakistan',
            'issuing_branch' => 'AG Office Branch',
            'amount' => $amount,
            'cheque_date' => $chequeDate,
            'date' => $deposited,
            'deposit_account_id' => $bank->id,
            'bank_charges' => $charges,
            'deposit_reference' => $slip,
        ];
    }
}
