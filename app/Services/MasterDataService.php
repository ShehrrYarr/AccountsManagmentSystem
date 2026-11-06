<?php

namespace App\Services;

use App\Enums\BankAccountType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\JournalLedgerEntry;
use App\Models\Transaction;
use App\Support\Money;

/**
 * Companies and my bank accounts, including their opening balances, which
 * are posted to the journal against Opening Balance Equity.
 */
class MasterDataService
{
    public function __construct(private LedgerService $ledger) {}

    public function saveCompany(?Company $company, array $data): Company
    {
        return $this->ledger->batch(function () use ($company, $data) {
            $company ??= new Company;
            $openingChanged = ! $company->exists
                || Money::cmp($company->opening_payable, $data['opening_payable'] ?? 0) !== 0
                || Money::cmp($company->opening_receivable, $data['opening_receivable'] ?? 0) !== 0;

            $company->fill(array_merge($data, [
                'opening_payable' => Money::of($data['opening_payable'] ?? 0),
                'opening_receivable' => Money::of($data['opening_receivable'] ?? 0),
            ]))->save();

            if ($openingChanged) {
                $this->ledger->voidAllFor($company);

                $this->ledger->post(TransactionType::OpeningBalance, $company->created_at ?? now(), [
                    ['account' => LedgerAccount::OpeningEquity, 'debit' => $company->opening_payable, 'company_id' => $company->id],
                    ['account' => LedgerAccount::CompanyPayable, 'credit' => $company->opening_payable, 'company_id' => $company->id],
                    ['account' => LedgerAccount::CompanyReceivable, 'debit' => $company->opening_receivable, 'company_id' => $company->id],
                    ['account' => LedgerAccount::OpeningEquity, 'credit' => $company->opening_receivable, 'company_id' => $company->id],
                ], [
                    'company_id' => $company->id,
                    'description' => "Opening balance — {$company->name}",
                ], $company, allowEmpty: true);
            }

            return $company->fresh();
        });
    }

    public function deleteCompany(Company $company): void
    {
        if ($company->cheques()->exists() || $company->disbursements()->exists() || $company->adjustments()->exists()) {
            throw new BusinessRuleException("{$company->name} has cheques or payments on record. Deactivate it instead of deleting.");
        }

        $this->ledger->batch(function () use ($company) {
            $this->ledger->voidAllFor($company);
            $company->delete();
        });
    }

    public function saveBankAccount(?BankAccount $account, array $data): BankAccount
    {
        return $this->ledger->batch(function () use ($account, $data) {
            $account ??= new BankAccount;
            $type = BankAccountType::from($data['type'] ?? ($account->type?->value ?? 'bank'));

            if ($type === BankAccountType::Cash) {
                $existing = BankAccount::where('type', BankAccountType::Cash)->when($account->exists, fn ($q) => $q->whereKeyNot($account->id))->exists();
                if ($existing) {
                    throw new BusinessRuleException('There is already a Cash Vault. Only one is allowed.', 'type');
                }
            }

            if ($account->exists && $account->type !== $type && $this->hasActivity($account)) {
                throw new BusinessRuleException('Account type cannot change after it has been used.', 'type');
            }

            $openingChanged = ! $account->exists || Money::cmp($account->opening_balance, $data['opening_balance'] ?? 0) !== 0;

            $account->fill(array_merge($data, [
                'type' => $type,
                'opening_balance' => Money::of($data['opening_balance'] ?? 0),
            ]))->save();

            if ($openingChanged) {
                $this->ledger->voidAllFor($account);
                $this->ledger->post(TransactionType::OpeningBalance, $account->created_at ?? now(), [
                    ['account' => LedgerAccount::Bank, 'debit' => $account->opening_balance, 'bank_account_id' => $account->id],
                    ['account' => LedgerAccount::OpeningEquity, 'credit' => $account->opening_balance],
                ], [
                    'destination_account_id' => $account->id,
                    'description' => "Opening balance — {$account->name}",
                ], $account, allowEmpty: true);
            }

            return $account->fresh();
        });
    }

    public function deleteBankAccount(BankAccount $account): void
    {
        if ($this->hasActivity($account)) {
            throw new BusinessRuleException("{$account->name} has transactions. Deactivate it instead of deleting.");
        }

        $this->ledger->batch(function () use ($account) {
            $this->ledger->voidAllFor($account);
            $account->delete();
        });
    }

    private function hasActivity(BankAccount $account): bool
    {
        return JournalLedgerEntry::where('bank_account_id', $account->id)
            ->whereHas('transaction', fn ($q) => $q->where('type', '!=', TransactionType::OpeningBalance)->posted())
            ->exists();
    }
}
