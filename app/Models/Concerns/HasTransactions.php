<?php

namespace App\Models\Concerns;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Journal transactions posted by this source document (including voided history).
 */
trait HasTransactions
{
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'source');
    }
}
