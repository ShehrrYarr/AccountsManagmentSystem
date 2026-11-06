<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use App\Support\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'registration_no', 'ntn', 'contact_person', 'phone', 'email', 'address',
        'opening_payable', 'opening_receivable', 'notes', 'is_active',
    ];

    /** Running balances change on every posting; the journal is their audit trail. */
    protected array $auditExclude = ['payable_balance', 'receivable_balance'];

    protected function casts(): array
    {
        return [
            'opening_payable' => 'decimal:2',
            'opening_receivable' => 'decimal:2',
            'payable_balance' => 'decimal:2',
            'receivable_balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(CompanyBankAccount::class);
    }

    public function cheques(): HasMany
    {
        return $this->hasMany(Cheque::class);
    }

    public function disbursements(): HasMany
    {
        return $this->hasMany(Disbursement::class);
    }

    public function adjustments(): HasMany
    {
        return $this->hasMany(CompanyAdjustment::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    /** Net position: positive = I owe them, negative = they owe me. */
    public function netBalance(): string
    {
        return Money::sub($this->payable_balance, $this->receivable_balance);
    }

    /** Uncleared government cheques received for this company. */
    public function pendingChequesTotal(): string
    {
        return Money::of($this->cheques()->pending()->sum('amount'));
    }
}
