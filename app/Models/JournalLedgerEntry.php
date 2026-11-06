<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A single debit or credit line of a Transaction.
 */
class JournalLedgerEntry extends Model
{
    protected $fillable = ['transaction_id', 'ledger_account', 'bank_account_id', 'company_id', 'debit', 'credit', 'memo'];

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

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class)->withTrashed();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }
}
