<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Concerns\ChecksDocuments;
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

        return $this->ledger->record($transfer);
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

        return $this->ledger->record($transfer);
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

        // A bank names its own company; the admin's cash is shared, so the form says which company.
        $transfer->from_company_id = $from->company_id ?? $transfer->from_company_id;
        $transfer->to_company_id = $to->company_id ?? ($transfer->to_company_id ?: $transfer->from_company_id);
        if (! $transfer->from_company_id) {
            throw new BusinessRuleException('Choose the company the money leaves from.', 'from_company_id');
        }

        $this->accountOf((int) $transfer->from_company_id, $from->id, null, 'from_account_id', $transfer->getOriginal('from_account_id'));
        $this->accountOf((int) $transfer->to_company_id, $to->id, null, 'to_account_id', $transfer->getOriginal('to_account_id'));
    }

    /**
     * Advance (company → agent) or return (agent → company). Both sides belong to one company:
     * the company bank's own, or — for the admin's cash — the one chosen on the form.
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

        $this->accountOf((int) $company, $companySide->id, null, $companyField, $transfer->getOriginal($companyField));

        if (! $agentSide->is_active && $agentSide->id !== $transfer->getOriginal($agentField)) {
            throw new BusinessRuleException("{$agentSide->shortLabel()} is inactive.", $agentField);
        }
    }

    /** Would posting this break a rule (not enough in the account, more than owed)? Nothing is kept. */
    private function check(Transfer $transfer): void
    {
        $trial = $transfer->replicate();
        $trial->status = Transfer::POSTED;

        DB::beginTransaction();
        try {
            $this->ledger->record($trial);
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
