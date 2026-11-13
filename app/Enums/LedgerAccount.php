<?php

namespace App\Enums;

/**
 * Chart of accounts used by the double-entry journal. Every line belongs to one company, or to
 * no company: the admin's cash in hand is one pot that belongs to no company, so lines on it (and
 * whatever that cash paid for) carry company_id = null. The null lines balance among themselves.
 *
 *   Money           cash in hand / bank account (account_id)              debit = money in
 *   Department      what a department owes me (department_id)             debit = spent for them, credit = cheque received
 *   Supplier        what I owe a supplier (supplier_id)                   credit = bought on credit, debit = paid
 *   InterCompany    what another of my companies owes this one            debit = sent to them, credit = received from them
 *   Expense         general expenses (expense_category_id)                debit = spent
 *   BankCharges     charges deducted when a cheque is deposited           debit = charged
 *   DealResult      profit (credit) / loss (debit) when a deal is closed  (department_id)
 *   OpeningEquity   balancing side of opening balances
 *   Agent           company money an agent holds and owes back, per agent account (account_id)
 *                                                                         debit = advanced to them, credit = returned
 *   CashPot         money a company moved into (debit) or took from (credit) the admin's cash pot;
 *                   on the no-company side it carries counterparty_company_id = that company
 */
enum LedgerAccount: string
{
    use HasOptions;

    case Money = 'money';
    case Department = 'department';
    case Supplier = 'supplier';
    case InterCompany = 'intercompany';
    case Expense = 'expense';
    case BankCharges = 'bank_charges';
    case DealResult = 'deal_result';
    case OpeningEquity = 'opening_equity';
    case Agent = 'agent';
    case CashPot = 'cash_pot';

    public function label(): string
    {
        return match ($this) {
            self::Money => 'Cash / Bank',
            self::Department => 'Department balance',
            self::Supplier => 'Supplier payable',
            self::InterCompany => 'Inter-company balance',
            self::Expense => 'Expenses',
            self::BankCharges => 'Bank charges',
            self::DealResult => 'Profit / loss on deals',
            self::OpeningEquity => 'Opening balance equity',
            self::Agent => 'Advances to agents',
            self::CashPot => 'Moved to cash in hand',
        };
    }

    /** Which party column a line on this account must carry. */
    public function partyColumn(): ?string
    {
        return match ($this) {
            self::Money, self::Agent => 'account_id',
            self::Department, self::DealResult => 'department_id',
            self::Supplier => 'supplier_id',
            self::InterCompany => 'counterparty_company_id',
            self::Expense => 'expense_category_id',
            default => null,
        };
    }
}
