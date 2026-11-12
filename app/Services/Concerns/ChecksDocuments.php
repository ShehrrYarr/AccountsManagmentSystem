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

    /**
     * The account must exist, be usable by the company (one of its banks, or the admin's cash in
     * hand, which every company shares) and (optionally) be of the given type.
     */
    protected function accountOf(int $companyId, mixed $accountId, ?AccountType $type = null, string $field = 'account_id', ?int $keepId = null): Account
    {
        $account = Account::with('company')->find($accountId);

        if (! $account || ($account->company_id !== $companyId && ! $account->isAdminCash())) {
            throw new BusinessRuleException('Choose one of this company’s banks or the admin cash in hand.', $field);
        }

        if ($type && $account->type !== $type) {
            throw new BusinessRuleException($type === AccountType::Bank ? 'Choose a bank account.' : 'Choose the cash in hand account.', $field);
        }

        if (! $account->is_active && $account->id !== $keepId) {
            throw new BusinessRuleException("{$account->shortLabel()} is inactive.", $field);
        }

        return $account;
    }

    /** Cash for any company comes from the admin's single cash in hand. */
    protected function cashAccountOf(int $companyId): Account
    {
        return Account::adminCash();
    }
}
