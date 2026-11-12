<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use App\Support\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Government cheque for a department, deposited into one of the same company's banks
 * in a single step:
 *
 *   Dr Bank (amount − charges)
 *   Dr Bank charges            / Cr Department (full amount)
 */
class Cheque extends Model implements PostsToLedger
{
    use Auditable, HasFactory, HasTransactions, SoftDeletes;

    /** Pakistani cheques are valid for 6 months from the cheque date. */
    public const VALIDITY_MONTHS = 6;

    protected $fillable = [
        'company_id', 'department_id', 'cheque_number', 'issuing_branch', 'amount', 'cheque_date',
        'date', 'deposit_account_id', 'bank_charges', 'deposit_reference', 'scan_path', 'notes', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'bank_charges' => 'decimal:2',
            'cheque_date' => 'date',
            'date' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function depositAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'deposit_account_id')->withTrashed();
    }

    /** What actually landed in the bank. */
    public function netDeposit(): string
    {
        return Money::sub($this->amount, $this->bank_charges);
    }

    /** Last day the cheque can be deposited. */
    public static function expiryFor(\DateTimeInterface|string $chequeDate): Carbon
    {
        return Carbon::parse($chequeDate)->addMonthsNoOverflow(self::VALIDITY_MONTHS);
    }

    public function ledgerPostings(): array
    {
        $dept = $this->department?->name ?? 'department';
        $charges = Money::isPositive($this->bank_charges) ? ' (bank charges '.money($this->bank_charges).')' : '';

        return [[
            'type' => TransactionType::ChequeDeposit,
            'date' => $this->date,
            'lines' => [
                ['account' => LedgerAccount::Money, 'debit' => $this->netDeposit(), 'account_id' => $this->deposit_account_id, 'company_id' => $this->company_id],
                ['account' => LedgerAccount::BankCharges, 'debit' => $this->bank_charges, 'company_id' => $this->company_id],
                ['account' => LedgerAccount::Department, 'credit' => $this->amount, 'company_id' => $this->company_id, 'department_id' => $this->department_id],
            ],
            'attributes' => [
                'company_id' => $this->company_id,
                'department_id' => $this->department_id,
                'to_account_id' => $this->deposit_account_id,
                'reference' => $this->cheque_number,
                'amount' => $this->amount,
                'description' => "Govt cheque #{$this->cheque_number} for {$dept} deposited into {$this->depositAccount?->shortLabel()}{$charges}",
                'notes' => collect([$this->deposit_reference ? 'Slip '.$this->deposit_reference : null, $this->notes])->filter()->implode(' · ') ?: null,
            ],
        ]];
    }
}
