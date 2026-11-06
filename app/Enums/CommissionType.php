<?php

namespace App\Enums;

enum CommissionType: string
{
    use HasOptions;

    case Percent = 'percent';
    case Fixed = 'fixed';

    public function label(): string
    {
        return match ($this) {
            self::Percent => 'Percentage (%)',
            self::Fixed => 'Fixed Amount (Rs.)',
        };
    }
}
