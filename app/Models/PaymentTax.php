<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/** One tax on one payment: which tax and how much (paid from the payment's bank, on top of it). */
class PaymentTax extends Model
{
    protected $fillable = ['tax_id', 'amount'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }

    public function taxable(): MorphTo
    {
        return $this->morphTo();
    }
}
