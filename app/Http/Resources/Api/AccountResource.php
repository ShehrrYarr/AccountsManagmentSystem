<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;

/**
 * A money account: the admin's cash in hand, a company bank, or an agent's cash / bank.
 * "can_edit" says whether the signed-in user may change or delete it.
 *
 * @mixin \App\Models\Account
 */
class AccountResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user();

        return [
            'id' => $this->id,
            'type' => $this->type->value,
            'name' => $this->name,
            'label' => $this->label(),
            'short_label' => $this->shortLabel(),
            'holder' => $this->isAdminCash() ? 'admin' : ($this->agent_id ? 'agent' : 'company'),
            'company' => self::ref($this->company),
            'agent' => self::ref($this->agent),
            'bank_name' => $this->bank_name,
            'branch' => $this->branch,
            'account_title' => $this->account_title,
            'account_number' => $this->account_number,
            'iban' => $this->iban,
            'balance' => self::money($this->current_balance),
            'opening_balance' => self::money($this->opening_balance),
            'opening_date' => self::date($this->opening_date),
            'is_active' => (bool) $this->is_active,
            'added_by_admin' => $this->addedByAdmin(),
            'can_edit' => $user ? \App\Http\Controllers\Api\V1\AccountController::canChange($user, $this->resource) : false,
            'deleted' => $this->trashed(),
        ];
    }
}
