<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A single debit or credit line of a Transaction.
 */
class JournalLedgerEntry extends Model
{
    protected $fillable = [
        'transaction_id', 'ledger_account', 'company_id', 'account_id', 'department_id', 'supplier_id',
        'counterparty_company_id', 'expense_category_id', 'debit', 'credit', 'memo',
    ];

    protected function casts(): array
    {
        return [
            'ledger_account' => LedgerAccount::class,
            'debit' => 'decimal:2',
            'credit' => 'decimal:2',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'counterparty_company_id')->withTrashed();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    /** Name of whatever this line is about (account, department, supplier...). */
    public function partyName(): string
    {
        return $this->account?->shortLabel()
            ?? $this->department?->name
            ?? $this->supplier?->name
            ?? $this->counterparty?->name
            ?? $this->category?->name
            ?? '—';
    }

    /** Lines of posted (not voided) transactions, joined so callers can filter by date. */
    public static function posted(): Builder
    {
        return static::query()
            ->join('transactions', 'transactions.id', '=', 'journal_ledger_entries.transaction_id')
            ->where('transactions.status', TransactionStatus::Posted->value);
    }
}
