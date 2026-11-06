<?php

namespace App\Enums;

enum TransactionStatus: string
{
    use HasOptions;

    case Posted = 'posted';
    case Void = 'void';

    public function label(): string
    {
        return match ($this) {
            self::Posted => 'Posted',
            self::Void => 'Void',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Posted => 'bg-success-subtle text-success',
            self::Void => 'bg-secondary-subtle text-secondary',
        };
    }
}
