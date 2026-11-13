<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Advances to agents and their returns are transfers. A return an agent records waits for the
 * admin: status pending → posted (approved) or rejected. Everything already saved is posted.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('status', 10)->default('posted')->after('notes')->index();
            $table->foreignId('decided_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->timestamp('decided_at')->nullable()->after('decided_by');
            $table->string('decision_note', 500)->nullable()->after('decided_at');
        });
    }

    public function down(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('decided_by');
            $table->dropColumn(['status', 'decided_at', 'decision_note']);
        });
    }
};
