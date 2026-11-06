<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('government_department_id')->nullable()->constrained()->nullOnDelete();

            // Stage 1: receipt
            $table->string('cheque_number', 50);
            $table->string('issuing_bank');
            $table->string('issuing_branch')->nullable();
            $table->decimal('amount', 15, 2);
            $table->date('cheque_date');
            $table->date('expiry_date')->comment('Cheque date + 6 months');
            $table->date('received_date');
            $table->string('scan_path')->nullable();
            $table->string('status', 20)->default('received')->index();
            $table->text('notes')->nullable();

            // Stage 2: clearing
            $table->string('clearing_method', 20)->nullable();
            $table->foreignId('cleared_into_account_id')->nullable()->constrained('bank_accounts')->restrictOnDelete();
            $table->date('cleared_date')->nullable();
            $table->string('commission_type', 10)->nullable();
            $table->decimal('commission_rate', 10, 4)->nullable()->comment('% or fixed Rs., per commission_type');
            $table->decimal('commission_amount', 15, 2)->default(0);
            $table->decimal('bank_charges', 15, 2)->default(0);
            $table->string('clearing_reference')->nullable()->comment('Deposit slip / bank ref');

            // Bounce / cancel
            $table->date('closed_date')->nullable();
            $table->string('closed_reason')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('cleared_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            // Uniqueness (bank + number, ignoring deleted rows) is enforced in validation.
            $table->index(['issuing_bank', 'cheque_number']);
            $table->index(['company_id', 'status']);
            $table->index('received_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cheques');
    }
};
