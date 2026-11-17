<?php

namespace App\Http\Resources\Api;

use App\Models\Expense;
use Illuminate\Http\Request;

/**
 * A supplier payment or an expense. company is null when paid from the cash in hand.
 *
 * @mixin \App\Models\SupplierPayment|\App\Models\Expense
 */
class MoneyOutResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        $isExpense = $this->resource instanceof Expense;

        return array_merge([
            'id' => $this->id,
            'date' => self::date($this->date),
            'company' => self::ref($this->company),
            'account' => self::account($this->account),
            'amount' => self::money($this->amount),
            'reference' => $this->reference,
            'notes' => $this->notes,
        ], $isExpense ? [
            'category' => self::ref($this->category),
            'description' => $this->description,
            'has_receipt' => (bool) $this->receipt_path,
            'receipt_url' => $this->receipt_path ? route('api.files.show', ['expense', $this->id]) : null,
        ] : [
            'supplier' => self::ref($this->supplier),
        ], [
            'created_at' => $this->created_at?->toIso8601String(),
        ]);
    }
}
