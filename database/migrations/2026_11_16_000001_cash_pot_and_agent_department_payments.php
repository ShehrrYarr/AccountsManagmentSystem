<?php

use App\Models\Expense;
use App\Models\OpeningBalance;
use App\Models\Payment;
use App\Models\SupplierPayment;
use App\Models\Transfer;
use App\Services\LedgerService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Restructure of 2026-11-16:
 *
 *  - The admin's cash in hand becomes ONE POT that belongs to no company. Journal lines on it
 *    (and on whatever cash paid for) have no company; cash payments, cash expenses, cash
 *    supplier payments and the cash opening have no company either (and a deal can be closed for
 *    a department's no-company part). A company moving bank money
 *    into the cash shows it as "Moved to cash in hand" (ledger account cash_pot).
 *  - Agents pay departments by bank transfer from their own banks (payments.account_id is then
 *    the agent's account), and ask the admin to approve edits / deletes (payment_change_requests).
 *
 * Existing data is converted, not reloaded: the per-company cash openings merge into one, and
 * every document that used the cash is re-posted (its old journal rows are voided and kept).
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (['journal_ledger_entries', 'payments', 'expenses', 'supplier_payments', 'opening_balances', 'deal_closings'] as $table) {
            Schema::table($table, fn (Blueprint $t) => $t->unsignedBigInteger('company_id')->nullable()->change());
        }

        Schema::create('payment_change_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by')->constrained('users')->restrictOnDelete();
            $table->string('action', 10)->comment('edit | delete');
            $table->json('changes')->nullable()->comment('Edit: the new field values');
            $table->text('reason')->nullable()->comment("Agent's note");
            $table->string('status', 10)->default('pending')->index()->comment('pending | approved | rejected');
            $table->foreignId('decided_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('decided_at')->nullable();
            $table->text('decision_note')->nullable();
            $table->timestamps();

            $table->index(['payment_id', 'status']);
        });

        $this->convertCashToOnePot();
    }

    private function convertCashToOnePot(): void
    {
        $cash = DB::table('accounts')->where('type', 'cash')->whereNull('company_id')->whereNull('agent_id')->pluck('id');
        if ($cash->isEmpty()) {
            return; // fresh install: nothing to convert
        }

        // One cash opening for the whole pot: the earliest date, the sum of every company's.
        $openings = DB::table('opening_balances')->whereIn('account_id', $cash)->whereNull('deleted_at')->orderBy('date')->orderBy('id')->get();
        $merged = $openings->skip(1)->pluck('id');
        if ($merged->isNotEmpty()) {
            DB::table('opening_balances')->where('id', $openings->first()->id)->update([
                'amount' => number_format($openings->sum(fn ($o) => (float) $o->amount), 2, '.', ''),
                'notes' => 'Cash in hand (merged from each company)',
                'updated_at' => now(),
            ]);
        }
        DB::table('opening_balances')->whereIn('account_id', $cash)->update(['company_id' => null]);

        // Whatever cash paid for has no company.
        DB::table('payments')->whereIn('account_id', $cash)->update(['company_id' => null]);
        DB::table('expenses')->whereIn('account_id', $cash)->update(['company_id' => null]);
        DB::table('supplier_payments')->whereIn('account_id', $cash)->update(['company_id' => null]);

        // A transfer's cash side has no company; an agent move keeps the company it was for.
        $agentAccounts = DB::table('accounts')->whereNotNull('agent_id')->pluck('id');
        DB::table('transfers')->whereIn('from_account_id', $cash)->whereNotIn('to_account_id', $agentAccounts)
            ->update(['from_company_id' => null]);
        DB::table('transfers')->whereIn('to_account_id', $cash)->whereNotIn('from_account_id', $agentAccounts)
            ->update(['to_company_id' => null]);

        // Re-post them with the new rules.
        $ledger = app(LedgerService::class);
        $ledger->batch(function () use ($ledger, $cash, $merged) {
            foreach ($merged as $id) {
                $ledger->remove(OpeningBalance::findOrFail($id)); // now part of the first one
            }

            $documents = collect()
                ->concat(OpeningBalance::whereIn('account_id', $cash)->get())
                ->concat(Payment::whereIn('account_id', $cash)->get())
                ->concat(Expense::whereIn('account_id', $cash)->get())
                ->concat(SupplierPayment::whereIn('account_id', $cash)->get())
                ->concat(Transfer::where('status', Transfer::POSTED)
                    ->where(fn ($q) => $q->whereIn('from_account_id', $cash)->orWhereIn('to_account_id', $cash))->get());

            foreach ($documents as $document) {
                $createdBy = $document->created_by;
                $ledger->sync($document);
                DB::table('transactions')->where('source_type', $document->getMorphClass())->where('source_id', $document->getKey())
                    ->where('status', 'posted')->update(['created_by' => $createdBy]);
            }
        });

        $ledger->recalculateAll();
    }

    public function down(): void
    {
        throw new RuntimeException('This migration turns the cash into one pot with no company and cannot be reversed; restore the database backup instead.');
    }
};
