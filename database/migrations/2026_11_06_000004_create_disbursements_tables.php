<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Outflows to companies (cash payout, bank transfer, vendor purchase),
 * my own account-to-account transfers, and manual company adjustments.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->string('type', 20)->index();
            $table->foreignId('source_account_id')->constrained('bank_accounts')->restrictOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained()->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            $table->string('reference')->nullable();
            $table->string('received_by')->nullable()->comment('Company representative who collected cash');
            $table->text('item_description')->nullable();
            $table->string('receipt_path')->nullable();
            $table->text('notes')->nullable();
            $table->string('status', 20)->default('posted')->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Bank transfers can be split across several of the company's accounts.
        Schema::create('disbursement_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disbursement_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_bank_account_id')->constrained()->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('reference')->nullable()->comment('Bank transaction / IBFT ref');
            $table->timestamps();
        });

        Schema::create('internal_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_account_id')->constrained('bank_accounts')->restrictOnDelete();
            $table->foreignId('to_account_id')->constrained('bank_accounts')->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->string('kind', 30);
            $table->decimal('amount', 15, 2);
            $table->date('date')->index();
            // Optional: money actually moved into one of my accounts (receivable settlement).
            $table->foreignId('bank_account_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('reason');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_adjustments');
        Schema::dropIfExists('internal_transfers');
        Schema::dropIfExists('disbursement_lines');
        Schema::dropIfExists('disbursements');
    }
};
