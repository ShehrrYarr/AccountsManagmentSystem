<?php

namespace App\Services\Concerns;

use App\Enums\AccountType;
use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Support\Money;

/**
 * Shared business-rule checks for document services.
 */
trait ChecksDocuments
{
    protected function positiveAmount(mixed $amount, string $field = 'amount'): string
    {
        $amount = Money::of($amount);
        if (! Money::isPositive($amount)) {
            throw new BusinessRuleException('Amount must be greater than zero.', $field);
        }

        return $amount;
    }

    /** The account must exist, belong to the company and (optionally) be of the given type. */
    protected function accountOf(int $companyId, mixed $accountId, ?AccountType $type = null, string $field = 'account_id', ?int $keepId = null): Account
    {
        $account = Account::with('company')->find($accountId);

        if (! $account || $account->company_id !== $companyId) {
            throw new BusinessRuleException('Choose one of this company’s own accounts.', $field);
        }

        if ($type && $account->type !== $type) {
            throw new BusinessRuleException($type === AccountType::Bank ? 'Choose a bank account.' : 'Choose the cash in hand account.', $field);
        }

        if (! $account->is_active && $account->id !== $keepId) {
            throw new BusinessRuleException("{$account->shortLabel()} is inactive.", $field);
        }

        return $account;
    }

    protected function cashAccountOf(int $companyId): Account
    {
        $cash = Account::where('company_id', $companyId)->where('type', AccountType::Cash)->first();
        if (! $cash) {
            throw new BusinessRuleException('This company has no cash in hand account.', 'company_id');
        }

        return $cash;
    }
}
