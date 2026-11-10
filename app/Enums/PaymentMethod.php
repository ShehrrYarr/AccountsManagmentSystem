<?php

namespace App\Enums;

/**
 * How money was spent for a department.
 */
enum PaymentMethod: string
{
    use HasOptions;

    case Cash = 'cash';
    case BankTransfer = 'bank_transfer';
    case Goods = 'goods';

    public function label(): string
    {
        return match ($this) {
            self::Cash => 'Cash given',
            self::BankTransfer => 'Bank transfer',
            self::Goods => 'Goods purchased',
        };
    }

    public function hint(): string
    {
        return match ($this) {
            self::Cash => 'Handed over from cash in hand',
            self::BankTransfer => 'Sent from one of the company’s banks',
            self::Goods => 'Bought from a supplier for the department',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Cash => 'ri-hand-coin-line',
            self::BankTransfer => 'ri-bank-line',
            self::Goods => 'ri-shopping-cart-2-line',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Cash => 'bg-success-subtle text-success',
            self::BankTransfer => 'bg-primary-subtle text-primary',
            self::Goods => 'bg-warning-subtle text-warning',
        };
    }
}
