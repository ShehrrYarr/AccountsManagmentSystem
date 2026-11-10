<?php

namespace App\Enums;

/**
 * Chart of accounts used by the double-entry journal. Every line belongs to one company.
 *
 *   Money           cash in hand / bank account (account_id)              debit = money in
 *   ChequesInHand   govt cheques received, not yet deposited              debit = cheque received
 *   Department      what a department owes me (department_id)             debit = spent for them, credit = cheque received
 *   Supplier        what I owe a supplier (supplier_id)                   credit = bought on credit, debit = paid
 *   InterCompany    what another of my companies owes this one            debit = sent to them, credit = received from them
 *   Expense         general expenses (expense_category_id)                debit = spent
 *   BankCharges     charges deducted when a cheque is deposited           debit = charged
 *   DealResult      profit (credit) / loss (debit) when a deal is closed  (department_id)
 *   OpeningEquity   balancing side of opening balances
 */
enum LedgerAccount: string
{
    use HasOptions;

    case Money = 'money';
    case ChequesInHand = 'cheques_in_hand';
    case Department = 'department';
    case Supplier = 'supplier';
    case InterCompany = 'intercompany';
    case Expense = 'expense';
    case BankCharges = 'bank_charges';
    case DealResult = 'deal_result';
    case OpeningEquity = 'opening_equity';

    public function label(): string
    {
        return match ($this) {
            self::Money => 'Cash / Bank',
            self::ChequesInHand => 'Cheques in hand',
            self::Department => 'Department balance',
            self::Supplier => 'Supplier payable',
            self::InterCompany => 'Inter-company balance',
            self::Expense => 'Expenses',
            self::BankCharges => 'Bank charges',
            self::DealResult => 'Profit / loss on deals',
            self::OpeningEquity => 'Opening balance equity',
        };
    }

    /** Which party column a line on this account must carry. */
    public function partyColumn(): ?string
    {
        return match ($this) {
            self::Money => 'account_id',
            self::Department, self::DealResult => 'department_id',
            self::Supplier => 'supplier_id',
            self::InterCompany => 'counterparty_company_id',
            self::Expense => 'expense_category_id',
            default => null,
        };
    }
}
