<?php

namespace App\Http\Resources\Api;

use App\Models\DealClosing;
use App\Models\OpeningBalance;
use App\Models\Transaction;
use App\Support\Money;
use Illuminate\Http\Request;

/**
 * Opening balances, deal closings and journal transactions (with their lines).
 *
 * @mixin \App\Models\OpeningBalance|\App\Models\DealClosing|\App\Models\Transaction
 */
class LedgerRecordResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        return match (true) {
            $this->resource instanceof OpeningBalance => [
                'id' => $this->id,
                'party' => $this->isAgent() ? 'agent' : ($this->account_id ? 'cash' : ($this->department_id ? 'department' : 'supplier')),
                'party_name' => $this->partyName(),
                'company' => self::ref($this->company),
                'department' => self::ref($this->department),
                'supplier' => self::ref($this->supplier),
                'account' => self::account($this->account),
                'amount' => self::money($this->amount),
                'date' => self::date($this->date),
                'notes' => $this->notes,
            ],
            $this->resource instanceof DealClosing => [
                'id' => $this->id,
                'company' => self::ref($this->company),
                'department' => self::ref($this->department),
                'date' => self::date($this->date),
                'amount' => self::money($this->amount),
                'result' => $this->isProfit() ? 'profit' : 'loss',
                'notes' => $this->notes,
            ],
            $this->resource instanceof Transaction => [
                'id' => $this->id,
                'date' => self::date($this->date),
                'type' => $this->type->value,
                'type_label' => $this->type->label(),
                'status' => $this->status->value,
                'amount' => self::money($this->amount),
                'description' => $this->description,
                'reference' => $this->reference,
                'notes' => $this->notes,
                'company' => self::ref($this->company),
                'source' => $this->source_type ? ['type' => $this->source_type, 'id' => $this->source_id] : null,
                'lines' => $this->relationLoaded('entries') ? $this->entries->map(fn ($e) => [
                    'account' => $e->ledger_account->value,
                    'account_label' => $e->ledger_account->label(),
                    'party' => $e->partyName(),
                    'company_id' => $e->company_id,
                    'debit' => Money::isZero($e->debit) ? null : self::money($e->debit),
                    'credit' => Money::isZero($e->credit) ? null : self::money($e->credit),
                ])->values() : null,
                'created_by' => self::ref($this->creator ?? null),
                'created_at' => $this->created_at?->toIso8601String(),
            ],
        };
    }
}
