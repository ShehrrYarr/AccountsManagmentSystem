<?php

namespace App\Enums;

/**
 * Chart of accounts used by the double-entry journal.
 *
 * Bank lines carry a bank_account_id; Company* lines carry a company_id.
 * The two memo accounts track government cheques in hand that have not
 * cleared yet; they net to zero against each other and never touch real
 * balances.
 */
enum LedgerAccount: string
{
    use HasOptions;

    case Bank = 'bank';
    case CompanyPayable = 'company_payable';
    case CompanyReceivable = 'company_receivable';
    case CommissionIncome = 'commission_income';
    case BankCharges = 'bank_charges';
    case Adjustments = 'adjustments';
    case OpeningEquity = 'opening_equity';
    case ChequesInHand = 'cheques_in_hand';
    case ChequesPending = 'cheques_pending';

    public function label(): string
    {
        return match ($this) {
            self::Bank => 'Bank / Cash Account',
            self::CompanyPayable => 'Company Payable',
            self::CompanyReceivable => 'Company Receivable',
            self::CommissionIncome => 'Commission Income',
            self::BankCharges => 'Bank Charges Expense',
            self::Adjustments => 'Adjustments',
            self::OpeningEquity => 'Opening Balance Equity',
            self::ChequesInHand => 'Cheques In Hand (memo)',
            self::ChequesPending => 'Cheques Pending (memo)',
        };
    }
}
