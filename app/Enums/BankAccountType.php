<?php

namespace App\Enums;

enum BankAccountType: string
{
    use HasOptions;

    case Bank = 'bank';
    case Cash = 'cash';

    public function label(): string
    {
        return match ($this) {
            self::Bank => 'Bank Account',
            self::Cash => 'Cash Vault',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Bank => 'ri-bank-line',
            self::Cash => 'ri-safe-2-line',
        };
    }
}
