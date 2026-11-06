<?php

namespace App\Services;

use App\Enums\ApprovalAction;
use App\Enums\BankAccountType;
use App\Enums\ChequeStatus;
use App\Enums\ClearingMethod;
use App\Enums\CommissionType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\BankAccount;
use App\Models\Cheque;
use App\Models\User;
use App\Support\Money;
use Illuminate\Support\Arr;

/**
 * Government cheque lifecycle:  Received -> Cleared (deposit | encashment) -> [Bounced]
 *                                Received -> Cancelled | Bounced
 *
 * Ledger effects
 *   Received : memo only (Cheques In Hand / Cheques Pending) — company balance untouched.
 *   Cleared  : Dr Bank (amount - bank charges), Dr Bank Charges
 *              Cr Company Payable (amount - commission), Cr Commission Income
 *              + memo reversal.
 *   Bounced  : exact reversal of whatever was posted. Blocked when the company
 *              has already been paid out of that money (payable would go negative).
 */
class ChequeService
{
    public function __construct(
        private LedgerService $ledger,
        private ApprovalService $approvals,
    ) {}

    // ------------------------------------------------------------------
    // Registration (no approval needed)
    // ------------------------------------------------------------------

    public function register(array $data, User $by): Cheque
    {
        return $this->ledger->batch(function () use ($data, $by) {
            $cheque = Cheque::create(array_merge($this->receiptFields($data), [
                'status' => ChequeStatus::Received,
                'created_by' => $by->id,
            ]));

            $this->postReceipt($cheque);

            return $cheque;
        });
    }

    // ------------------------------------------------------------------
    // Clearing
    // ------------------------------------------------------------------

    public function clear(Cheque $cheque, array $data, User $by): Outcome
    {
        $this->assertStatus($cheque, [ChequeStatus::Received], 'Only cheques pending clearing can be cleared.');
        $clearing = $this->clearingFields($cheque, $data);

        if ($by->needsApproval()) {
            $this->approvals->request(
                ApprovalAction::ClearCheque, $cheque, $data, $by,
                "Clear cheque #{$cheque->cheque_number} (".money($cheque->amount).") for {$cheque->company->name} via ".
                $clearing['clearing_method']->label()
            );

            return Outcome::PendingApproval;
        }

        $this->performClear($cheque, $data, $by);

        return Outcome::Done;
    }

    public function performClear(Cheque $cheque, array $data, User $by): Cheque
    {
        return $this->ledger->batch(function () use ($cheque, $data, $by) {
            $cheque->refresh();
            $this->assertStatus($cheque, [ChequeStatus::Received], 'Only cheques pending clearing can be cleared.');

            $cheque->update(array_merge($this->clearingFields($cheque, $data), [
                'status' => ChequeStatus::Cleared,
                'cleared_by' => $by->id,
            ]));

            $this->postClearing($cheque);

            return $cheque;
        });
    }

    // ------------------------------------------------------------------
    // Bounce / cancel
    // ------------------------------------------------------------------

    public function bounce(Cheque $cheque, array $data, User $by): Outcome
    {
        $this->assertStatus($cheque, [ChequeStatus::Received, ChequeStatus::Cleared], 'Only pending or cleared cheques can bounce.');

        if ($by->needsApproval()) {
            $this->approvals->request(ApprovalAction::BounceCheque, $cheque, $data, $by,
                "Mark cheque #{$cheque->cheque_number} (".money($cheque->amount).") for {$cheque->company->name} as BOUNCED");

            return Outcome::PendingApproval;
        }

        $this->performBounce($cheque, $data);

        return Outcome::Done;
    }

