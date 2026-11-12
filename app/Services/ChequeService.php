<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Exceptions\BusinessRuleException;
use App\Models\Cheque;
use App\Models\User;
use App\Services\Concerns\ChecksDocuments;
use App\Support\Money;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * Government cheques: entering a cheque deposits it (one step) into the same company's bank.
 * Govt cheques don't bounce; mistakes are fixed by editing or deleting.
 */
class ChequeService
{
    use ChecksDocuments;

    public function __construct(private LedgerService $ledger) {}

    public function save(?Cheque $cheque, array $data, ?User $by = null): Cheque
    {
        $cheque ??= new Cheque(['created_by' => $by?->id ?? auth()->id()]);

        $fields = Arr::only($data, [
            'company_id', 'department_id', 'cheque_number', 'issuing_bank', 'issuing_branch', 'amount', 'cheque_date',
            'date', 'deposit_account_id', 'bank_charges', 'deposit_reference', 'scan_path', 'notes',
        ]);
        if (array_key_exists('scan_path', $fields) && blank($fields['scan_path'])) {
            unset($fields['scan_path']); // keep the existing scan
        }
        if (array_key_exists('bank_charges', $fields)) {
            $fields['bank_charges'] = Money::of($fields['bank_charges']); // blank → 0.00
        }

        $cheque->fill($fields);
        $cheque->amount = $this->positiveAmount($cheque->amount);
        $cheque->bank_charges = Money::of($cheque->bank_charges);
        $cheque->cheque_number = trim($cheque->cheque_number);

        $this->accountOf((int) $cheque->company_id, $cheque->deposit_account_id, AccountType::Bank, 'deposit_account_id', $cheque->getOriginal('deposit_account_id'));

        if (Money::isNegative($cheque->bank_charges) || Money::cmp($cheque->bank_charges, $cheque->amount) >= 0) {
            throw new BusinessRuleException('Bank charges must be less than the cheque amount.', 'bank_charges');
        }

        $chequeDate = Carbon::parse($cheque->cheque_date)->startOfDay();
        $date = Carbon::parse($cheque->date)->startOfDay();

        if ($date->lt($chequeDate)) {
            throw new BusinessRuleException('A cheque cannot be deposited before its cheque date.', 'date');
        }

        $expiry = Cheque::expiryFor($chequeDate);
        if ($date->gt($expiry)) {
            throw new BusinessRuleException('This cheque expired on '.$expiry->format('d M Y').' (6 months after its date) and cannot be deposited.', 'cheque_date');
        }

        return $this->ledger->record($cheque);
    }

    public function delete(Cheque $cheque): void
    {
        $this->ledger->remove($cheque);
    }
}
