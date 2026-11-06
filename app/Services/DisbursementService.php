<?php

namespace App\Services;

use App\Enums\ApprovalAction;
use App\Enums\BankAccountType;
use App\Enums\DisbursementType;
use App\Enums\LedgerAccount;
use App\Enums\RecordStatus;
use App\Exceptions\BusinessRuleException;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\CompanyBankAccount;
use App\Models\Disbursement;
use App\Models\User;
use App\Models\Vendor;
use App\Support\Money;

/**
 * Cash payouts, bank transfers (split across company accounts) and vendor
 * purchases made on a company's behalf.
 *
 * Ledger: Dr Company Payable / Cr Bank(source).  The ledger invariants block
 * paying more than the company is owed, or more than the account holds.
 */
class DisbursementService
{
    public function __construct(
        private LedgerService $ledger,
        private ApprovalService $approvals,
    ) {}

    /**
     * Create a disbursement. Admin: posted immediately. Staff: saved as
     * "awaiting approval" and queued.
     *
     * @param  array  $data  company_id, type, source_account_id, vendor_id, amount, date, reference,
     *                       received_by, item_description, receipt_path, notes, lines[]
     */
    public function create(array $data, User $by): array
    {
        $fields = $this->prepare($data);

        if ($by->needsApproval()) {
            // Early feedback; the definitive check happens again on approval.
            $this->assertAffordable($fields);

            $disbursement = $this->ledger->batch(function () use ($fields, $data, $by) {
                $d = Disbursement::create(array_merge($fields, [
                    'status' => RecordStatus::PendingApproval,
                    'created_by' => $by->id,
                ]));
                $this->syncLines($d, $data['lines'] ?? []);

                return $d;
            });

            $this->approvals->request(ApprovalAction::PostDisbursement, $disbursement, [], $by, $this->summary($disbursement));

            return [$disbursement, Outcome::PendingApproval];
        }

        $disbursement = $this->ledger->batch(function () use ($fields, $data, $by) {
            $d = Disbursement::create(array_merge($fields, [
                'status' => RecordStatus::Posted,
                'created_by' => $by->id,
                'approved_by' => $by->id,
                'approved_at' => now(),
            ]));
            $this->syncLines($d, $data['lines'] ?? []);
            $this->post($d);

            return $d;
        });

        return [$disbursement, Outcome::Done];
    }

    /** Called by ApprovalService when an admin approves a staff disbursement. */
    public function approve(Disbursement $disbursement, User $admin): Disbursement
    {
        return $this->ledger->batch(function () use ($disbursement, $admin) {
            $disbursement->refresh();
            if ($disbursement->status !== RecordStatus::PendingApproval) {
                throw new BusinessRuleException('This disbursement is not awaiting approval.');
            }

            $disbursement->update([
                'status' => RecordStatus::Posted,
                'approved_by' => $admin->id,
                'approved_at' => now(),
            ]);
            $this->post($disbursement);

            return $disbursement;
        });
    }

    public function reject(Disbursement $disbursement): void
    {
        $disbursement->update(['status' => RecordStatus::Rejected]);
    }

    public function update(Disbursement $disbursement, array $data, User $by): Outcome
    {
        $this->prepare($data);

        // A staff member may freely fix their own entry while it is still unapproved.
        $ownPending = $disbursement->status === RecordStatus::PendingApproval && $disbursement->created_by == $by->id;

        if ($by->needsApproval() && ! $ownPending) {
            $this->approvals->request(ApprovalAction::UpdateRecord, $disbursement, $data, $by, 'Edit '.$this->summary($disbursement));

            return Outcome::PendingApproval;
        }

        $this->performUpdate($disbursement, $data);

        return Outcome::Done;
    }

    public function performUpdate(Disbursement $disbursement, array $data): Disbursement
    {
        return $this->ledger->batch(function () use ($disbursement, $data) {
            $disbursement->refresh();
            $fields = $this->prepare($data);
            $wasPosted = $disbursement->isPosted();

            if ($wasPosted) {
                $this->ledger->voidAllFor($disbursement);
            }

            $disbursement->update($fields);
            $this->syncLines($disbursement, $data['lines'] ?? []);

            if ($wasPosted) {
                $this->post($disbursement->fresh());
            }

            return $disbursement;
        });
    }

    public function delete(Disbursement $disbursement, User $by): Outcome
    {
        $ownPending = $disbursement->status === RecordStatus::PendingApproval && $disbursement->created_by == $by->id;

        if ($by->needsApproval() && ! $ownPending) {
            $this->approvals->request(ApprovalAction::DeleteRecord, $disbursement, [], $by, 'Delete '.$this->summary($disbursement));

            return Outcome::PendingApproval;
        }

        $this->performDelete($disbursement);

        return Outcome::Done;
    }

    public function performDelete(Disbursement $disbursement): void
    {
        $this->ledger->batch(function () use ($disbursement) {
            $this->ledger->voidAllFor($disbursement);
            $this->approvals->closePendingFor($disbursement, 'Record deleted.');
            $disbursement->delete();
        });
    }

    public function summary(Disbursement $d): string
    {
        $d->loadMissing('company', 'sourceAccount', 'vendor');
        $what = match ($d->type) {
            DisbursementType::CashPayout => 'cash payout',
            DisbursementType::BankTransfer => 'bank transfer',
            DisbursementType::VendorPurchase => 'purchase from '.($d->vendor?->name ?? 'vendor'),
        };

        return ucfirst($what).' of '.money($d->amount)." to {$d->company->name} from {$d->sourceAccount->name}";
    }

