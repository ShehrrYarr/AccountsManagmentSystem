<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Supplier;
use App\Models\User;
use App\Services\ChequeApprovalService;
use App\Services\ChequeService;
use App\Services\DealService;
use App\Services\MasterDataService;
use App\Services\PaymentApprovalService;
use App\Services\PaymentService;
use App\Services\TransferService;
use Illuminate\Database\Seeder;

/**
 * Sample data for the middle-man model, posted through the real services so the journal is
 * consistent:  php artisan db:seed --class=DemoDataSeeder
 *
 * Three of my companies, five government departments, three suppliers, about four months of
 * cheques, payments, purchases (paid and on credit), transfers, expenses and one closed deal.
 * Cash is the admin's single cash in hand (with a cash opening per company). Two agents, each with
 * a cash in hand and a bank account, have received a few cheques; one has a change waiting for
 * approval. Demo agents sign in with the password "password".
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
        $noor = $master->saveCompany(null, ['name' => 'Al-Noor Traders', 'ntn' => '4217893-1', 'phone' => '0300-1234567', 'address' => 'Hall Road, Lahore', 'is_active' => true]);
        $zamzam = $master->saveCompany(null, ['name' => 'Zamzam Enterprises', 'ntn' => '3520187-6', 'phone' => '0321-7654321', 'address' => 'GT Road, Gujranwala', 'is_active' => true]);
        $crescent = $master->saveCompany(null, ['name' => 'Crescent Supplies', 'ntn' => '6110452-3', 'phone' => '0333-5551122', 'address' => 'Saddar, Rawalpindi', 'is_active' => true]);

        // The admin's cash in hand on the opening date: one pot that belongs to no company.
        $adminCash = Account::adminCash();
        app(DealService::class)->saveOpening(null, ['account_id' => $adminCash->id, 'amount' => 280000, 'date' => $opening]);

        $bank = fn (Company $c, string $name, string $bankName, string $number, int $amount) => $master->saveAccount(null, [
            'company_id' => $c->id, 'type' => 'bank', 'name' => $name, 'bank_name' => $bankName, 'branch' => 'Main Branch',
            'account_title' => $c->name, 'account_number' => $number, 'opening_balance' => $amount, 'opening_date' => $opening, 'is_active' => true,
        ]);

        $noorHbl = $bank($noor, 'HBL Current', 'HBL', '0012-7790-4410', 500000);
        $noorMcb = $bank($noor, 'MCB Business', 'MCB', '1450-0098-221', 250000);
        $zamzamUbl = $bank($zamzam, 'UBL Current', 'UBL', '2290-4471-889', 300000);
        $crescentMeezan = $bank($crescent, 'Meezan Current', 'Meezan Bank', '0102-5566-7781', 200000);

        $cash = fn () => $adminCash;

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
        $transfers->save(null, ['from_account_id' => $zamzamUbl->id, 'to_account_id' => $noorHbl->id, 'amount' => 40000, 'date' => $day(12), 'reference' => 'IBFT-330411', 'notes' => 'Part repayment']);
        $transfers->save(null, ['from_account_id' => $cash()->id, 'to_account_id' => $zamzamUbl->id, 'amount' => 20000, 'date' => $day(10), 'reference' => 'Deposit slip 5521']);

        // ---------------------------------------------------------------- Crescent ↔ Agriculture
        $payments->savePayment(null, ['company_id' => $crescent->id, 'department_id' => $agri->id, 'method' => 'goods', 'supplier_id' => $officeMart->id, 'account_id' => $crescentMeezan->id, 'amount' => 30000, 'date' => $day(35), 'item_description' => 'Seed storage bins']);
        $cheques->save(null, $this->cheque($crescent, $agri, $crescentMeezan, 45000, $day(12), $day(10)));

        // ---------------------------------------------------------------- own transfers & expenses
        $transfers->save(null, ['from_account_id' => $noorHbl->id, 'to_account_id' => $cash()->id, 'amount' => 50000, 'date' => $day(45), 'reference' => 'ATM']);
        $category = fn (string $name) => ExpenseCategory::where('name', $name)->value('id');
        $payments->saveExpense(null, ['company_id' => $noor->id, 'expense_category_id' => $category('Fuel'), 'account_id' => $cash()->id, 'amount' => 8500, 'date' => $day(20), 'description' => 'Delivery van diesel']);
        $payments->saveExpense(null, ['company_id' => $zamzam->id, 'expense_category_id' => $category('Office rent'), 'account_id' => $zamzamUbl->id, 'amount' => 35000, 'date' => $day(5), 'description' => 'Office rent for the month']);
        $payments->saveExpense(null, ['company_id' => $crescent->id, 'expense_category_id' => $category('Utilities'), 'account_id' => $cash()->id, 'amount' => 6200, 'date' => $day(3), 'description' => 'Electricity bill']);

        // ---------------------------------------------------------------- agents
        $admin = auth()->user();
        $agent = function (string $name, string $email, string $phone) use ($master, $admin) {
            $user = User::firstOrCreate(['email' => $email], [
                'name' => $name, 'phone' => $phone, 'password' => 'password', 'role' => UserRole::Agent, 'is_active' => true,
            ]);
            $master->ensureAgentCash($user, $admin);

            return $user;
        };
        $bilal = $agent('Bilal Ahmed', 'bilal.agent@ams.test', '0301-4445566');
        $usman = $agent('Usman Tariq', 'usman.agent@ams.test', '0312-7788990');

        // One bank account added by the admin, one by the agent himself.
        $bilalMeezan = $master->saveAccount(null, ['agent_id' => $bilal->id, 'type' => 'bank', 'name' => 'Meezan Savings', 'bank_name' => 'Meezan Bank', 'account_title' => $bilal->name, 'account_number' => '0211-0044-5521', 'is_active' => true], $admin);
        $master->saveAccount(null, ['agent_id' => $usman->id, 'type' => 'bank', 'name' => 'JazzCash Wallet', 'bank_name' => 'JazzCash', 'account_title' => $usman->name, 'account_number' => '0312-7788990', 'is_active' => true], $usman);

        $cheques->save(null, $this->cheque($noor, $health, $noorHbl, 95000, $day(8), $day(6), 100, 'DS-90021'), $bilal);
        $byUsman = $cheques->save(null, $this->cheque($zamzam, $municipal, $zamzamUbl, 60000, $day(5), $day(3)), $usman);
        $cheques->save(null, $this->cheque($crescent, $agri, $crescentMeezan, 38000, $day(2), $day(1)), $usman);

        // Usman typed the wrong amount and asked the admin to fix it.
        app(ChequeApprovalService::class)->requestEdit($byUsman, ['amount' => 66000] + $byUsman->only(['cheque_date', 'company_id', 'deposit_account_id', 'department_id', 'cheque_number']), $usman, 'Amount is 66,000 on the cheque, I typed 60,000');

        // Bilal got an advance from Al-Noor's bank and sent part of it back (waiting for approval).
        $transfers->save(null, ['from_account_id' => $noorHbl->id, 'to_account_id' => $bilalMeezan->id, 'amount' => 30000, 'date' => $day(4), 'reference' => 'IBFT-77120', 'notes' => 'For field expenses']);
        $transfers->requestReturn(['from_account_id' => $bilalMeezan->id, 'from_company_id' => $noor->id, 'to_account_id' => $cash()->id, 'amount' => 5000, 'date' => $day(1), 'notes' => 'Left over'], $bilal);

        // Agents pay departments by bank transfer from their own banks, for a company.
        $bilalPaid = $payments->savePayment(null, ['company_id' => $noor->id, 'department_id' => $health->id, 'method' => 'bank_transfer', 'account_id' => $bilalMeezan->id, 'amount' => 12000, 'date' => $day(2), 'item_description' => 'Lab test kits', 'reference' => 'IBFT-88310', 'received_by' => 'Dr. Imran (store officer)'], $bilal);
        $usmanWallet = Account::where('agent_id', $usman->id)->banks()->firstOrFail();
        $payments->savePayment(null, ['company_id' => $zamzam->id, 'department_id' => $municipal->id, 'method' => 'bank_transfer', 'account_id' => $usmanWallet->id, 'amount' => 8000, 'date' => $day(1), 'item_description' => 'Survey staff transport (paid from his own money)'], $usman);

        // Bilal asks to correct his payment's amount.
        app(PaymentApprovalService::class)->requestEdit($bilalPaid, ['amount' => 12500] + $bilalPaid->only(['date', 'company_id', 'account_id', 'department_id', 'item_description', 'reference', 'received_by', 'notes']), $bilal, 'Bank charged 500 on the transfer');

        auth()->logout();
    }

    private function cheque(Company $company, Department $department, Account $bank, int $amount, string $chequeDate, string $deposited, int $charges = 0, ?string $slip = null): array
    {
        return [
            'company_id' => $company->id,
            'department_id' => $department->id,
            'cheque_number' => (string) $this->chequeNo++,
            'issuing_branch' => '0423',
            'amount' => $amount,
            'cheque_date' => $chequeDate,
            'date' => $deposited,
            'deposit_account_id' => $bank->id,
            'bank_charges' => $charges,
            'deposit_reference' => $slip,
        ];
    }
}
