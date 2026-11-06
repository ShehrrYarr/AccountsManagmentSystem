<?php

namespace App\Services;

use App\Enums\AdjustmentKind;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Exceptions\BusinessRuleException;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\CompanyAdjustment;
use App\Models\User;
use App\Support\Money;

/**
 * Manual corrections of a company's payable / receivable. Administrator only
 * (enforced by the UI and the adjustments policy). This is the only way a
 * receivable (company owes me) is created.
 */
class AdjustmentService
{
    public function __construct(private LedgerService $ledger) {}

    public function create(array $data, User $by): CompanyAdjustment
    {
        $this->authorize($by);
        $fields = $this->prepare($data);

        return $this->ledger->batch(function () use ($fields, $by) {
            $adj = CompanyAdjustment::create(array_merge($fields, ['created_by' => $by->id]));
            $this->post($adj);

            return $adj;
        });
    }

    public function update(CompanyAdjustment $adj, array $data, User $by): CompanyAdjustment
    {
        $this->authorize($by);

        return $this->ledger->batch(function () use ($adj, $data) {
            $this->ledger->voidAllFor($adj);
            $adj->update($this->prepare($data));
            $this->post($adj->fresh());

            return $adj;
        });
    }

    public function delete(CompanyAdjustment $adj, User $by): void
    {
        $this->authorize($by);

        $this->ledger->batch(function () use ($adj) {
            $this->ledger->voidAllFor($adj);
            $adj->delete();
        });
    }

    private function post(CompanyAdjustment $a): void
    {
        $c = $a->company_id;
        $amt = $a->amount;

        $lines = match ($a->kind) {
            AdjustmentKind::ReceivableCharge => [
                ['account' => LedgerAccount::CompanyReceivable, 'debit' => $amt, 'company_id' => $c],
                ['account' => LedgerAccount::Adjustments, 'credit' => $amt, 'company_id' => $c],
            ],
            AdjustmentKind::ReceivableSettlement => [
                $a->bank_account_id
                    ? ['account' => LedgerAccount::Bank, 'debit' => $amt, 'bank_account_id' => $a->bank_account_id]
                    : ['account' => LedgerAccount::Adjustments, 'debit' => $amt, 'company_id' => $c],
                ['account' => LedgerAccount::CompanyReceivable, 'credit' => $amt, 'company_id' => $c],
            ],
            AdjustmentKind::PayableCredit => [
                ['account' => LedgerAccount::Adjustments, 'debit' => $amt, 'company_id' => $c],
                ['account' => LedgerAccount::CompanyPayable, 'credit' => $amt, 'company_id' => $c],
            ],
            AdjustmentKind::PayableDebit => [
                ['account' => LedgerAccount::CompanyPayable, 'debit' => $amt, 'company_id' => $c],
                ['account' => LedgerAccount::Adjustments, 'credit' => $amt, 'company_id' => $c],
            ],
            // Money already paid to the company that it now owes back:
            // raises both sides so a bounce reversal can be posted.
            AdjustmentKind::OverpaidToReceivable => [
                ['account' => LedgerAccount::CompanyReceivable, 'debit' => $amt, 'company_id' => $c],
                ['account' => LedgerAccount::CompanyPayable, 'credit' => $amt, 'company_id' => $c],
            ],
        };

        $this->ledger->post(TransactionType::Adjustment, $a->date, $lines, [
            'company_id' => $c,
            'destination_account_id' => $a->bank_account_id,
            'description' => $a->kind->shortLabel().': '.mb_substr($a->reason, 0, 200),
        ], $a);
    }

    private function prepare(array $data): array
    {
        $kind = $data['kind'] instanceof AdjustmentKind ? $data['kind'] : AdjustmentKind::from($data['kind']);
        $amount = Money::of($data['amount'] ?? 0);

        if (! Company::find($data['company_id'] ?? null)) {
            throw new BusinessRuleException('Select a company.', 'company_id');
        }
        if (! Money::isPositive($amount)) {
            throw new BusinessRuleException('Amount must be greater than zero.', 'amount');
        }
        if (blank($data['reason'] ?? null)) {
            throw new BusinessRuleException('Give a reason for this adjustment.', 'reason');
        }

        $accountId = $kind === AdjustmentKind::ReceivableSettlement ? ($data['bank_account_id'] ?? null) : null;
        if ($accountId && ! BankAccount::find($accountId)) {
            throw new BusinessRuleException('Unknown account.', 'bank_account_id');
        }

        return [
            'company_id' => $data['company_id'],
            'kind' => $kind,
            'amount' => $amount,
            'date' => $data['date'] ?? now()->toDateString(),
            'bank_account_id' => $accountId ?: null,
            'reason' => $data['reason'],
        ];
    }

    private function authorize(User $by): void
    {
        if (! $by->isAdmin()) {
            throw new BusinessRuleException('Only administrators can record adjustments.');
        }
    }
}