    public function performBounce(Cheque $cheque, array $data): Cheque
    {
        try {
            return $this->ledger->batch(function () use ($cheque, $data) {
                $cheque->refresh();
                $this->assertStatus($cheque, [ChequeStatus::Received, ChequeStatus::Cleared], 'Only pending or cleared cheques can bounce.');
                $wasCleared = $cheque->status === ChequeStatus::Cleared;

                $cheque->update([
                    'status' => ChequeStatus::Bounced,
                    'closed_date' => $data['closed_date'] ?? now()->toDateString(),
                    'closed_reason' => $data['closed_reason'] ?? null,
                ]);

                $this->postClosure($cheque, $wasCleared);

                return $cheque;
            });
        } catch (BusinessRuleException $e) {
            throw new BusinessRuleException(
                'Cannot mark this cheque as bounced: '.$e->getMessage().
                ' The company has already been paid out of this money. Record a manual adjustment (receivable) first, then try again.',
                'closed_reason'
            );
        }
    }

    public function cancel(Cheque $cheque, array $data, User $by): Outcome
    {
        $this->assertStatus($cheque, [ChequeStatus::Received], 'Only cheques pending clearing can be cancelled.');

        if ($by->needsApproval()) {
            $this->approvals->request(ApprovalAction::CancelCheque, $cheque, $data, $by,
                "Cancel cheque #{$cheque->cheque_number} (".money($cheque->amount).") for {$cheque->company->name}");

            return Outcome::PendingApproval;
        }

        $this->performCancel($cheque, $data);

        return Outcome::Done;
    }

    public function performCancel(Cheque $cheque, array $data): Cheque
    {
        return $this->ledger->batch(function () use ($cheque, $data) {
            $cheque->refresh();
            $this->assertStatus($cheque, [ChequeStatus::Received], 'Only cheques pending clearing can be cancelled.');

            $cheque->update([
                'status' => ChequeStatus::Cancelled,
                'closed_date' => $data['closed_date'] ?? now()->toDateString(),
                'closed_reason' => $data['closed_reason'] ?? null,
            ]);

            $this->postClosure($cheque, false);

            return $cheque;
        });
    }

    // ------------------------------------------------------------------
    // Edit / delete (staff -> approval)
    // ------------------------------------------------------------------

    public function update(Cheque $cheque, array $data, User $by): Outcome
    {
        if ($by->needsApproval()) {
            $this->approvals->request(ApprovalAction::UpdateRecord, $cheque, $data, $by,
                "Edit cheque #{$cheque->cheque_number} for {$cheque->company->name}");

            return Outcome::PendingApproval;
        }

        $this->performUpdate($cheque, $data);

        return Outcome::Done;
    }

    /**
     * Apply new receipt (and, for cleared cheques, clearing) details,
     * then rebuild all journal postings of this cheque.
     */
    public function performUpdate(Cheque $cheque, array $data): Cheque
    {
        return $this->ledger->batch(function () use ($cheque, $data) {
            $cheque->refresh();
            $fields = $this->receiptFields(array_merge($cheque->only([
                'company_id', 'government_department_id', 'cheque_number', 'issuing_bank', 'issuing_branch',
                'amount', 'received_date', 'scan_path', 'notes',
            ]), ['cheque_date' => $cheque->cheque_date->toDateString()], $data));

            $cheque->fill($fields);

            if (in_array($cheque->status, [ChequeStatus::Cleared, ChequeStatus::Bounced], true) && $cheque->clearing_method) {
                $cheque->fill($this->clearingFields($cheque, array_merge([
                    'clearing_method' => $cheque->clearing_method->value,
                    'cleared_into_account_id' => $cheque->cleared_into_account_id,
                    'cleared_date' => $cheque->cleared_date?->toDateString(),
                    'commission_type' => $cheque->commission_type?->value,
                    'commission_rate' => $cheque->commission_rate,
                    'bank_charges' => $cheque->bank_charges,
                    'clearing_reference' => $cheque->clearing_reference,
                ], Arr::only($data, [
                    'clearing_method', 'cleared_into_account_id', 'cleared_date', 'commission_type',
                    'commission_rate', 'bank_charges', 'clearing_reference',
                ]))));
            }

            $cheque->save();
            $this->repost($cheque);

            return $cheque;
        });
    }

    public function delete(Cheque $cheque, User $by): Outcome
    {
        if ($by->needsApproval()) {
            $this->approvals->request(ApprovalAction::DeleteRecord, $cheque, [], $by,
                "Delete cheque #{$cheque->cheque_number} (".money($cheque->amount).") for {$cheque->company->name}");

            return Outcome::PendingApproval;
        }

        $this->performDelete($cheque);

        return Outcome::Done;
    }

