<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\DealClosing;
use App\Models\OpeningBalance;
use App\Support\Money;
use Illuminate\Support\Arr;

/**
 * Closing department deals (balance → profit / loss) and department / supplier opening balances.
 */
class DealService
{
    public function __construct(private LedgerService $ledger) {}

    /**
     * Close the deal with a department for one company: whatever balance is left on the
     * closing date becomes profit (cheques exceeded spending) or loss.
     */
    public function close(?DealClosing $closing, array $data): DealClosing
    {
        return $this->ledger->batch(function () use ($closing, $data) {
            $closing ??= new DealClosing(['created_by' => auth()->id()]);
            $this->ledger->voidAllFor($closing); // measure the balance without this closing

            $closing->fill(Arr::only($data, ['company_id', 'department_id', 'date', 'notes']));
            $balance = Balances::departmentBalance((int) $closing->department_id, (int) $closing->company_id, $closing->date);

            if (Money::isZero($balance)) {
                throw new BusinessRuleException('This department’s balance is already zero on that date — nothing to close.', 'department_id');
            }

            // Balance < 0 means cheques exceeded what I spent: that surplus is profit.
            $closing->amount = Money::sub(0, $balance);

            return $this->ledger->record($closing);
        });
    }

    public function deleteClosing(DealClosing $closing): void
    {
        $this->ledger->remove($closing);
    }

    public function saveOpening(?OpeningBalance $opening, array $data): OpeningBalance
    {
        $opening ??= new OpeningBalance(['created_by' => auth()->id()]);
        $opening->fill(Arr::only($data, ['company_id', 'department_id', 'supplier_id', 'account_id', 'amount', 'date', 'notes']));
        $opening->amount = Money::of($opening->amount);

        if (count(array_filter([$opening->department_id, $opening->supplier_id, $opening->account_id])) !== 1) {
            throw new BusinessRuleException('Choose a department, a supplier, cash in hand or an agent account.', 'party');
        }

        $account = $opening->account_id ? Account::find($opening->account_id) : null;
        if ($opening->account_id && ! ($account?->isAdminCash() || $account?->isAgentAccount())) {
            throw new BusinessRuleException('An opening balance on an account goes on the admin cash in hand or an agent account.', 'party');
        }

        if (Money::isZero($opening->amount)) {
            throw new BusinessRuleException('Amount cannot be zero.', 'amount');
        }

        if ($opening->account_id && Money::isNegative($opening->amount)) {
            throw new BusinessRuleException($account->isAgentAccount() ? 'What an agent holds cannot open below zero.' : 'Cash in hand cannot open below zero.', 'amount');
        }

        if ($opening->supplier_id && Money::isNegative($opening->amount)) {
            throw new BusinessRuleException('A supplier opening balance is what you owe them, so it must be positive.', 'amount');
        }

        $duplicate = OpeningBalance::where('company_id', $opening->company_id)
            ->when($opening->department_id, fn ($q) => $q->where('department_id', $opening->department_id))
            ->when($opening->supplier_id, fn ($q) => $q->where('supplier_id', $opening->supplier_id))
            ->when($opening->account_id, fn ($q) => $q->where('account_id', $opening->account_id))
            ->when($opening->exists, fn ($q) => $q->whereKeyNot($opening->id))
            ->exists();

        if ($duplicate) {
            throw new BusinessRuleException('This company already has an opening balance for '.$opening->partyName().'. Edit that one instead.', 'party');
        }

        return $this->ledger->record($opening);
    }

    public function deleteOpening(OpeningBalance $opening): void
    {
        $this->ledger->remove($opening);
    }
}
