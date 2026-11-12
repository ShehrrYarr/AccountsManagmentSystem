<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Transfer;
use App\Services\Concerns\ChecksDocuments;
use Illuminate\Support\Arr;

/**
 * Moving money between two accounts, within one company or between my companies.
 */
class TransferService
{
    use ChecksDocuments;

    public function __construct(private LedgerService $ledger) {}

    public function save(?Transfer $transfer, array $data): Transfer
    {
        $transfer ??= new Transfer(['created_by' => auth()->id()]);
        $transfer->fill(Arr::only($data, ['from_company_id', 'from_account_id', 'to_company_id', 'to_account_id', 'amount', 'date', 'reference', 'notes']));
        $transfer->amount = $this->positiveAmount($transfer->amount);

        $from = Account::find($transfer->from_account_id);
        $to = Account::find($transfer->to_account_id);

        // A bank names its own company; the admin's cash is shared, so the form says which company.
        $transfer->from_company_id = $from?->company_id ?? $transfer->from_company_id;
        $transfer->to_company_id = $to?->company_id ?? ($transfer->to_company_id ?: $transfer->from_company_id);
        if (! $transfer->from_company_id) {
            throw new BusinessRuleException('Choose the company the money leaves from.', 'from_company_id');
        }

        if (! $from) {
            throw new BusinessRuleException('Choose the account the money leaves from.', 'from_account_id');
        }
        if (! $to) {
            throw new BusinessRuleException('Choose the account the money goes to.', 'to_account_id');
        }
        if ($from->id === $to->id) {
            throw new BusinessRuleException('Choose two different accounts.', 'to_account_id');
        }

        $this->accountOf((int) $transfer->from_company_id, $from->id, null, 'from_account_id', $transfer->getOriginal('from_account_id'));
        $this->accountOf((int) $transfer->to_company_id, $to->id, null, 'to_account_id', $transfer->getOriginal('to_account_id'));

        return $this->ledger->record($transfer);
    }

    public function delete(Transfer $transfer): void
    {
        $this->ledger->remove($transfer);
    }
}
