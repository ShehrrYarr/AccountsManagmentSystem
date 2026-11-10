<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Minimal production-safe setup: a first administrator (only when there is none yet)
 * and the default expense categories. Run DemoDataSeeder as well for sample data.
 *
 * Local development login (change the password after first sign-in):
 *   email:    admin@ams.test
 *   password: password
 */
class DatabaseSeeder extends Seeder
{
    public const EXPENSE_CATEGORIES = ['Fuel', 'Office rent', 'Salaries', 'Utilities', 'Travel', 'Miscellaneous'];

    public function run(): void
    {
        if (User::where('role', UserRole::Admin)->doesntExist()) {
            User::create([
                'name' => 'System Administrator', 'email' => 'admin@ams.test', 'password' => 'password',
                'role' => UserRole::Admin, 'is_active' => true, 'email_verified_at' => now(),
            ]);
        }

        foreach (self::EXPENSE_CATEGORIES as $name) {
            ExpenseCategory::firstOrCreate(['name' => $name], ['is_active' => true]);
        }
    }
}
