<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use App\Enums\ChequeStatus;
use App\Enums\ClearingMethod;
use App\Enums\CommissionType;
use App\Models\Concerns\Auditable;
use App\Support\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cheque extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    /** Pakistani cheques are valid for 6 months from the cheque date. */
    public const VALIDITY_MONTHS = 6;

    public const EXPIRY_WARNING_DAYS = 15;

    protected $fillable = [
        'company_id', 'government_department_id', 'cheque_number', 'issuing_bank', 'issuing_branch',
        'amount', 'cheque_date', 'expiry_date', 'received_date', 'scan_path', 'status', 'notes',
        'clearing_method', 'cleared_into_account_id', 'cleared_date', 'commission_type', 'commission_rate',
        'commission_amount', 'bank_charges', 'clearing_reference', 'closed_date', 'closed_reason',
        'created_by', 'cleared_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'commission_rate' => 'decimal:4',
            'commission_amount' => 'decimal:2',
            'bank_charges' => 'decimal:2',
            'cheque_date' => 'date',
            'expiry_date' => 'date',
            'received_date' => 'date',
            'cleared_date' => 'date',
            'closed_date' => 'date',
            'status' => ChequeStatus::class,
            'clearing_method' => ClearingMethod::class,
            'commission_type' => CommissionType::class,
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(GovernmentDepartment::class, 'government_department_id');
    }

    public function clearedInto(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'cleared_into_account_id')->withTrashed();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'source');
    }

    public function approvalRequests(): MorphMany
    {
        return $this->morphMany(ApprovalRequest::class, 'subject');
    }

    public function pendingApproval(): ?ApprovalRequest
    {
        return $this->approvalRequests()->where('status', ApprovalStatus::Pending)->latest()->first();
    }

    public function scopePending(Builder $q): Builder
    {
        return $q->where('status', ChequeStatus::Received);
    }

    public function scopeCleared(Builder $q): Builder
    {
        return $q->where('status', ChequeStatus::Cleared);
    }

    /** Amount credited to the company (cheque amount minus my commission). */
    public function netToCompany(): string
    {
        return Money::sub($this->amount, $this->commission_amount);
    }

    /** Amount that actually landed in my account (cheque amount minus bank charges). */
    public function netToAccount(): string
    {
        return Money::sub($this->amount, $this->bank_charges);
    }

    public function isExpired(): bool
    {
        return $this->status === ChequeStatus::Received && $this->expiry_date->isPast();
    }

    public function isNearExpiry(): bool
    {
        return $this->status === ChequeStatus::Received
            && ! $this->isExpired()
            && $this->expiry_date->lte(now()->addDays(self::EXPIRY_WARNING_DAYS));
    }

    public static function expiryFor(\DateTimeInterface|string $chequeDate): string
    {
        return \Illuminate\Support\Carbon::parse($chequeDate)->addMonthsNoOverflow(self::VALIDITY_MONTHS)->toDateString();
    }
}
