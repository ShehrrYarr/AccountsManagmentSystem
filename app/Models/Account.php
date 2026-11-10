<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A company's cash in hand or one of its bank accounts.
 * The only ledger posting it owns is its opening balance.
 */
class Account extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id', 'type', 'name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban',
        'opening_balance', 'opening_date', 'is_active',
    ];

    protected array $auditExclude = ['current_balance'];

    protected function casts(): array
    {
        return [
            'type' => AccountType::class,
            'opening_balance' => 'decimal:2',
            'opening_date' => 'date',
            'current_balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }

    public function isCash(): bool
    {
        return $this->type === AccountType::Cash;
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopeBanks(Builder $q): Builder
    {
        return $q->where('type', AccountType::Bank);
    }

    public function scopeCash(Builder $q): Builder
    {
        return $q->where('type', AccountType::Cash);
    }

    /** "HBL Current (HBL)" — without the company. */
    public function shortLabel(): string
    {
        return $this->isCash() || blank($this->bank_name) || str_contains($this->name, $this->bank_name)
            ? $this->name
            : "{$this->name} ({$this->bank_name})";
    }

    /** "Al-Noor Traders · HBL Current" */
    public function label(): string
    {
        return ($this->company?->name ?? '?').' · '.$this->shortLabel();
    }

    public function ledgerPostings(): array
    {
        return [[
            'type' => TransactionType::OpeningBalance,
            'date' => $this->opening_date ?? $this->created_at ?? now(),
            'lines' => [
                ['account' => LedgerAccount::Money, 'debit' => $this->opening_balance, 'account_id' => $this->id, 'company_id' => $this->company_id],
                ['account' => LedgerAccount::OpeningEquity, 'credit' => $this->opening_balance, 'company_id' => $this->company_id],
            ],
            'attributes' => [
                'company_id' => $this->company_id,
                'to_account_id' => $this->id,
                'description' => "Opening balance — {$this->shortLabel()}",
            ],
            'allowEmpty' => true,
        ]];
    }
}
