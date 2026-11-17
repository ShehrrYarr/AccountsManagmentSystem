<?php

namespace App\Http\Resources\Api;

use App\Models\Account;
use App\Support\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Base for the mobile API's JSON. Conventions: money is a string with 2 decimals ("1500.00"),
 * dates are "Y-m-d", times are ISO 8601, related records are small {id, name} objects.
 */
abstract class ApiResource extends JsonResource
{
    public static $wrap = 'data';

    protected static function money(mixed $value): ?string
    {
        return $value === null ? null : Money::of($value);
    }

    protected static function date(mixed $value): ?string
    {
        return $value?->toDateString();
    }

    /** {id, name} of a related record, or null. */
    protected static function ref(?Model $model, string $attribute = 'name'): ?array
    {
        return $model ? ['id' => $model->getKey(), 'name' => $model->{$attribute}] : null;
    }

    /** {id, name, type, holder} of a money account, or null. */
    protected static function account(?Account $account): ?array
    {
        return $account ? [
            'id' => $account->id,
            'name' => $account->label(),
            'short_name' => $account->shortLabel(),
            'type' => $account->type->value,
            'holder' => $account->isAdminCash() ? 'admin' : ($account->agent_id ? 'agent' : 'company'),
        ] : null;
    }
}
