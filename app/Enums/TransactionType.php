<?php

namespace App\Enums;

enum TransactionType: string
{
    use HasOptions;

    case OpeningBalance = 'opening_balance';
    case ChequeIn = 'cheque_in';
    case ChequeDeposit = 'cheque_deposit';
    case ChequeEncashment = 'cheque_encashment';
    case ChequeBounce = 'cheque_bounce';
    case ChequeCancel = 'cheque_cancel';
    case CompanyCashOut = 'company_cash_out';
    case CompanyTransfer = 'company_transfer';
    case VendorPurchase = 'vendor_purchase';
    case InternalTransfer = 'internal_transfer';
    case Adjustment = 'adjustment';

    public function label(): string
    {
        return match ($this) {
            self::OpeningBalance => 'Opening Balance',
            self::ChequeIn => 'Cheque In',
            self::ChequeDeposit => 'Cheque Deposit',
            self::ChequeEncashment => 'Cheque Encashment',
            self::ChequeBounce => 'Cheque Bounce',
            self::ChequeCancel => 'Cheque Cancelled',
            self::CompanyCashOut => 'Company Cash Out',
            self::CompanyTransfer => 'Company Transfer',
            self::VendorPurchase => 'Vendor Purchase',
            self::InternalTransfer => 'Internal Transfer',
            self::Adjustment => 'Adjustment',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::OpeningBalance => 'bg-secondary-subtle text-secondary',
            self::ChequeIn => 'bg-info-subtle text-info',
            self::ChequeDeposit, self::ChequeEncashment => 'bg-success-subtle text-success',
            self::ChequeBounce, self::ChequeCancel => 'bg-danger-subtle text-danger',
            self::CompanyCashOut, self::CompanyTransfer, self::VendorPurchase => 'bg-warning-subtle text-warning',
            self::InternalTransfer => 'bg-primary-subtle text-primary',
            self::Adjustment => 'bg-dark-subtle text-body',
        };
    }

    /** Money coming in from government cheques. */
    public static function inflows(): array
    {
        return [self::ChequeDeposit, self::ChequeEncashment];
    }

    /** Money paid out to, or on behalf of, companies. */
    public static function outflows(): array
    {
        return [self::CompanyCashOut, self::CompanyTransfer, self::VendorPurchase];
    }
}
