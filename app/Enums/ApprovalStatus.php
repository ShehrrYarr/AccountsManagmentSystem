<?php

namespace App\Enums;

enum ApprovalStatus: string
{
    use HasOptions;

    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return ucfirst($this->value);
    }

    public function badge(): string
    {
        return match ($this) {
            self::Pending => 'bg-warning-subtle text-warning',
            self::Approved => 'bg-success-subtle text-success',
            self::Rejected => 'bg-danger-subtle text-danger',
        };
    }
}
