<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Taxes paid on bank payments (department bank transfers, goods paid from a bank, supplier bank
 * payments). They come out of the same bank on top of the payment and are the company's cost:
 * each one posts its own journal transaction  Dr Tax (tax_id) / Cr the bank (or the agent's bank).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // The taxes on one payment (a department payment or a supplier payment).
        Schema::create('payment_taxes', function (Blueprint $table) {
            $table->id();
            $table->morphs('taxable');
            $table->foreignId('tax_id')->constrained()->restrictOnDelete();
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });

        Schema::table('journal_ledger_entries', function (Blueprint $table) {
            $table->foreignId('tax_id')->nullable()->after('expense_category_id')->constrained()->nullOnDelete();
            $table->index(['ledger_account', 'tax_id']);
        });
    }

    public function down(): void
    {
        Schema::table('journal_ledger_entries', function (Blueprint $table) {
            $table->dropIndex(['ledger_account', 'tax_id']);
            $table->dropConstrainedForeignId('tax_id');
        });
        Schema::dropIfExists('payment_taxes');
        Schema::dropIfExists('taxes');
    }
};
