<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Source documents. Each one posts its own journal transactions through LedgerService.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Government cheques for a department, deposited into the same company's bank in one step.
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->string('cheque_number', 50);
            $table->string('issuing_bank');
            $table->string('issuing_branch')->nullable();
            $table->decimal('amount', 15, 2);
            $table->date('cheque_date');
            $table->date('date')->index()->comment('Deposit date (also the date it was received)');
            $table->foreignId('deposit_account_id')->constrained('accounts')->restrictOnDelete();
            $table->decimal('bank_charges', 15, 2)->default(0);
            $table->string('deposit_reference')->nullable();
            $table->string('scan_path')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['issuing_bank', 'cheque_number']);
            $table->index(['company_id', 'date']);
        });

        // Money spent for a department: cash handed over, bank transfer, or goods purchased.
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->string('method', 20)->index()->comment('cash | bank_transfer | goods');
            $table->foreignId('account_id')->nullable()->constrained('accounts')->restrictOnDelete()->comment('Null for goods bought on credit');
            $table->foreignId('supplier_id')->nullable()->constrained()->restrictOnDelete();
            $table->boolean('on_credit')->default(false);
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            $table->string('reference')->nullable();
            $table->string('received_by')->nullable();
            $table->text('item_description')->nullable();
            $table->string('receipt_path')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('supplier_id')->constrained()->restrictOnDelete();
            $table->foreignId('account_id')->constrained('accounts')->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Between two accounts of one company, or between two of my companies.
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_account_id')->constrained('accounts')->restrictOnDelete();
            $table->foreignId('to_account_id')->constrained('accounts')->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('expense_category_id')->constrained()->restrictOnDelete();
            $table->foreignId('account_id')->constrained('accounts')->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            $table->string('description');
            $table->string('reference')->nullable();
            $table->string('receipt_path')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Closing a deal with a department: the leftover balance becomes profit (or loss).
        Schema::create('deal_closings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->date('date')->index();
            $table->decimal('amount', 15, 2)->comment('Positive = profit, negative = loss');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Balances carried over from before the system, per company.
        Schema::create('opening_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->restrictOnDelete();
            $table->decimal('amount', 15, 2)->comment('Department: + owes me / − I hold. Supplier: + I owe them');
            $table->date('date');
            $table->string('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opening_balances');
        Schema::dropIfExists('deal_closings');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('transfers');
        Schema::dropIfExists('supplier_payments');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('cheques');
    }
};
