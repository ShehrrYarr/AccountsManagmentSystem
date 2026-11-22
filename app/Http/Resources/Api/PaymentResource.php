<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;

/**
 * A department payment. company is null for cash (the cash in hand belongs to no company);
 * paid_by_agent is set when an agent paid from their own bank.
 *
 * @mixin \App\Models\Payment
 */
class PaymentResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => self::date($this->date),
            'method' => $this->method->value,
            'method_label' => $this->method->label(),
            'company' => self::ref($this->company),
            'department' => self::ref($this->department),
            'account' => self::account($this->account),
            'supplier' => self::ref($this->supplier),
            'on_credit' => (bool) $this->on_credit,
            'amount' => self::money($this->amount),
            'taxes' => $this->taxes->map(fn ($t) => ['tax_id' => $t->tax_id, 'name' => $t->tax?->name, 'amount' => self::money($t->amount)])->values(),
            'tax_total' => self::money($this->taxTotal()),
            'description' => $this->item_description,
            'quantity' => $this->quantity === null ? null : rtrim(rtrim((string) $this->quantity, '0'), '.'),
            'unit_price' => self::money($this->unit_price),
            'reference' => $this->reference,
            'received_by' => $this->received_by,
            'notes' => $this->notes,
            'summary' => $this->describe(),
            'has_receipt' => (bool) $this->receipt_path,
            'receipt_url' => $this->receipt_path ? route('api.files.show', ['payment', $this->id]) : null,
            'paid_by_agent' => $this->isByAgent() ? self::ref($this->account->agent) : null,
            'created_by' => self::ref($this->creator),
            'pending_request' => $this->relationLoaded('pendingRequest') && $this->pendingRequest ? new ChangeRequestResource($this->pendingRequest) : null,
            'latest_request' => $this->relationLoaded('latestRequest') && $this->latestRequest ? new ChangeRequestResource($this->latestRequest) : null,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
