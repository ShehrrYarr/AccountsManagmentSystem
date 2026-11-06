<?php

namespace App\Enums;

enum AdjustmentKind: string
{
    use HasOptions;

    case ReceivableCharge = 'receivable_charge';
    case ReceivableSettlement = 'receivable_settlement';
    case PayableCredit = 'payable_credit';
    case PayableDebit = 'payable_debit';
    case OverpaidToReceivable = 'overpaid_to_receivable';

    public function label(): string
    {
        return match ($this) {
            self::OverpaidToReceivable => 'Company was overpaid (e.g. bounced cheque): move amount to receivable',
            self::ReceivableCharge => 'Company owes me more (increase receivable)',
            self::ReceivableSettlement => 'Company repaid me (decrease receivable)',
            self::PayableCredit => 'I owe company more (increase payable)',
            self::PayableDebit => 'I owe company less (decrease payable)',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::ReceivableCharge => 'Receivable +',
            self::ReceivableSettlement => 'Receivable -',
            self::PayableCredit => 'Payable +',
            self::PayableDebit => 'Payable -',
            self::OverpaidToReceivable => 'Overpaid → Receivable',
        };
    }
}
