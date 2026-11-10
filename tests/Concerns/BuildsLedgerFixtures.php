<?php

namespace Tests\Concerns;

use App\Models\Account;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\User;
use App\Services\ChequeService;
use App\Services\MasterDataService;
use App\Services\PaymentService;

/**
 * Builds a realistic starting point through the real services, so every fixture is also
 * posted to the journal:
 *   Company "Al-Noor Traders" with Cash in hand and "HBL Current", department "Health Dept",
 *   supplier "Office Mart".
 */
trait BuildsLedgerFixtures
{
    protected User $admin;

    protected Company $company;

    protected Account $cash;

    protected Account $bank;

    protected Department $dept;

    protected Supplier $supplier;

    protected function setUpLedger(): void
    {
        $this->admin = User::factory()->admin()->create(['name' => 'Admin User']);
        $this->actingAs($this->admin);

        $this->company = $this->makeCompany('Al-Noor Traders');
        $this->cash = $this->company->cashAccount;
        $this->bank = $this->makeBank($this->company, 'HBL Current');
        $this->dept = Department::create(['name' => 'Health Dept', 'is_active' => true]);
        $this->supplier = Supplier::create(['name' => 'Office Mart', 'is_active' => true]);
    }

    protected function makeCompany(string $name, string $cashOpening = '0'): Company
    {
        return app(MasterDataService::class)->saveCompany(null, [
            'name' => $name, 'is_active' => true, 'cash_opening' => $cashOpening, 'opening_date' => now()->subMonth()->toDateString(),
        ]);
    }

    protected function makeBank(Company $company, string $name = 'MCB Current', string $opening = '0'): Account
    {
        return app(MasterDataService::class)->saveAccount(null, [
            'company_id' => $company->id, 'type' => 'bank', 'name' => $name, 'bank_name' => strtok($name, ' '),
            'opening_balance' => $opening, 'opening_date' => now()->subMonth()->toDateString(), 'is_active' => true,
        ]);
    }

    protected function makeDepartment(string $name = 'Education Dept'): Department
    {
        return Department::create(['name' => $name, 'is_active' => true]);
    }

    protected function category(string $name = 'Fuel'): ExpenseCategory
    {
        return ExpenseCategory::firstOrCreate(['name' => $name], ['is_active' => true]);
    }

    protected function receiveCheque(array $overrides = []): Cheque
    {
        static $n = 1000;

        return app(ChequeService::class)->save(null, array_merge([
            'company_id' => $this->company->id,
            'department_id' => $this->dept->id,
            'cheque_number' => (string) $n++,
            'issuing_bank' => 'National Bank',
            'issuing_branch' => 'Main',
            'amount' => '100000',
            'cheque_date' => now()->subDays(3)->toDateString(),
            'received_date' => now()->subDays(2)->toDateString(),
        ], $overrides), $this->admin);
    }

    protected function deposit(Cheque $cheque, array $overrides = []): Cheque
    {
        return app(ChequeService::class)->deposit($cheque, array_merge([
            'deposit_account_id' => $this->bank->id,
            'deposited_date' => now()->subDay()->toDateString(),
            'bank_charges' => 0,
        ], $overrides));
    }

    /** Receive and deposit a cheque so the bank has money. */
    protected function fundBank(string $amount = '100000', array $overrides = []): Cheque
    {
        return $this->deposit($this->receiveCheque(array_merge(['amount' => $amount], $overrides)));
    }

    protected function pay(array $overrides = []): Payment
    {
        return app(PaymentService::class)->savePayment(null, array_merge([
            'company_id' => $this->company->id,
            'department_id' => $this->dept->id,
            'method' => 'bank_transfer',
            'account_id' => $this->bank->id,
            'amount' => '10000',
            'date' => now()->toDateString(),
        ], $overrides));
    }

    protected function assertMoney(string $expected, Account $account, string $message = ''): void
    {
        $this->assertSame($expected, (string) $account->fresh()->current_balance, $message ?: $account->name);
    }
}
