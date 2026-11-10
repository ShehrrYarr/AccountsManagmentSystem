<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Double-entry journal.
 *
 *  transactions             one row per business event (what the journal screen lists)
 *  journal_ledger_entries   balanced debit/credit lines; every line belongs to one company
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->string('type', 30)->index();
            $table->nullableMorphs('source');
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('counterparty_company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete()->comment('Money left this account');
            $table->foreignId('to_account_id')->nullable()->constrained('accounts')->nullOnDelete()->comment('Money arrived here');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('reference', 100)->nullable()->index()->comment('Cheque number or payment reference');
            $table->string('description');
            $table->text('notes')->nullable();
            $table->string('status', 10)->default('posted')->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('voided_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('voided_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'date']);
        });

        Schema::create('journal_ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->string('ledger_account', 30);
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('counterparty_company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->foreignId('expense_category_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);
            $table->string('memo')->nullable();
            $table->timestamps();

            $table->index(['ledger_account', 'company_id']);
            $table->index(['ledger_account', 'account_id']);
            $table->index(['ledger_account', 'department_id']);
            $table->index(['ledger_account', 'supplier_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_ledger_entries');
        Schema::dropIfExists('transactions');
    }
};
