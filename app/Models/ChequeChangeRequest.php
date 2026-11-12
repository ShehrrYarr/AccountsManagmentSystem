<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * An agent asking the admin to edit or delete a cheque they entered. Nothing changes until the
 * admin approves; the cheque keeps its old values meanwhile.
 */
class ChequeChangeRequest extends Model
{
    public const PENDING = 'pending';

    public const APPROVED = 'approved';

    public const REJECTED = 'rejected';

    /** Fields an edit request may change, with their labels (in form order). */
    public const FIELDS = [
        'cheque_date' => 'Cheque date',
        'company_id' => 'Company',
        'deposit_account_id' => 'Bank',
        'issuing_branch' => 'Branch code',
        'department_id' => 'Department',
        'cheque_number' => 'Cheque number',
        'amount' => 'Cheque amount',
        'bank_charges' => 'Bank charges',
        'scan_path' => 'Cheque picture',
        'notes' => 'Notes',
        'deposit_reference' => 'Deposit slip / reference',
    ];

    protected $fillable = ['cheque_id', 'requested_by', 'action', 'changes', 'reason', 'status', 'decided_by', 'decided_at', 'decision_note'];

    protected function casts(): array
    {
        return ['changes' => 'array', 'decided_at' => 'datetime'];
    }

    public function cheque(): BelongsTo
    {
        return $this->belongsTo(Cheque::class)->withTrashed();
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
