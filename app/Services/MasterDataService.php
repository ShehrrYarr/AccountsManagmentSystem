<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Company;
use App\Models\JournalLedgerEntry;
use App\Support\Money;

/**
 * My companies and their accounts. Creating a company also creates its single cash in hand.
 */
class MasterDataService
{
    public function __construct(private LedgerService $ledger) {}

    /**
     * @param  array{name: string, cash_opening?: mixed, opening_date?: string}  $data
     */
    public function saveCompany(?Company $company, array $data): Company
    {
        return $this->ledger->batch(function () use ($company, $data) {
            $isNew = ! $company?->exists;
            $company ??= new Company;
            $company->fill(collect($data)->except(['cash_opening', 'opening_date'])->all())->save();

            if ($isNew) {
                $this->saveAccount(null, [
                    'company_id' => $company->id,
                    'type' => AccountType::Cash->value,
                    'name' => 'Cash in hand',
                    'opening_balance' => $data['cash_opening'] ?? 0,
                    'opening_date' => $data['opening_date'] ?? now()->toDateString(),
                    'is_active' => true,
                ]);
            }

            return $company->fresh();
        });
    }

    public function deleteCompany(Company $company): void
    {
        $used = JournalLedgerEntry::where('company_id', $company->id)
            ->whereHas('transaction', fn ($q) => $q->posted()->where('type', '!=', TransactionType::OpeningBalance))
            ->exists();

        if ($used) {
            throw new BusinessRuleException("{$company->name} has transactions on record. Deactivate it instead of deleting.");
        }

        $this->ledger->batch(function () use ($company) {
            foreach ($company->accounts as $account) {
                $this->ledger->remove($account);
            }
            $company->openingBalances()->each(fn ($o) => $this->ledger->remove($o));
            $company->delete();
        });
    }

    public function saveAccount(?Account $account, array $data): Account
    {
        return $this->ledger->batch(function () use ($account, $data) {
            $account ??= new Account;
            $type = AccountType::from($data['type'] ?? $account->type?->value ?? AccountType::Bank->value);
            $companyId = (int) ($data['company_id'] ?? $account->company_id);

            if ($account->exists && ($account->type !== $type || $account->company_id !== $companyId) && $this->hasActivity($account)) {
                throw new BusinessRuleException('Company and type cannot change after the account has been used.', 'type');
            }

            if ($type === AccountType::Cash) {
                $another = Account::where('company_id', $companyId)->where('type', AccountType::Cash)
                    ->when($account->exists, fn ($q) => $q->whereKeyNot($account->id))->exists();
                if ($another) {
                    throw new BusinessRuleException('Each company has exactly one cash in hand account.', 'type');
                }
            }

            $opening = Money::of($data['opening_balance'] ?? 0);
            if (Money::isNegative($opening)) {
                throw new BusinessRuleException('Opening balance cannot be negative.', 'opening_balance');
            }

            $account->fill(array_merge($data, [
                'company_id' => $companyId,
                'type' => $type,
                'opening_balance' => $opening,
                'opening_date' => $data['opening_date'] ?? $account->opening_date ?? now()->toDateString(),
            ]));

            $openingChanged = ! $account->exists || $account->isDirty(['opening_balance', 'opening_date', 'name']);
            $account->save();

            if ($openingChanged) {
                $this->ledger->sync($account);
            }

            return $account->fresh();
        });
    }

    public function deleteAccount(Account $account): void
    {
        if ($account->isCash()) {
            throw new BusinessRuleException('The cash in hand account cannot be deleted.');
        }

        if ($this->hasActivity($account)) {
            throw new BusinessRuleException("{$account->shortLabel()} has transactions. Deactivate it instead of deleting.");
        }

        $this->ledger->remove($account);
    }

    public function hasActivity(Account $account): bool
    {
        return JournalLedgerEntry::where('account_id', $account->id)
            ->whereHas('transaction', fn ($q) => $q->posted()->where('type', '!=', TransactionType::OpeningBalance))
            ->exists();
    }
}
