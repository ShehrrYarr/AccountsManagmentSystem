<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Goods bought for a department: the quantity and the price of one, optional. They fill in the
 * amount on the form (which can still be changed by hand, e.g. for a discount).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('quantity', 15, 3)->nullable()->after('item_description');
            $table->decimal('unit_price', 15, 2)->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unit_price']);
        });
    }
};
