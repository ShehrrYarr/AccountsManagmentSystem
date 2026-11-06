<?php

namespace App\Enums;

enum ClearingMethod: string
{
    use HasOptions;

    case Deposit = 'deposit';
    case Encashment = 'encashment';

    public function label(): string
    {
        return match ($this) {
            self::Deposit => 'Bank Deposit',
            self::Encashment => 'Over-the-Counter Encashment',
        };
    }

    public function transactionType(): TransactionType
    {
        return match ($this) {
            self::Deposit => TransactionType::ChequeDeposit,
            self::Encashment => TransactionType::ChequeEncashment,
        };
    }
}
