<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Journal header: one business event, made of balanced ledger lines.
 * Created only through App\Services\LedgerService.
 */
class Transaction extends Model
{
    protected $fillable = [
        'date', 'type', 'source_type', 'source_id', 'company_id', 'counterparty_company_id', 'account_id', 'to_account_id',
        'department_id', 'supplier_id', 'amount', 'reference', 'description', 'notes', 'status',
        'created_by', 'voided_by', 'voided_at',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'type' => TransactionType::class,
            'status' => TransactionStatus::class,
            'amount' => 'decimal:2',
            'voided_at' => 'datetime',
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }

    public function source(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function counterpartyCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'counterparty_company_id')->withTrashed();
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function toAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'to_account_id')->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePosted(Builder $q): Builder
    {
        return $q->where('status', TransactionStatus::Posted);
    }
}
