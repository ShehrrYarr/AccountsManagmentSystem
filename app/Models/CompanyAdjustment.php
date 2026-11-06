<?php

namespace App\Models;

use App\Enums\AdjustmentKind;
use App\Enums\ApprovalStatus;
use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Manual correction of a company's payable / receivable (admin only).
 */
class CompanyAdjustment extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = ['company_id', 'kind', 'amount', 'date', 'bank_account_id', 'reason', 'created_by'];

    protected function casts(): array
    {
        return [
            'kind' => AdjustmentKind::class,
            'amount' => 'decimal:2',
            'date' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class)->withTrashed();
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
}
