<?php

namespace App\Services;

use App\Enums\ApprovalAction;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\BankAccount;
use App\Models\InternalTransfer;
use App\Models\User;
use App\Support\Money;

/**
 * Moving my own money between my accounts, e.g. withdrawing cash from a bank
 * into the Cash Vault.  Ledger: Dr Bank(to) / Cr Bank(from).
 * Creating is direct for everyone; staff edits / deletes need approval.
 */
class InternalTransferService
{
    public function __construct(
        private LedgerService $ledger,
        private ApprovalService $approvals,
    ) {}

    public function create(array $data, User $by): InternalTransfer
    {
        $fields = $this->prepare($data);

        return $this->ledger->batch(function () use ($fields, $by) {
            $transfer = InternalTransfer::create(array_merge($fields, ['created_by' => $by->id]));
            $this->post($transfer);

            return $transfer;
        });
    }

    public function update(InternalTransfer $transfer, array $data, User $by): Outcome
    {
        $this->prepare($data);

        if ($by->needsApproval()) {
            $this->approvals->request(ApprovalAction::UpdateRecord, $transfer, $data, $by, 'Edit '.$this->summary($transfer));

            return Outcome::PendingApproval;
        }

        $this->performUpdate($transfer, $data);

        return Outcome::Done;
    }

    public function performUpdate(InternalTransfer $transfer, array $data): InternalTransfer
    {
        return $this->ledger->batch(function () use ($transfer, $data) {
            $this->ledger->voidAllFor($transfer);
            $transfer->update($this->prepare($data));
            $this->post($transfer->fresh());

            return $transfer;
        });
    }

    public function delete(InternalTransfer $transfer, User $by): Outcome
    {
        if ($by->needsApproval()) {
            $this->approvals->request(ApprovalAction::DeleteRecord, $transfer, [], $by, 'Delete '.$this->summary($transfer));

            return Outcome::PendingApproval;
        }

        $this->performDelete($transfer);

        return Outcome::Done;
    }

    public function performDelete(InternalTransfer $transfer): void
    {
        $this->ledger->batch(function () use ($transfer) {
            $this->ledger->voidAllFor($transfer);
            $this->approvals->closePendingFor($transfer, 'Record deleted.');
            $transfer->delete();
        });
    }

    public function summary(InternalTransfer $t): string
    {
        $t->loadMissing('fromAccount', 'toAccount');

        return 'transfer of '.money($t->amount)." from {$t->fromAccount->name} to {$t->toAccount->name}";
    }

    private function post(InternalTransfer $t): void
    {
        $t->loadMissing('fromAccount', 'toAccount');

        $this->ledger->post(TransactionType::InternalTransfer, $t->date, [
            ['account' => LedgerAccount::Bank, 'debit' => $t->amount, 'bank_account_id' => $t->to_account_id],
            ['account' => LedgerAccount::Bank, 'credit' => $t->amount, 'bank_account_id' => $t->from_account_id],
        ], [
            'source_account_id' => $t->from_account_id,
            'destination_account_id' => $t->to_account_id,
            'description' => "Transfer {$t->fromAccount->name} → {$t->toAccount->name}",
            'notes' => $t->notes,
        ], $t);
    }

    private function prepare(array $data): array
    {
        $from = BankAccount::find($data['from_account_id'] ?? null);
        $to = BankAccount::find($data['to_account_id'] ?? null);
        $amount = Money::of($data['amount'] ?? 0);

        if (! $from || ! $to) {
            throw new BusinessRuleException('Choose both accounts.', 'from_account_id');
        }
        if ($from->id === $to->id) {
            throw new BusinessRuleException('Choose two different accounts.', 'to_account_id');
        }
        if (! Money::isPositive($amount)) {
            throw new BusinessRuleException('Amount must be greater than zero.', 'amount');
        }

        return [
            'from_account_id' => $from->id,
            'to_account_id' => $to->id,
            'amount' => $amount,
            'date' => $data['date'] ?? now()->toDateString(),
            'reference' => $data['reference'] ?? null,
            'notes' => $data['notes'] ?? null,
        ];
    }
}
