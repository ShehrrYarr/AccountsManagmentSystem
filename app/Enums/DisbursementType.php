<?php

namespace App\Enums;

enum DisbursementType: string
{
    use HasOptions;

    case CashPayout = 'cash_payout';
    case BankTransfer = 'bank_transfer';
    case VendorPurchase = 'vendor_purchase';

    public function label(): string
    {
        return match ($this) {
            self::CashPayout => 'Cash Payout',
            self::BankTransfer => 'Bank Transfer',
            self::VendorPurchase => 'Direct Purchase',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::CashPayout => 'ri-hand-coin-line',
            self::BankTransfer => 'ri-exchange-funds-line',
            self::VendorPurchase => 'ri-shopping-bag-3-line',
        };
    }

    public function transactionType(): TransactionType
    {
        return match ($this) {
            self::CashPayout => TransactionType::CompanyCashOut,
            self::BankTransfer => TransactionType::CompanyTransfer,
            self::VendorPurchase => TransactionType::VendorPurchase,
        };
    }
}
