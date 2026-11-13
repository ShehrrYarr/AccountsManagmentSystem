<?php

namespace App\Enums;

enum TransactionType: string
{
    use HasOptions;

    case OpeningBalance = 'opening_balance';
    case ChequeDeposit = 'cheque_deposit';
    case DepartmentPayment = 'department_payment';
    case GoodsPurchase = 'goods_purchase';
    case SupplierPayment = 'supplier_payment';
    case AccountTransfer = 'account_transfer';
    case InterCompanyTransfer = 'intercompany_transfer';
    case AgentAdvance = 'agent_advance';
    case AgentReturn = 'agent_return';
    case Expense = 'expense';
    case DealClosing = 'deal_closing';

    public function label(): string
    {
        return match ($this) {
            self::OpeningBalance => 'Opening Balance',
            self::ChequeDeposit => 'Govt Cheque',
            self::DepartmentPayment => 'Paid to Department',
            self::GoodsPurchase => 'Goods Purchase',
            self::SupplierPayment => 'Supplier Payment',
            self::AccountTransfer => 'Own Transfer',
            self::InterCompanyTransfer => 'Inter-company',
            self::AgentAdvance => 'Advance to Agent',
            self::AgentReturn => 'Agent Return',
            self::Expense => 'Expense',
            self::DealClosing => 'Deal Closed',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::OpeningBalance => 'bg-secondary-subtle text-secondary',
            self::ChequeDeposit => 'bg-success-subtle text-success',
            self::DepartmentPayment, self::GoodsPurchase => 'bg-warning-subtle text-warning',
            self::SupplierPayment, self::Expense => 'bg-danger-subtle text-danger',
            self::AccountTransfer, self::InterCompanyTransfer => 'bg-primary-subtle text-primary',
            self::AgentAdvance, self::AgentReturn => 'bg-info-subtle text-info',
            self::DealClosing => 'bg-dark-subtle text-body',
        };
    }
}
