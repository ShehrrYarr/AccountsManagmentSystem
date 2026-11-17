<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;

/**
 * Money moved between accounts: cash & bank moves, between companies, advances to agents and
 * returns from agents. status: posted | pending (an agent's return waiting for the admin) | rejected.
 *
 * @mixin \App\Models\Transfer
 */
class TransferResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => self::date($this->date),
            'kind' => $this->kind(),
            'type' => match (true) {
                $this->isAdvance() => 'advance',
                $this->isAgentReturn() => 'return',
                $this->isInterCompany() => 'intercompany',
                default => 'own',
            },
            'status' => $this->status,
            'amount' => self::money($this->amount),
            'from_account' => self::account($this->fromAccount),
            'to_account' => self::account($this->toAccount),
            'from_company' => self::ref($this->fromCompany),
            'to_company' => self::ref($this->toCompany),
            'agent' => self::ref($this->agentAccount()?->agent),
            'reference' => $this->reference,
            'notes' => $this->notes,
            'summary' => $this->describe(),
            'created_by' => self::ref($this->creator),
            'decided_by' => self::ref($this->decider),
            'decided_at' => $this->decided_at?->toIso8601String(),
            'decision_note' => $this->decision_note,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
