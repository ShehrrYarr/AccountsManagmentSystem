<?php

namespace App\Services;

/**
 * Result of a user action that may need admin approval.
 */
enum Outcome: string
{
    case Done = 'done';
    case PendingApproval = 'pending_approval';

    public function message(string $done, string $what = 'Your request'): string
    {
        return $this === self::Done ? $done : "{$what} was sent to an administrator for approval.";
    }

    public function toastType(): string
    {
        return $this === self::Done ? 'success' : 'info';
    }
}
