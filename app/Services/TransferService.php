<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Concerns\ChecksDocuments;
use App\Support\Money;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Moving money between two accounts: within one company, between my companies, as an advance
 * to an agent, or back from an agent.
 *
 * Agents record their own returns; those wait for the admin (requestReturn → approve / reject,
 * or the agent withdraws it).
 */
class TransferService
{
    use ChecksDocuments;

    private const FIELDS = ['from_company_id', 'from_account_id', 'to_company_id', 'to_account_id', 'amount', 'date', 'reference', 'notes'];

    public function __construct(private LedgerService $ledger) {}

    public function save(?Transfer $transfer, array $data): Transfer
    {
        $transfer ??= new Transfer(['created_by' => auth()->id()]);
        if ($transfer->exists && ! $transfer->isPosted()) {
            throw new BusinessRuleException('This return is waiting for approval. Approve or reject it on the Approvals page.', 'amount');
        }

        $this->prepare($transfer, $data);

        return $this->post($transfer);
    }

    public function delete(Transfer $transfer): void
    {
        $this->ledger->remove($transfer);
    }

    // ---- Agents' returns -------------------------------------------------

    /** An agent sends money back from one of their accounts; it waits for the admin. */
    public function requestReturn(array $data, User $agent): Transfer
    {
        $transfer = new Transfer(['created_by' => $agent->id]);
        $this->prepare($transfer, $data);

        if ((int) $transfer->fromAccount?->agent_id !== $agent->id) {
            throw new BusinessRuleException('Choose one of your own accounts.', 'from_account_id');
        }

        $this->check($transfer);

        $transfer->status = Transfer::PENDING;
        $transfer->unsetRelations();
        $transfer->save();

        return $transfer;
    }

    public function approve(Transfer $transfer, User $admin): Transfer
    {
        $this->assertPending($transfer);

        $transfer->fill(['status' => Transfer::POSTED, 'decided_by' => $admin->id, 'decided_at' => now()]);

        return $this->post($transfer);
    }

    public function reject(Transfer $transfer, User $admin, ?string $note = null): void
    {
        $this->assertPending($transfer);

        $transfer->update(['status' => Transfer::REJECTED, 'decided_by' => $admin->id, 'decided_at' => now(), 'decision_note' => $note ?: null]);
    }

    /** The agent takes back a return that hasn't been decided yet. */
    public function withdraw(Transfer $transfer, User $agent): void
    {
        $this->assertPending($transfer);
        if ((int) $transfer->created_by !== $agent->id) {
            throw new BusinessRuleException('Only the agent who sent this return can withdraw it.');
        }

        $transfer->forceDelete();
    }

    // ---------------------------------------------------------------------

    private function prepare(Transfer $transfer, array $data): void
    {
        $transfer->fill(Arr::only($data, self::FIELDS));
        $transfer->amount = $this->positiveAmount($transfer->amount);

        $from = Account::find($transfer->from_account_id);
        $to = Account::find($transfer->to_account_id);

        if (! $from) {
            throw new BusinessRuleException('Choose the account the money leaves from.', 'from_account_id');
        }
        if (! $to) {
            throw new BusinessRuleException('Choose the account the money goes to.', 'to_account_id');
        }
        if ($from->id === $to->id) {
            throw new BusinessRuleException('Choose two different accounts.', 'to_account_id');
        }

        if ($from->isAgentAccount() || $to->isAgentAccount()) {
            $this->prepareAgentMove($transfer, $from, $to);

            return;
        }

        // A bank names its own company; the admin's cash belongs to none.
        $this->businessAccount($from->id, null, 'from_account_id', $transfer->getOriginal('from_account_id'));
        $this->businessAccount($to->id, null, 'to_account_id', $transfer->getOriginal('to_account_id'));
        $transfer->from_company_id = $from->company_id;
        $transfer->to_company_id = $to->company_id;
    }

    /**
     * Advance (company → agent) or return (agent → company), always for one company: the company
     * bank's own, or — through the admin's cash pot — the one chosen on the form.
     */
    private function prepareAgentMove(Transfer $transfer, Account $from, Account $to): void
    {
        if ($from->isAgentAccount() && $to->isAgentAccount()) {
            throw new BusinessRuleException('Money can only move between an agent and a company account.', 'to_account_id');
        }

        [$agentSide, $agentField, $companySide, $companyField] = $to->isAgentAccount()
            ? [$to, 'to_account_id', $from, 'from_account_id']
            : [$from, 'from_account_id', $to, 'to_account_id'];

        $company = $companySide->company_id ?? $transfer->from_company_id;
        if (! $company) {
            throw new BusinessRuleException($to->isAgentAccount() ? 'Choose the company giving the advance.' : 'Choose the company the money is returned to.', 'from_company_id');
        }
        $transfer->from_company_id = $transfer->to_company_id = $company;

        $account = $this->businessAccount($companySide->id, null, $companyField, $transfer->getOriginal($companyField));
        if ($account->company_id && (int) $account->company_id !== (int) $company) {
            throw new BusinessRuleException('Choose one of this company’s banks or the admin cash in hand.', $companyField);
        }

        if (! $agentSide->is_active && $agentSide->id !== $transfer->getOriginal($agentField)) {
            throw new BusinessRuleException("{$agentSide->shortLabel()} is inactive.", $agentField);
        }
    }

    /**
     * Save and post. A return can't be more than the agent owes that company, nor more than the
     * account it leaves holds (agents may otherwise owe less than zero: spending their own money
     * on department payments means the company owes them).
     */
    private function post(Transfer $transfer): Transfer
    {
        return $this->ledger->batch(function () use ($transfer) {
            $this->ledger->record($transfer);

            if ($transfer->isPosted() && $transfer->isAgentReturn()) {
                $account = $transfer->fromAccount()->first();
                $owed = Balances::agentOwed((int) $account->agent_id, (int) $transfer->from_company_id);
                if (Money::isNegative($owed)) {
                    throw new BusinessRuleException(
                        "This is more than {$account->agent?->name} owes {$transfer->fromCompany?->name}. Over by ".money(Money::sub(0, $owed)).'.',
                        'amount'
                    );
                }
                if (Money::isNegative($account->current_balance)) {
                    throw new BusinessRuleException(
                        "Not enough money in {$account->label()}. Short by ".money(Money::sub(0, $account->current_balance)).'.',
                        'amount'
                    );
                }
            }

            return $transfer;
        });
    }

    /** Would posting this break a rule (not enough in the account, more than owed)? Nothing is kept. */
    private function check(Transfer $transfer): void
    {
        $trial = $transfer->replicate();
        $trial->status = Transfer::POSTED;

        DB::beginTransaction();
        try {
            $this->post($trial);
        } finally {
            DB::rollBack();
        }
    }

    private function assertPending(Transfer $transfer): void
    {
        if (! $transfer->isPending()) {
            throw new BusinessRuleException('This return has already been decided.');
        }
    }
}
