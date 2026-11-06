<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\GovernmentDepartment;
use App\Models\User;
use App\Models\Vendor;
use App\Services\AdjustmentService;
use App\Services\ChequeService;
use App\Services\DisbursementService;
use App\Services\InternalTransferService;
use App\Services\MasterDataService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Realistic sample data posted through the real services (so the journal is
 * consistent). Development only:  php artisan db:seed --class=DemoDataSeeder
 *
 * Demo staff login: staff@ams.test / password
 */
class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@ams.test')->firstOrFail();
        User::firstOrCreate(['email' => 'staff@ams.test'], [
            'name' => 'Bilal Ahmed', 'password' => 'password', 'role' => UserRole::Staff, 'is_active' => true, 'email_verified_at' => now(),
        ]);
        auth()->login($admin);

        $master = app(MasterDataService::class);
        $cheques = app(ChequeService::class);
        $payouts = app(DisbursementService::class);

        $vault = BankAccount::vault();
        $hbl = $master->saveBankAccount(null, ['name' => 'HBL Main', 'type' => 'bank', 'bank_name' => 'Habib Bank Limited', 'branch' => 'Gulberg, Lahore', 'account_title' => 'AMS Traders', 'account_number' => '0123-4567890-01', 'opening_balance' => 150000, 'is_active' => true]);
        $mcb = $master->saveBankAccount(null, ['name' => 'MCB Business', 'type' => 'bank', 'bank_name' => 'MCB Bank', 'branch' => 'Mall Road', 'account_title' => 'AMS Traders', 'account_number' => '9988-7766554', 'opening_balance' => 50000, 'is_active' => true]);

        $depts = collect(['Accountant General Punjab', 'District Accounts Office Lahore', 'AGPR Islamabad', 'Punjab Health Department'])
            ->map(fn ($n, $i) => GovernmentDepartment::firstOrCreate(['name' => $n], ['city' => ['Lahore', 'Lahore', 'Islamabad', 'Lahore'][$i], 'is_active' => true]));

        $vendors = collect(['Paper House', 'Al-Noor Hardware', 'TechZone Computers'])
            ->map(fn ($n) => Vendor::firstOrCreate(['name' => $n], ['is_active' => true]));

        $companies = collect([
            ['name' => 'Al-Habib Construction', 'contact_person' => 'Usman Khalid', 'phone' => '0300-1112233', 'ntn' => '1234567-8'],
            ['name' => 'Green Valley Suppliers', 'contact_person' => 'Ayesha Noor', 'phone' => '0321-4455667', 'ntn' => '7654321-0'],
            ['name' => 'Crescent Medical Traders', 'contact_person' => 'Dr. Farhan', 'phone' => '0333-9988776'],
            ['name' => 'Punjab Office Solutions', 'contact_person' => 'Kamran Ali', 'phone' => '0345-1239876', 'opening_payable' => 25000],
        ])->map(fn ($c) => $master->saveCompany(null, $c + ['is_active' => true]));

        foreach ($companies as $i => $company) {
            $company->bankAccounts()->create([
                'bank_name' => ['Meezan Bank', 'UBL', 'Allied Bank', 'Bank Alfalah'][$i], 'account_title' => $company->name,
                'account_number' => '10'.str_pad((string) ($i + 1), 8, '0', STR_PAD_LEFT), 'is_default' => true, 'is_active' => true,
            ]);
        }

        // Cheques over the last 8 months, most cleared, some still pending.
        $n = 4501;
        for ($m = 7; $m >= 0; $m--) {
            foreach ($companies as $i => $company) {
                if (($m + $i) % 3 === 0) {
                    continue;
                }
                $received = Carbon::now()->subMonths($m)->startOfMonth()->addDays(2 + $i * 3);
                if ($received->isFuture()) {
                    $received = now()->subDay();
                }
                $amount = [185000, 92000, 240000, 67500][$i] + $m * 7500;

                $cheque = $cheques->register([
                    'company_id' => $company->id,
                    'government_department_id' => $depts[$i]->id,
                    'cheque_number' => (string) $n++,
                    'issuing_bank' => 'National Bank of Pakistan',
                    'issuing_branch' => 'Treasury Branch',
                    'amount' => $amount,
                    'cheque_date' => $received->copy()->subDays(2)->toDateString(),
                    'received_date' => $received->toDateString(),
                ], $admin);

                if ($m === 0 && $i % 2 === 0) {
                    continue; // leave pending
                }

                $encash = ($n % 4) === 0;
                $cheques->performClear($cheque, [
                    'clearing_method' => $encash ? 'encashment' : 'deposit',
                    'cleared_into_account_id' => $i % 2 ? $mcb->id : $hbl->id,
                    'cleared_date' => $received->copy()->addDays(3)->min(now())->toDateString(),
                    'commission_type' => 'percent',
                    'commission_rate' => [2, 1.5, 2.5, 3][$i],
                    'bank_charges' => $encash ? 0 : 150,
                ], $admin);

                // Pay out most of it within the same month.
                $company->refresh();
                $payable = (float) $company->payable_balance;
                $date = $received->copy()->addDays(6)->min(now())->toDateString();
                $kind = ($m + $i) % 3;

                if ($kind === 1 && (float) $vault->fresh()->current_balance > 0) {
                    $amt = min(round($payable * 0.6), (float) $vault->fresh()->current_balance);
                    if ($amt > 0) {
                        $payouts->create(['company_id' => $company->id, 'type' => 'cash_payout', 'source_account_id' => $vault->id,
                            'amount' => $amt, 'date' => $date, 'received_by' => $company->contact_person], $admin);
                    }
                } elseif ($kind === 2) {
                    $src = $i % 2 ? $mcb : $hbl;
                    $amt = min(round($payable * 0.3), (float) $src->fresh()->current_balance);
                    if ($amt > 0) {
                        $payouts->create(['company_id' => $company->id, 'type' => 'vendor_purchase', 'source_account_id' => $src->id,
                            'vendor_id' => $vendors[$i % 3]->id, 'amount' => $amt, 'date' => $date, 'item_description' => 'Supplies for site / office'], $admin);
                    }
                } else {
                    $src = $i % 2 ? $mcb : $hbl;
                    $amt = min(round($payable * 0.7), (float) $src->fresh()->current_balance);
                    if ($amt > 0) {
                        $payouts->create(['company_id' => $company->id, 'type' => 'bank_transfer', 'source_account_id' => $src->id, 'date' => $date,
                            'lines' => [['company_bank_account_id' => $company->bankAccounts()->value('id'), 'amount' => $amt, 'reference' => 'IBFT'.random_int(100000, 999999)]]], $admin);
                    }
                }
            }
        }

        app(InternalTransferService::class)->create(['from_account_id' => $hbl->id, 'to_account_id' => $vault->id, 'amount' => 75000,
            'date' => now()->subDays(10)->toDateString(), 'reference' => 'Cash withdrawal', 'notes' => 'Float for cash payouts'], $admin);

        app(AdjustmentService::class)->create(['company_id' => $companies[1]->id, 'kind' => 'receivable_charge', 'amount' => 15000,
            'date' => now()->subDays(20)->toDateString(), 'reason' => 'Advance for transport, to be recovered'], $admin);

        auth()->logout();
    }
}
