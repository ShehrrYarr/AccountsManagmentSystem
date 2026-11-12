<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Company;
use App\Models\JournalLedgerEntry;
use App\Models\User;
use App\Support\Money;
use Illuminate\Support\Arr;

/**
 * My companies and the money accounts:
 *   - companies have bank accounts only (cash is the admin's single cash in hand);
 *   - each agent has one cash in hand (created with the agent) and any number of bank accounts,
 *     added by the admin or by the agent. Agent accounts are stored only, not used in postings yet.
 */
class MasterDataService
{
    public function __construct(private LedgerService $ledger) {}

    public function saveCompany(?Company $company, array $data): Company
    {
        $company ??= new Company;
        $company->fill(Arr::except($data, ['cash_opening', 'opening_date']))->save();

        return $company->fresh();
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

    /**
     * Create / update a company bank account or an agent's account.
     *   company bank : company_id + type bank (+ optional opening balance)
     *   agent account: agent_id (+ type bank; the agent's cash in hand is created automatically)
     */
    public function saveAccount(?Account $account, array $data, ?User $by = null): Account
    {
        return $this->ledger->batch(function () use ($account, $data, $by) {
            $isNew = ! $account?->exists;
            $account ??= new Account(['created_by' => $by?->id ?? auth()->id()]);

            if ($account->exists && $account->isAdminCash()) {
                throw new BusinessRuleException('The admin cash in hand has no details to edit.');
            }

            $agentId = (int) ($data['agent_id'] ?? $account->agent_id) ?: null;
            $companyId = $agentId ? null : ((int) ($data['company_id'] ?? $account->company_id) ?: null);
            $type = AccountType::from($data['type'] ?? $account->type?->value ?? AccountType::Bank->value);

            if ($agentId) {
                $agent = User::find($agentId);
                if (! $agent?->isAgent()) {
                    throw new BusinessRuleException('Choose an agent.', 'agent_id');
                }
            } elseif (! $companyId) {
                throw new BusinessRuleException('Choose the company.', 'company_id');
            }

            if ($companyId && $type === AccountType::Cash) {
                throw new BusinessRuleException('Companies have bank accounts only; cash is the admin cash in hand.', 'type');
            }

            if ($agentId && $type === AccountType::Cash && Account::where('agent_id', $agentId)->cash()
                ->when($account->exists, fn ($q) => $q->whereKeyNot($account->id))->exists()) {
                throw new BusinessRuleException('Each agent has exactly one cash in hand.', 'type');
            }

            if ($account->exists && ($account->type !== $type || $account->company_id !== $companyId || $account->agent_id !== $agentId) && $this->hasActivity($account)) {
                throw new BusinessRuleException('Holder and type cannot change after the account has been used.', 'type');
            }

            $opening = $companyId ? Money::of($data['opening_balance'] ?? 0) : '0.00'; // agent accounts aren't used yet
            if (Money::isNegative($opening)) {
                throw new BusinessRuleException('Opening balance cannot be negative.', 'opening_balance');
            }

            $account->fill(array_merge(Arr::only($data, ['name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban', 'is_active']), [
                'company_id' => $companyId,
                'agent_id' => $agentId,
                'type' => $type,
                'opening_balance' => $opening,
                'opening_date' => $companyId ? ($data['opening_date'] ?? $account->opening_date ?? now()->toDateString()) : null,
            ]));

            $openingChanged = $isNew || $account->isDirty(['opening_balance', 'opening_date', 'name']);
            $account->save();

            if ($openingChanged && $companyId) {
                $this->ledger->sync($account);
            }

            return $account->fresh();
        });
    }

    /** The agent's cash in hand, created if missing. */
    public function ensureAgentCash(User $agent, ?User $by = null): Account
    {
        return Account::where('agent_id', $agent->id)->cash()->first()
            ?? Account::create([
                'agent_id' => $agent->id, 'type' => AccountType::Cash, 'name' => 'Cash in hand',
                'is_active' => true, 'created_by' => $by?->id ?? auth()->id(),
            ]);
    }

    public function deleteAccount(Account $account): void
    {
        if ($account->isCash()) {
            throw new BusinessRuleException('A cash in hand account cannot be deleted.');
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
