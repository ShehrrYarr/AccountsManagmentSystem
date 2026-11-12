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
 * The deposit date is the day it is saved (unless given, e.g. by the demo seeder); an edit
 * keeps the original date. Govt cheques don't bounce; mistakes are fixed by editing or deleting.
 */
class ChequeService
{
    use ChecksDocuments;

    private const FIELDS = [
        'company_id', 'department_id', 'cheque_number', 'issuing_branch', 'amount', 'cheque_date',
        'date', 'deposit_account_id', 'bank_charges', 'deposit_reference', 'scan_path', 'notes',
    ];

    public function __construct(private LedgerService $ledger) {}

    public function save(?Cheque $cheque, array $data, ?User $by = null): Cheque
    {
        $cheque = $this->prepare($cheque, $data, $by);

        return $this->ledger->record($cheque);
    }

    /**
     * Save several new cheques all-or-nothing. A failing row is reported as a
     * BusinessRuleException whose field is "rows.<index>".
     *
     * @param  array<int, array<string, mixed>>  $rows
     * @return array<int, Cheque>
     */
    public function saveMany(array $rows, ?User $by = null): array
    {
        return $this->ledger->batch(function () use ($rows, $by) {
            $saved = [];
            foreach ($rows as $i => $row) {
                try {
                    $saved[] = $this->save(null, $row, $by);
                } catch (BusinessRuleException $e) {
                    throw new BusinessRuleException($e->getMessage(), "rows.{$i}");
                }
            }

            return $saved;
        });
    }

    /**
     * Run every check a save would, without saving: before adding a cheque to the batch table,
     * or before an agent's edit request (on a copy of the saved cheque).
     */
    public function check(array $data, ?Cheque $cheque = null): Cheque
    {
        return $this->prepare($cheque ? clone $cheque : null, $data, null);
    }

    public function delete(Cheque $cheque): void
    {
        $this->ledger->remove($cheque);
    }

    private function prepare(?Cheque $cheque, array $data, ?User $by): Cheque
    {
        $cheque ??= new Cheque(['created_by' => $by?->id ?? auth()->id()]);

        $fields = Arr::only($data, self::FIELDS);
        if (array_key_exists('scan_path', $fields) && blank($fields['scan_path'])) {
            unset($fields['scan_path']); // keep the existing scan
        }
        if (array_key_exists('bank_charges', $fields)) {
            $fields['bank_charges'] = Money::of($fields['bank_charges']); // blank → 0.00
        }
        if (blank($fields['date'] ?? null)) {
            unset($fields['date']); // an edit keeps its date
        }

        $cheque->fill($fields);
        $cheque->date ??= now()->toDateString(); // deposited the day it is entered
        $cheque->amount = $this->positiveAmount($cheque->amount);
        $cheque->bank_charges = Money::of($cheque->bank_charges);
        $cheque->cheque_number = trim((string) $cheque->cheque_number);
        $cheque->issuing_branch = filled($cheque->issuing_branch) ? trim($cheque->issuing_branch) : null;

        $duplicate = Cheque::where('cheque_number', $cheque->cheque_number)
            ->when($cheque->exists, fn ($q) => $q->whereKeyNot($cheque->getKey()))
            ->exists();
        if ($duplicate) {
            throw new BusinessRuleException("Cheque #{$cheque->cheque_number} is already entered.", 'cheque_number');
        }

        $this->accountOf((int) $cheque->company_id, $cheque->deposit_account_id, AccountType::Bank, 'deposit_account_id', $cheque->getOriginal('deposit_account_id'));

        if (Money::isNegative($cheque->bank_charges) || Money::cmp($cheque->bank_charges, $cheque->amount) >= 0) {
            throw new BusinessRuleException('Bank charges must be less than the cheque amount.', 'bank_charges');
        }

        $chequeDate = Carbon::parse($cheque->cheque_date)->startOfDay();
        $date = Carbon::parse($cheque->date)->startOfDay();

        if ($date->lt($chequeDate)) {
            throw new BusinessRuleException('The cheque date cannot be after the deposit date ('.$date->format('d M Y').').', 'cheque_date');
        }

        $expiry = Cheque::expiryFor($chequeDate);
        if ($date->gt($expiry)) {
            throw new BusinessRuleException('This cheque expired on '.$expiry->format('d M Y').' (6 months after its date) and cannot be deposited.', 'cheque_date');
        }

        return $cheque;
    }
}
