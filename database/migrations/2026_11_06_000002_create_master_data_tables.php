<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Companies (clients), their bank accounts, my own bank/cash accounts,
 * government departments and vendors.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('registration_no', 100)->nullable();
            $table->string('ntn', 50)->nullable()->comment('National Tax Number');
            $table->string('contact_person')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            // Opening figures carried over from before the system.
            $table->decimal('opening_payable', 15, 2)->default(0);
            $table->decimal('opening_receivable', 15, 2)->default(0);
            // Running balances (cache of the journal, kept in sync by LedgerService).
            $table->decimal('payable_balance', 15, 2)->default(0)->comment('What I owe the company');
            $table->decimal('receivable_balance', 15, 2)->default(0)->comment('What the company owes me');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name');
            $table->string('branch')->nullable();
            $table->string('account_title');
            $table->string('account_number', 50);
            $table->string('iban', 34)->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['company_id', 'account_number']);
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Display name, e.g. "HBL Main" or "Cash Vault"');
            $table->string('type', 10)->default('bank')->index();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_title')->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('iban', 34)->nullable();
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('government_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code', 50)->nullable();
            $table->string('city')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('contact_person')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('ntn', 50)->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('government_departments');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('company_bank_accounts');
        Schema::dropIfExists('companies');
    }
};
