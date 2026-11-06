<?php

namespace Tests\Concerns;

use App\Enums\ClearingMethod;
use App\Models\BankAccount;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\CompanyBankAccount;
use App\Models\User;
use App\Models\Vendor;
use App\Services\ChequeService;
use App\Services\MasterDataService;

/**
 * Helpers that build a realistic starting point through the real services,
 * so every fixture is also posted to the journal.
 */
trait BuildsLedgerFixtures
{
    protected User $admin;

    protected User $staff;

    protected BankAccount $bank;

    protected BankAccount $vault;

    protected Company $company;

    protected function setUpLedger(): void
    {
        $this->admin = User::factory()->admin()->create(['name' => 'Admin User']);
        $this->staff = User::factory()->create(['name' => 'Staff User']);
        $this->actingAs($this->admin);

        $svc = app(MasterDataService::class);
        $this->bank = $svc->saveBankAccount(null, ['name' => 'HBL Main', 'type' => 'bank', 'bank_name' => 'HBL', 'opening_balance' => 0, 'is_active' => true]);
        $this->vault = $svc->saveBankAccount(null, ['name' => 'Cash Vault', 'type' => 'cash', 'opening_balance' => 0, 'is_active' => true]);
        $this->company = $svc->saveCompany(null, ['name' => 'Acme Traders', 'is_active' => true]);
    }

    protected function makeCompany(string $name = 'Beta Supplies', array $extra = []): Company
    {
        return app(MasterDataService::class)->saveCompany(null, array_merge(['name' => $name, 'is_active' => true], $extra));
    }

    protected function companyAccount(?Company $company = null, string $number = '0001'): CompanyBankAccount
    {
        return ($company ?? $this->company)->bankAccounts()->create([
            'bank_name' => 'MCB', 'account_title' => 'Acme', 'account_number' => $number, 'is_active' => true,
        ]);
    }

    protected function vendor(string $name = 'Office Mart'): Vendor
    {
        return Vendor::create(['name' => $name, 'is_active' => true]);
    }

    protected function registerCheque(array $overrides = [], ?User $by = null): Cheque
    {
        static $n = 1000;

        return app(ChequeService::class)->register(array_merge([
            'company_id' => $this->company->id,
            'government_department_id' => null,
            'cheque_number' => (string) $n++,
            'issuing_bank' => 'National Bank',
            'issuing_branch' => 'Main',
            'amount' => '100000',
            'cheque_date' => now()->subDays(2)->toDateString(),
            'received_date' => now()->subDay()->toDateString(),
        ], $overrides), $by ?? $this->admin);
    }

    protected function clearData(array $overrides = []): array
    {
        return array_merge([
            'clearing_method' => ClearingMethod::Deposit->value,
            'cleared_into_account_id' => $this->bank->id,
            'cleared_date' => now()->toDateString(),
            'commission_type' => null,
            'commission_rate' => null,
            'bank_charges' => 0,
        ], $overrides);
    }

    /** Register and clear a cheque as admin; returns the cleared cheque. */
    protected function clearedCheque(string $amount = '100000', array $clear = []): Cheque
    {
        $cheque = $this->registerCheque(['amount' => $amount]);

        return app(ChequeService::class)->performClear($cheque, $this->clearData($clear), $this->admin);
    }

    protected function assertBalances(?string $payable = null, ?string $receivable = null, ?string $bank = null, ?string $vault = null, ?Company $company = null): void
    {
        $company = ($company ?? $this->company)->fresh();
        if ($payable !== null) {
            $this->assertSame($payable, (string) $company->payable_balance, 'payable');
        }
        if ($receivable !== null) {
            $this->assertSame($receivable, (string) $company->receivable_balance, 'receivable');
        }
        if ($bank !== null) {
            $this->assertSame($bank, (string) $this->bank->fresh()->current_balance, 'bank');
        }
        if ($vault !== null) {
            $this->assertSame($vault, (string) $this->vault->fresh()->current_balance, 'vault');
        }
    }
}
