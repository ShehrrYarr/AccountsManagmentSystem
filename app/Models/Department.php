<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A customer: a government department. Its balance per company comes from the journal
 * (debit = what I spent for it, credit = govt cheques received for it).
 */
class Department extends Model
{
    use Auditable;

    protected $fillable = ['name', 'code', 'city', 'contact_person', 'phone', 'notes', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function cheques(): HasMany
    {
        return $this->hasMany(Cheque::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }
}
