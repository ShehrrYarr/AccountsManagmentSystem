<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\ChequeStatus;
use App\Exceptions\BusinessRuleException;
use App\Models\Cheque;
use App\Models\User;
use App\Services\Concerns\ChecksDocuments;
use App\Support\Money;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * Government cheques:  In hand  →  Deposited (one step, into the same company's bank).
 * Govt cheques don't bounce; mistakes are fixed by editing, undoing the deposit or deleting.
 */
class ChequeService
{
    use ChecksDocuments;

    public function __construct(private LedgerService $ledger) {}

    /** Register a new cheque or edit an existing one (receipt details). */
    public function save(?Cheque $cheque, array $data, ?User $by = null): Cheque
    {
        return $this->ledger->batch(function () use ($cheque, $data, $by) {
            $cheque ??= new Cheque(['status' => ChequeStatus::InHand, 'created_by' => $by?->id ?? auth()->id()]);

            $fields = Arr::only($data, [
                'company_id', 'department_id', 'cheque_number', 'issuing_bank', 'issuing_branch', 'amount',
                'cheque_date', 'received_date', 'scan_path', 'notes',
            ]);
            if (array_key_exists('scan_path', $fields) && blank($fields['scan_path'])) {
                unset($fields['scan_path']); // keep the existing scan
            }

            $cheque->fill($fields);
            $cheque->amount = $this->positiveAmount($cheque->amount);
            $cheque->cheque_number = trim($cheque->cheque_number);
            $cheque->expiry_date = Cheque::expiryFor($cheque->cheque_date);

            if ($cheque->isDeposited()) {
                if ($cheque->isDirty('company_id')) {
                    throw new BusinessRuleException('Undo the deposit before moving this cheque to another company.', 'company_id');
                }
                $this->checkDeposit($cheque);
            }

            return $this->ledger->record($cheque);
        });
    }

    /** Deposit (and clear) a cheque into one of the same company's bank accounts. Also edits a deposit. */
    public function deposit(Cheque $cheque, array $data): Cheque
    {
        return $this->ledger->batch(function () use ($cheque, $data) {
            $cheque->fill([
                'status' => ChequeStatus::Deposited,
                'deposit_account_id' => $data['deposit_account_id'] ?? null,
                'deposited_date' => $data['deposited_date'] ?? now()->toDateString(),
                'bank_charges' => Money::of($data['bank_charges'] ?? 0),
                'deposit_reference' => $data['deposit_reference'] ?? null,
            ]);
            $this->checkDeposit($cheque);

            return $this->ledger->record($cheque);
        });
    }

    /** Put a deposited cheque back in hand (entered by mistake). */
    public function undoDeposit(Cheque $cheque): Cheque
    {
        if (! $cheque->isDeposited()) {
            throw new BusinessRuleException('This cheque has not been deposited.');
        }

        $cheque->fill([
            'status' => ChequeStatus::InHand,
            'deposit_account_id' => null,
            'deposited_date' => null,
            'bank_charges' => 0,
            'deposit_reference' => null,
        ]);

        return $this->ledger->record($cheque);
    }

    public function delete(Cheque $cheque): void
    {
        $this->ledger->remove($cheque);
    }

    private function checkDeposit(Cheque $cheque): void
    {
        $this->accountOf((int) $cheque->company_id, $cheque->deposit_account_id, AccountType::Bank, 'deposit_account_id', $cheque->getOriginal('deposit_account_id'));

        $charges = Money::of($cheque->bank_charges);
        if (Money::isNegative($charges) || Money::cmp($charges, $cheque->amount) >= 0) {
            throw new BusinessRuleException('Bank charges must be less than the cheque amount.', 'bank_charges');
        }

        if (Carbon::parse($cheque->deposited_date)->lt(Carbon::parse($cheque->received_date)->startOfDay())) {
            throw new BusinessRuleException('Deposit date cannot be before the date the cheque was received.', 'deposited_date');
        }
    }
}
