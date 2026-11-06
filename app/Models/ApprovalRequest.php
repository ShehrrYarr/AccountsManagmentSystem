<?php

namespace App\Models;

use App\Enums\ApprovalAction;
use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * A staff action waiting for an administrator's decision.
 * The payload holds everything needed to perform the action on approval.
 */
class ApprovalRequest extends Model
{
    protected $fillable = [
        'action', 'subject_type', 'subject_id', 'payload', 'summary', 'status',
        'requested_by', 'reviewed_by', 'reviewed_at', 'review_notes',
    ];

    protected function casts(): array
    {
        return [
            'action' => ApprovalAction::class,
            'status' => ApprovalStatus::class,
            'payload' => 'array',
            'reviewed_at' => 'datetime',
        ];
    }

    public function subject(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePending(Builder $q): Builder
    {
        return $q->where('status', ApprovalStatus::Pending);
    }
}
