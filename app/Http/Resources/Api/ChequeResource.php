<?php

namespace App\Http\Resources\Api;

use App\Models\Cheque;
use App\Support\Money;
use Illuminate\Http\Request;

/** @mixin \App\Models\Cheque */
class ChequeResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cheque_number' => $this->cheque_number,
            'cheque_date' => self::date($this->cheque_date),
            'deposited_on' => self::date($this->date),
            'valid_until' => Cheque::expiryFor($this->cheque_date)->toDateString(),
            'company' => self::ref($this->company),
            'department' => self::ref($this->department),
            'deposit_account' => self::account($this->depositAccount),
            'issuing_branch' => $this->issuing_branch,
            'amount' => self::money($this->amount),
            'bank_charges' => self::money($this->bank_charges),
            'net_deposit' => Money::sub($this->amount, $this->bank_charges),
            'deposit_reference' => $this->deposit_reference,
            'notes' => $this->notes,
            'has_picture' => (bool) $this->scan_path,
            'picture_url' => $this->scan_path ? route('api.files.show', ['cheque', $this->id]) : null,
            'received_by' => self::ref($this->receiver),
            'pending_request' => $this->relationLoaded('pendingRequest') && $this->pendingRequest ? new ChangeRequestResource($this->pendingRequest) : null,
            'latest_request' => $this->relationLoaded('latestRequest') && $this->latestRequest ? new ChangeRequestResource($this->latestRequest) : null,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
