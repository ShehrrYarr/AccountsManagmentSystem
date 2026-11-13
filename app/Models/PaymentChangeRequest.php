<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * An agent asking the admin to edit or delete a department payment they made. Nothing changes
 * until the admin approves; the payment keeps its old values meanwhile.
 */
class PaymentChangeRequest extends Model
{
    public const PENDING = 'pending';

    public const APPROVED = 'approved';

    public const REJECTED = 'rejected';

    /** Fields an edit request may change, with their labels (in form order). */
    public const FIELDS = [
        'date' => 'Date',
        'company_id' => 'Company',
        'account_id' => 'Paid from',
        'department_id' => 'Department',
        'amount' => 'Amount',
        'item_description' => 'Description',
        'reference' => 'Reference / slip no.',
        'received_by' => 'Received by',
        'receipt_path' => 'Receipt picture',
        'notes' => 'Notes',
    ];

    protected $fillable = ['payment_id', 'requested_by', 'action', 'changes', 'reason', 'status', 'decided_by', 'decided_at', 'decision_note'];

    protected function casts(): array
    {
        return ['changes' => 'array', 'decided_at' => 'datetime'];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class)->withTrashed();
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function decider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'decided_by');
    }

    public function scopePending(Builder $q): Builder
    {
        return $q->where('status', self::PENDING);
    }

    public function isPending(): bool
    {
        return $this->status === self::PENDING;
    }

    public function isDelete(): bool
    {
        return $this->action === 'delete';
    }
}
