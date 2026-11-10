<?php

namespace App\Enums;

enum AccountType: string
{
    use HasOptions;

    case Cash = 'cash';
    case Bank = 'bank';

    public function label(): string
    {
        return match ($this) {
            self::Cash => 'Cash in hand',
            self::Bank => 'Bank account',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Cash => 'ri-wallet-3-line',
            self::Bank => 'ri-bank-line',
        };
    }
}
