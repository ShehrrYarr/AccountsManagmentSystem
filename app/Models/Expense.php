<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A company running cost not tied to a department:  Dr Expenses / Cr Cash or Bank.
 */
class Expense extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = [
        'company_id', 'expense_category_id', 'account_id', 'amount', 'date', 'description', 'reference',
        'receipt_path', 'notes', 'created_by',
    ];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'date' => 'date'];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function ledgerPostings(): array
    {
        return [[
            'type' => TransactionType::Expense,
            'date' => $this->date,
            'lines' => [
                ['account' => LedgerAccount::Expense, 'debit' => $this->amount, 'company_id' => $this->company_id, 'expense_category_id' => $this->expense_category_id],
                ['account' => LedgerAccount::Money, 'credit' => $this->amount, 'company_id' => $this->company_id, 'account_id' => $this->account_id],
            ],
            'attributes' => [
                'company_id' => $this->company_id,
                'account_id' => $this->account_id,
                'amount' => $this->amount,
                'reference' => $this->reference,
                'description' => "{$this->category?->name}: {$this->description} (from {$this->account?->shortLabel()})",
                'notes' => $this->notes,
            ],
        ]];
    }
}
