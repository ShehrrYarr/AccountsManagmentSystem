<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Double-entry journal.
 *
 *  transactions             one row per business event (what the datatable lists)
 *  journal_ledger_entries   balanced debit/credit lines of each transaction
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->string('type', 30)->index();
            $table->nullableMorphs('source'); // Cheque, Disbursement, InternalTransfer, CompanyAdjustment, Company, BankAccount
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('source_account_id')->nullable()->constrained('bank_accounts')->nullOnDelete();
            $table->foreignId('destination_account_id')->nullable()->constrained('bank_accounts')->nullOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('cheque_number', 50)->nullable()->index();
            $table->string('description');
            $table->text('notes')->nullable();
            $table->string('status', 10)->default('posted')->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('voided_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('voided_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'date']);
            $table->index(['company_id', 'date']);
        });

        Schema::create('journal_ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->string('ledger_account', 30)->index();
            $table->foreignId('bank_account_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);
            $table->string('memo')->nullable();
            $table->timestamps();

            $table->index(['ledger_account', 'company_id']);
            $table->index(['ledger_account', 'bank_account_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_ledger_entries');
        Schema::dropIfExists('transactions');
    }
};