    public function performDelete(Cheque $cheque): void
    {
        $this->ledger->batch(function () use ($cheque) {
            $this->ledger->voidAllFor($cheque);
            $this->approvals->closePendingFor($cheque, 'Record deleted.');
            $cheque->delete();
        });
    }

    // ------------------------------------------------------------------
    // Posting helpers
    // ------------------------------------------------------------------

    /** Void all postings of the cheque and rebuild them from its current state. */
    public function repost(Cheque $cheque): void
    {
        $this->ledger->batch(function () use ($cheque) {
            $this->ledger->voidAllFor($cheque);
            $this->postReceipt($cheque);

            $cleared = $cheque->clearing_method !== null
                && in_array($cheque->status, [ChequeStatus::Cleared, ChequeStatus::Bounced], true);

            if ($cleared) {
                $this->postClearing($cheque);
            }

            if (in_array($cheque->status, [ChequeStatus::Bounced, ChequeStatus::Cancelled], true)) {
                $this->postClosure($cheque, $cleared);
            }
        });
    }

    private function memoLines(Cheque $cheque): array
    {
        return [
            ['account' => LedgerAccount::ChequesInHand, 'debit' => $cheque->amount, 'company_id' => $cheque->company_id],
            ['account' => LedgerAccount::ChequesPending, 'credit' => $cheque->amount, 'company_id' => $cheque->company_id],
        ];
    }

    private function clearingLines(Cheque $cheque): array
    {
        return array_merge(LedgerService::reverseLines($this->memoLines($cheque)), [
            ['account' => LedgerAccount::Bank, 'debit' => $cheque->netToAccount(), 'bank_account_id' => $cheque->cleared_into_account_id],
            ['account' => LedgerAccount::BankCharges, 'debit' => $cheque->bank_charges],
            ['account' => LedgerAccount::CompanyPayable, 'credit' => $cheque->netToCompany(), 'company_id' => $cheque->company_id],
            ['account' => LedgerAccount::CommissionIncome, 'credit' => $cheque->commission_amount, 'company_id' => $cheque->company_id],
        ]);
    }

    private function baseAttributes(Cheque $cheque): array
    {
        return [
            'company_id' => $cheque->company_id,
            'cheque_number' => $cheque->cheque_number,
            // The business amount is the cheque face value, not the sum of all journal lines
            // (clearing lines include the memo reversal, which would double it).
            'amount' => $cheque->amount,
        ];
    }

    private function postReceipt(Cheque $cheque): void
    {
        $this->ledger->post(TransactionType::ChequeIn, $cheque->received_date, $this->memoLines($cheque), array_merge(
            $this->baseAttributes($cheque),
            ['description' => "Cheque #{$cheque->cheque_number} received from ".($cheque->department?->name ?? $cheque->issuing_bank)]
        ), $cheque);
    }

    private function postClearing(Cheque $cheque): void
    {
        $type = $cheque->clearing_method->transactionType();
        $this->ledger->post($type, $cheque->cleared_date, $this->clearingLines($cheque), array_merge(
            $this->baseAttributes($cheque),
            [
                'destination_account_id' => $cheque->cleared_into_account_id,
                'description' => "Cheque #{$cheque->cheque_number} {$type->label()}"
                    .(Money::isPositive($cheque->commission_amount) ? ' (commission '.money($cheque->commission_amount).')' : ''),
                'notes' => $cheque->clearing_reference,
            ]
        ), $cheque);
    }

    private function postClosure(Cheque $cheque, bool $wasCleared): void
    {
        $lines = $wasCleared
            ? LedgerService::reverseLines($this->clearingLines($cheque))
            : [];
        // After reversing clearing the memo is back "in hand"; always close the memo.
        $lines = array_merge($lines, LedgerService::reverseLines($this->memoLines($cheque)));

        $type = $cheque->status === ChequeStatus::Cancelled ? TransactionType::ChequeCancel : TransactionType::ChequeBounce;

        $this->ledger->post($type, $cheque->closed_date ?? now(), $lines, array_merge(
            $this->baseAttributes($cheque),
            [
                'source_account_id' => $wasCleared ? $cheque->cleared_into_account_id : null,
                'description' => "Cheque #{$cheque->cheque_number} {$type->label()}",
                'notes' => $cheque->closed_reason,
            ]
        ), $cheque);
    }

