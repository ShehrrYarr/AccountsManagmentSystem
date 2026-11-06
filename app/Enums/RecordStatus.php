<?php

namespace App\Enums;

/**
 * Lifecycle of user-entered money movements that may need admin approval.
 */
enum RecordStatus: string
{
    use HasOptions;

    case PendingApproval = 'pending_approval';
    case Posted = 'posted';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PendingApproval => 'Awaiting Approval',
            self::Posted => 'Posted',
            self::Rejected => 'Rejected',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::PendingApproval => 'bg-warning-subtle text-warning',
            self::Posted => 'bg-success-subtle text-success',
            self::Rejected => 'bg-danger-subtle text-danger',
        };
    }
}
