<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The cheque form no longer asks for the bank a cheque is drawn on; duplicates are now
 * identified by the cheque number alone. Existing values are kept.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cheques', function (Blueprint $table) {
            $table->dropIndex(['issuing_bank', 'cheque_number']);
        });

        Schema::table('cheques', function (Blueprint $table) {
            $table->string('issuing_bank')->nullable()->change();
            $table->index('cheque_number');
        });
    }

    public function down(): void
    {
        Schema::table('cheques', function (Blueprint $table) {
            $table->dropIndex(['cheque_number']);
        });

        Schema::table('cheques', function (Blueprint $table) {
            $table->string('issuing_bank')->nullable(false)->default('')->change();
            $table->index(['issuing_bank', 'cheque_number']);
        });
    }
};
