<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;

/**
 * An agent's request to edit or delete a cheque or a department payment.
 *
 * @mixin \App\Models\ChequeChangeRequest|\App\Models\PaymentChangeRequest
 */
class ChangeRequestResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        $isPayment = $this->resource instanceof \App\Models\PaymentChangeRequest;
        $changes = $this->changes ?? [];
        $picture = $isPayment ? 'receipt_path' : 'scan_path';
        if (isset($changes[$picture])) {
            $changes[$picture] = true; // a new picture is attached (see picture_url)
        }

        return [
            'id' => $this->id,
            'for' => $isPayment ? 'payment' : 'cheque',
            'record_id' => $isPayment ? $this->payment_id : $this->cheque_id,
            'action' => $this->action,
            'changes' => $changes ?: null,
            'picture_url' => isset($this->changes[$picture]) ? route('api.files.show', [$isPayment ? 'payment-request' : 'cheque-request', $this->id]) : null,
            'reason' => $this->reason,
            'status' => $this->status,
            'requested_by' => self::ref($this->requester),
            'decided_by' => self::ref($this->decider),
            'decided_at' => $this->decided_at?->toIso8601String(),
            'decision_note' => $this->decision_note,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
