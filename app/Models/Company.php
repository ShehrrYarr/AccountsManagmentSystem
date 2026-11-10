<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * One of MY companies. Each has exactly one cash in hand account plus any number of bank accounts.
 */
class Company extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = ['name', 'ntn', 'registration_no', 'phone', 'email', 'address', 'notes', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function cashAccount(): HasOne
    {
        return $this->hasOne(Account::class)->where('type', AccountType::Cash);
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(Account::class)->where('type', AccountType::Bank);
    }

    public function cheques(): HasMany
    {
        return $this->hasMany(Cheque::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function openingBalances(): HasMany
    {
        return $this->hasMany(OpeningBalance::class);
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }
}
