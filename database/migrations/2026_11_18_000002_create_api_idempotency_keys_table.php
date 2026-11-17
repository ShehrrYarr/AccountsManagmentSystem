<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The mobile app may send the same write twice (offline queue replays, flaky networks). Each
 * write carries an Idempotency-Key; the first successful response is stored here and replayed for
 * any repeat, so nothing is ever saved twice.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_idempotency_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('key', 100);
            $table->string('method', 10);
            $table->string('path', 255);
            $table->unsignedSmallInteger('status_code')->nullable()->comment('Null while the first request is still running');
            $table->longText('response')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_idempotency_keys');
    }
};
