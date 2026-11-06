<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\BankAccount;
use App\Models\User;
use App\Services\MasterDataService;
use Illuminate\Database\Seeder;

/**
 * Minimal production-safe setup: the first administrator and the Cash Vault.
 * Run DemoDataSeeder as well for sample companies, cheques and payouts.
 *
 * Local development login (change the password after first sign-in):
 *   email:    admin@ams.test
 *   password: password
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@ams.test'],
            ['name' => 'System Administrator', 'password' => 'password', 'role' => UserRole::Admin, 'is_active' => true, 'email_verified_at' => now()]
        );

        auth()->login($admin); // so opening-balance postings and audit rows are attributed

        if (! BankAccount::vault()) {
            app(MasterDataService::class)->saveBankAccount(null, [
                'name' => 'Cash Vault', 'type' => 'cash', 'opening_balance' => 0, 'is_active' => true,
            ]);
        }

        auth()->logout();
    }
}
