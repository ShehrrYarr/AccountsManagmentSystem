<?php

namespace App\Enums;

enum ChequeStatus: string
{
    use HasOptions;

    case Received = 'received';
    case Cleared = 'cleared';
    case Bounced = 'bounced';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Received => 'Pending Clearing',
            self::Cleared => 'Cleared',
            self::Bounced => 'Bounced',
            self::Cancelled => 'Cancelled',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Received => 'bg-warning-subtle text-warning',
            self::Cleared => 'bg-success-subtle text-success',
            self::Bounced => 'bg-danger-subtle text-danger',
            self::Cancelled => 'bg-secondary-subtle text-secondary',
        };
    }
}
