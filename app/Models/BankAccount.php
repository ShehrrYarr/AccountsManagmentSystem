<?php

namespace App\Models;

use App\Enums\BankAccountType;
use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * One of MY accounts: a bank account or the single Cash Vault.
 */
class BankAccount extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'type', 'bank_name', 'branch', 'account_title', 'account_number', 'iban',
        'opening_balance', 'is_active',
    ];

    protected array $auditExclude = ['current_balance'];

    protected function casts(): array
    {
        return [
            'type' => BankAccountType::class,
            'opening_balance' => 'decimal:2',
            'current_balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public static function vault(): ?self
    {
        return static::where('type', BankAccountType::Cash)->first();
    }

    public function isVault(): bool
    {
        return $this->type === BankAccountType::Cash;
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopeBanks(Builder $q): Builder
    {
        return $q->where('type', BankAccountType::Bank);
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }

    public function label(): string
    {
        return $this->isVault() || blank($this->bank_name) ? $this->name : "{$this->name} ({$this->bank_name})";
    }
}