    // ------------------------------------------------------------------
    // Field preparation & validation of business rules
    // ------------------------------------------------------------------

    private function receiptFields(array $data): array
    {
        $amount = Money::of($data['amount']);
        if (! Money::isPositive($amount)) {
            throw new BusinessRuleException('Cheque amount must be greater than zero.', 'amount');
        }

        return [
            'company_id' => $data['company_id'],
            'government_department_id' => $data['government_department_id'] ?: null,
            'cheque_number' => trim($data['cheque_number']),
            'issuing_bank' => trim($data['issuing_bank']),
            'issuing_branch' => $data['issuing_branch'] ?? null,
            'amount' => $amount,
            'cheque_date' => $data['cheque_date'],
            'expiry_date' => Cheque::expiryFor($data['cheque_date']),
            'received_date' => $data['received_date'],
            'scan_path' => $data['scan_path'] ?? null,
            'notes' => $data['notes'] ?? null,
        ];
    }

    private function clearingFields(Cheque $cheque, array $data): array
    {
        $method = ClearingMethod::from($data['clearing_method']);
        $account = BankAccount::find($data['cleared_into_account_id'] ?? null);

        if ($method === ClearingMethod::Encashment) {
            $account = BankAccount::vault();
            if (! $account) {
                throw new BusinessRuleException('Create the Cash Vault account before encashing cheques.', 'clearing_method');
            }
        } elseif (! $account || $account->type !== BankAccountType::Bank) {
            throw new BusinessRuleException('Choose one of your bank accounts to deposit into.', 'cleared_into_account_id');
        }

        $amount = Money::of($cheque->amount);
        $type = filled($data['commission_type'] ?? null) ? CommissionType::from($data['commission_type']) : null;
        $rate = $type ? Money::of($data['commission_rate'] ?? 0) : null;

        $commission = match ($type) {
            CommissionType::Percent => Money::percent($amount, $data['commission_rate'] ?? 0),
            CommissionType::Fixed => Money::of($data['commission_rate'] ?? 0),
            null => '0.00',
        };

        if ($type === CommissionType::Percent && (Money::cmp($rate, 0) < 0 || Money::cmp($rate, 100) > 0)) {
            throw new BusinessRuleException('Commission percentage must be between 0 and 100.', 'commission_rate');
        }

        $charges = Money::of($data['bank_charges'] ?? 0);

        if (Money::isNegative($commission) || Money::cmp($commission, $amount) > 0) {
            throw new BusinessRuleException('Commission cannot exceed the cheque amount.', 'commission_rate');
        }

        if (Money::isNegative($charges) || Money::cmp($charges, $amount) >= 0) {
            throw new BusinessRuleException('Bank charges must be less than the cheque amount.', 'bank_charges');
        }

        $date = $data['cleared_date'] ?? now()->toDateString();
        if ($cheque->received_date && $cheque->received_date->gt(\Illuminate\Support\Carbon::parse($date))) {
            throw new BusinessRuleException('Clearing date cannot be before the received date.', 'cleared_date');
        }

        return [
            'clearing_method' => $method,
            'cleared_into_account_id' => $account->id,
            'cleared_date' => $date,
            'commission_type' => $type,
            'commission_rate' => $type ? $data['commission_rate'] : null,
            'commission_amount' => $commission,
            'bank_charges' => $charges,
            'clearing_reference' => $data['clearing_reference'] ?? null,
        ];
    }

    private function assertStatus(Cheque $cheque, array $allowed, string $message): void
    {
        if (! in_array($cheque->status, $allowed, true)) {
            throw new BusinessRuleException($message.' Current status: '.$cheque->status->label().'.');
        }
    }
}