    // ------------------------------------------------------------------

    private function post(Disbursement $d): void
    {
        $d->loadMissing('company', 'vendor', 'lines.companyBankAccount');
        $type = $d->type->transactionType();

        $description = match ($d->type) {
            DisbursementType::CashPayout => "Cash paid to {$d->company->name}".($d->received_by ? " (received by {$d->received_by})" : ''),
            DisbursementType::BankTransfer => "Transfer to {$d->company->name}: ".$d->lines->map(fn ($l) => $l->companyBankAccount->bank_name.' '.$l->companyBankAccount->account_number)->implode(', '),
            DisbursementType::VendorPurchase => "Purchase from {$d->vendor?->name} for {$d->company->name}",
        };

        $this->ledger->post($type, $d->date, [
            ['account' => LedgerAccount::CompanyPayable, 'debit' => $d->amount, 'company_id' => $d->company_id],
            ['account' => LedgerAccount::Bank, 'credit' => $d->amount, 'bank_account_id' => $d->source_account_id],
        ], [
            'company_id' => $d->company_id,
            'source_account_id' => $d->source_account_id,
            'description' => mb_substr($description, 0, 255),
            'notes' => $d->notes,
        ], $d);
    }

    /** Validate business rules for the requested disbursement and return model fields. */
    private function prepare(array $data): array
    {
        $type = $data['type'] instanceof DisbursementType ? $data['type'] : DisbursementType::from($data['type']);
        $amount = Money::of($data['amount'] ?? 0);
        $company = Company::find($data['company_id'] ?? null);
        $source = BankAccount::find($data['source_account_id'] ?? null);

        if (! $company) {
            throw new BusinessRuleException('Select a company.', 'company_id');
        }
        if (! $source || ! $source->is_active) {
            throw new BusinessRuleException('Select an active account to pay from.', 'source_account_id');
        }

        $lines = collect($data['lines'] ?? []);

        if ($type === DisbursementType::BankTransfer) {
            if ($source->type !== BankAccountType::Bank) {
                throw new BusinessRuleException('Bank transfers must be paid from one of your bank accounts.', 'source_account_id');
            }
            if ($lines->isEmpty()) {
                throw new BusinessRuleException('Add at least one company bank account to transfer to.', 'lines');
            }
            $ids = $lines->pluck('company_bank_account_id')->filter();
            if ($ids->count() !== $lines->count() || $ids->unique()->count() !== $ids->count()) {
                throw new BusinessRuleException('Each transfer line needs a different company bank account.', 'lines');
            }
            $owned = CompanyBankAccount::where('company_id', $company->id)->whereIn('id', $ids)->count();
            if ($owned !== $ids->count()) {
                throw new BusinessRuleException('Transfer accounts must belong to the selected company.', 'lines');
            }
            foreach ($lines as $line) {
                if (! Money::isPositive($line['amount'] ?? 0)) {
                    throw new BusinessRuleException('Each transfer line needs an amount greater than zero.', 'lines');
                }
            }
            $amount = Money::add(...$lines->pluck('amount')->all());
        }

        if ($type === DisbursementType::CashPayout && $source->type !== BankAccountType::Cash) {
            throw new BusinessRuleException('Cash payouts are paid from the Cash Vault.', 'source_account_id');
        }

        if ($type === DisbursementType::VendorPurchase && ! Vendor::find($data['vendor_id'] ?? null)) {
            throw new BusinessRuleException('Select the vendor you bought from.', 'vendor_id');
        }

        if (! Money::isPositive($amount)) {
            throw new BusinessRuleException('Amount must be greater than zero.', 'amount');
        }

        return [
            'company_id' => $company->id,
            'type' => $type,
            'source_account_id' => $source->id,
            'vendor_id' => $type === DisbursementType::VendorPurchase ? $data['vendor_id'] : null,
            'amount' => $amount,
            'date' => $data['date'] ?? now()->toDateString(),
            'reference' => $data['reference'] ?? null,
            'received_by' => $type === DisbursementType::CashPayout ? ($data['received_by'] ?? null) : null,
            'item_description' => $type === DisbursementType::VendorPurchase ? ($data['item_description'] ?? null) : null,
            'receipt_path' => $data['receipt_path'] ?? null,
            'notes' => $data['notes'] ?? null,
        ];
    }

    private function assertAffordable(array $fields): void
    {
        $company = Company::find($fields['company_id']);
        $source = BankAccount::find($fields['source_account_id']);

        if (Money::cmp($fields['amount'], $company->payable_balance) > 0) {
            throw new BusinessRuleException("This exceeds what you owe {$company->name}. Payable available: ".money($company->payable_balance).'.', 'amount');
        }
        if (Money::cmp($fields['amount'], $source->current_balance) > 0) {
            throw new BusinessRuleException("Insufficient funds in {$source->name}. Available: ".money($source->current_balance).'.', 'amount');
        }
    }

    private function syncLines(Disbursement $d, array $lines): void
    {
        $d->lines()->delete();

        if ($d->type !== DisbursementType::BankTransfer) {
            return;
        }

        foreach ($lines as $line) {
            $d->lines()->create([
                'company_bank_account_id' => $line['company_bank_account_id'],
                'amount' => Money::of($line['amount']),
                'reference' => $line['reference'] ?? null,
            ]);
        }
    }
}
