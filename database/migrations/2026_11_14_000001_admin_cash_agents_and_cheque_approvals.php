<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Restructure of 2026-11-14:
 *
 *  - Companies no longer have a cash in hand. The ADMIN has one cash in hand (an account with
 *    no company and no agent). It is shared by every company: each journal line still carries
 *    the company it was for, so company and department ledgers keep working.
 *  - AGENTS (users with role "agent") have their own cash in hand and bank accounts
 *    (accounts.agent_id), stored for later use.
 *  - Transfers record the company on each side, since the admin's cash has no company.
 *  - Cash opening balances become opening_balances rows (company + the admin's cash).
 *  - Agents ask the admin to approve edits / deletes of saved cheques (cheque_change_requests).
 *
 * Existing data is converted: every company's cash in hand is merged into the admin's cash
 * (history, documents and balances), then the old company cash accounts are archived.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('role', 'staff')->update(['role' => 'agent']);

        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->change();
            $table->foreignId('agent_id')->nullable()->after('company_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->after('is_active')->constrained('users')->nullOnDelete();
            $table->unique(['agent_id', 'name']);
        });

        Schema::table('opening_balances', function (Blueprint $table) {
            $table->foreignId('account_id')->nullable()->after('supplier_id')->constrained('accounts')->restrictOnDelete()
                ->comment("The admin's cash in hand (cash opening for this company)");
        });

        Schema::table('transfers', function (Blueprint $table) {
            $table->foreignId('from_company_id')->nullable()->after('id')->constrained('companies')->restrictOnDelete();
            $table->foreignId('to_company_id')->nullable()->after('from_account_id')->constrained('companies')->restrictOnDelete();
        });

        Schema::create('cheque_change_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cheque_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by')->constrained('users')->restrictOnDelete();
            $table->string('action', 10)->comment('edit | delete');
            $table->json('changes')->nullable()->comment('Edit: the new field values');
            $table->text('reason')->nullable()->comment("Agent's note");
            $table->string('status', 10)->default('pending')->index()->comment('pending | approved | rejected');
            $table->foreignId('decided_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('decided_at')->nullable();
            $table->text('decision_note')->nullable();
            $table->timestamps();

            $table->index(['cheque_id', 'status']);
        });

        $this->convertCompanyCash();
    }

    private function convertCompanyCash(): void
    {
        $now = now();

        // Each transfer side's company, from its account (before any account changes).
        DB::statement('UPDATE transfers SET from_company_id = (SELECT company_id FROM accounts WHERE accounts.id = transfers.from_account_id),
                                            to_company_id = (SELECT company_id FROM accounts WHERE accounts.id = transfers.to_account_id)');

        $adminCash = DB::table('accounts')->insertGetId([
            'company_id' => null, 'agent_id' => null, 'type' => 'cash', 'name' => 'Cash in hand',
            'opening_balance' => 0, 'current_balance' => 0, 'is_active' => true,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $companyCash = DB::table('accounts')->where('type', 'cash')->whereNotNull('company_id')->get();

        foreach ($companyCash as $old) {
            // Its opening balance becomes a cash opening of that company, on the admin's cash.
            if ((float) $old->opening_balance != 0.0) {
                $openingId = DB::table('opening_balances')->insertGetId([
                    'company_id' => $old->company_id, 'account_id' => $adminCash,
                    'amount' => $old->opening_balance,
                    'date' => $old->opening_date ?? substr((string) $old->created_at, 0, 10),
                    'notes' => 'Moved from the company cash in hand',
                    'created_at' => $now, 'updated_at' => $now,
                ]);

                DB::table('transactions')->where('source_type', 'account')->where('source_id', $old->id)
                    ->update(['source_type' => 'opening_balance', 'source_id' => $openingId, 'description' => 'Opening balance — Cash in hand']);
            } else {
                // A zero opening may have left void rows only; point them nowhere useful.
                DB::table('transactions')->where('source_type', 'account')->where('source_id', $old->id)
                    ->update(['source_type' => null, 'source_id' => null]);
            }

            DB::table('journal_ledger_entries')->where('account_id', $old->id)->update(['account_id' => $adminCash]);
            DB::table('transactions')->where('account_id', $old->id)->update(['account_id' => $adminCash]);
            DB::table('transactions')->where('to_account_id', $old->id)->update(['to_account_id' => $adminCash]);
            DB::table('payments')->where('account_id', $old->id)->update(['account_id' => $adminCash]);
            DB::table('supplier_payments')->where('account_id', $old->id)->update(['account_id' => $adminCash]);
            DB::table('expenses')->where('account_id', $old->id)->update(['account_id' => $adminCash]);
            DB::table('transfers')->where('from_account_id', $old->id)->update(['from_account_id' => $adminCash]);
            DB::table('transfers')->where('to_account_id', $old->id)->update(['to_account_id' => $adminCash]);

            DB::table('accounts')->where('id', $old->id)->update([
                'opening_balance' => 0, 'current_balance' => 0, 'is_active' => false,
                'name' => mb_substr('Cash in hand (moved to admin) #'.$old->id, 0, 255),
                'deleted_at' => $old->deleted_at ?? $now, 'updated_at' => $now,
            ]);
        }

        // The admin's cash balance, rebuilt from the posted journal.
        $balance = DB::table('journal_ledger_entries')
            ->join('transactions', 'transactions.id', '=', 'journal_ledger_entries.transaction_id')
            ->where('transactions.status', 'posted')
            ->where('journal_ledger_entries.ledger_account', 'money')
            ->where('journal_ledger_entries.account_id', $adminCash)
            ->selectRaw('COALESCE(SUM(debit) - SUM(credit), 0) as b')->value('b');
        DB::table('accounts')->where('id', $adminCash)->update(['current_balance' => $balance]);
    }

    public function down(): void
    {
        throw new RuntimeException('This migration merges company cash into the admin cash and cannot be reversed; restore the database backup instead.');
    }
};
