<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use App\Enums\DisbursementType;
use App\Enums\RecordStatus;
use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Money going out to (or spent on behalf of) a company.
 */
class Disbursement extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id', 'type', 'source_account_id', 'vendor_id', 'amount', 'date', 'reference',
        'received_by', 'item_description', 'receipt_path', 'notes', 'status', 'created_by',
        'approved_by', 'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => DisbursementType::class,
            'status' => RecordStatus::class,
            'amount' => 'decimal:2',
            'date' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function sourceAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'source_account_id')->withTrashed();
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(DisbursementLine::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
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

    public function scopePosted(Builder $q): Builder
    {
        return $q->where('status', RecordStatus::Posted);
    }

    public function isPosted(): bool
    {
        return $this->status === RecordStatus::Posted;
    }
}
