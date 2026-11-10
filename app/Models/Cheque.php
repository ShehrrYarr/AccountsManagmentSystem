<?php

namespace App\Models;

use App\Enums\ChequeStatus;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Contracts\PostsToLedger;
use App\Support\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Government cheque received by one of my companies for a department.
 *
 *   Received  : Dr Cheques in hand            / Cr Department        (department's balance drops at once)
 *   Deposited : Dr Bank (amount − charges)
 *               Dr Bank charges               / Cr Cheques in hand
 */
class Cheque extends Model implements PostsToLedger
{
    use Auditable, HasFactory, SoftDeletes;

    /** Pakistani cheques are valid for 6 months from the cheque date. */
    public const VALIDITY_MONTHS = 6;

    public const EXPIRY_WARNING_DAYS = 15;

    protected $fillable = [
        'company_id', 'department_id', 'cheque_number', 'issuing_bank', 'issuing_branch', 'amount',
        'cheque_date', 'expiry_date', 'received_date', 'scan_path', 'status', 'notes',
        'deposit_account_id', 'deposited_date', 'bank_charges', 'deposit_reference', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'bank_charges' => 'decimal:2',
            'cheque_date' => 'date',
            'expiry_date' => 'date',
            'received_date' => 'date',
            'deposited_date' => 'date',
            'status' => ChequeStatus::class,
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

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'source');
    }

    public function scopeInHand(Builder $q): Builder
    {
        return $q->where('status', ChequeStatus::InHand);
    }

    public function scopeDeposited(Builder $q): Builder
    {
        return $q->where('status', ChequeStatus::Deposited);
    }

    public function isDeposited(): bool
    {
        return $this->status === ChequeStatus::Deposited;
    }

    /** What actually landed in the bank. */
    public function netDeposit(): string
    {
        return Money::sub($this->amount, $this->bank_charges);
    }

    public function isExpired(): bool
    {
        return $this->status === ChequeStatus::InHand && $this->expiry_date->endOfDay()->isPast();
    }

    public function isNearExpiry(): bool
    {
        return $this->status === ChequeStatus::InHand
            && ! $this->isExpired()
            && $this->expiry_date->lte(now()->addDays(self::EXPIRY_WARNING_DAYS));
    }

    public static function expiryFor(\DateTimeInterface|string $chequeDate): string
    {
        return Carbon::parse($chequeDate)->addMonthsNoOverflow(self::VALIDITY_MONTHS)->toDateString();
    }

    public function ledgerPostings(): array
    {
        $dept = $this->department?->name ?? 'department';
        $base = [
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'reference' => $this->cheque_number,
            'amount' => $this->amount,
        ];

        $postings = [[
            'type' => TransactionType::ChequeReceived,
            'date' => $this->received_date,
            'lines' => [
                ['account' => LedgerAccount::ChequesInHand, 'debit' => $this->amount, 'company_id' => $this->company_id],
                ['account' => LedgerAccount::Department, 'credit' => $this->amount, 'company_id' => $this->company_id, 'department_id' => $this->department_id],
            ],
            'attributes' => $base + [
                'description' => "Govt cheque #{$this->cheque_number} received for {$dept}",
                'notes' => $this->notes,
            ],
        ]];

        if ($this->isDeposited()) {
            $account = $this->depositAccount;
            $charges = Money::isPositive($this->bank_charges) ? ' (bank charges '.money($this->bank_charges).')' : '';
            $postings[] = [
                'type' => TransactionType::ChequeDeposit,
                'date' => $this->deposited_date,
                'lines' => [
                    ['account' => LedgerAccount::Money, 'debit' => $this->netDeposit(), 'account_id' => $this->deposit_account_id, 'company_id' => $this->company_id],
                    ['account' => LedgerAccount::BankCharges, 'debit' => $this->bank_charges, 'company_id' => $this->company_id],
                    ['account' => LedgerAccount::ChequesInHand, 'credit' => $this->amount, 'company_id' => $this->company_id],
                ],
                'attributes' => $base + [
                    'to_account_id' => $this->deposit_account_id,
                    'description' => "Cheque #{$this->cheque_number} ({$dept}) deposited into {$account?->shortLabel()}{$charges}",
                    'notes' => $this->deposit_reference,
                ],
            ];
        }

        return $postings;
    }
}
