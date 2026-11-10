<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A supplier goods are bought from, sometimes on credit. What each company owes it comes from the journal.
 */
class Supplier extends Model
{
    use Auditable;

    protected $fillable = ['name', 'contact_person', 'phone', 'ntn', 'address', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function supplierPayments(): HasMany
    {
        return $this->hasMany(SupplierPayment::class);
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }
}
