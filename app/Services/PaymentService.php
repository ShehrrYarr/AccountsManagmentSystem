<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\PaymentMethod;
use App\Exceptions\BusinessRuleException;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\SupplierPayment;
use App\Services\Concerns\ChecksDocuments;
use Illuminate\Support\Arr;

/**
 * Money going out: spending for departments (cash / bank transfer / goods),
 * paying suppliers, and general company expenses.
 */
class PaymentService
{
    use ChecksDocuments;

    public function __construct(private LedgerService $ledger) {}

    public function savePayment(?Payment $payment, array $data): Payment
    {
        $payment ??= new Payment(['created_by' => auth()->id()]);
        $fields = Arr::only($data, [
            'company_id', 'department_id', 'method', 'account_id', 'supplier_id', 'on_credit', 'amount', 'date',
            'reference', 'received_by', 'item_description', 'receipt_path', 'notes',
        ]);
        if (array_key_exists('receipt_path', $fields) && blank($fields['receipt_path'])) {
            unset($fields['receipt_path']);
        }
        $payment->fill($fields);
        $payment->amount = $this->positiveAmount($payment->amount);
        $companyId = (int) $payment->company_id;
        $keep = $payment->getOriginal('account_id');

        switch (PaymentMethod::from($payment->method instanceof PaymentMethod ? $payment->method->value : $payment->method)) {
            case PaymentMethod::Cash:
                $payment->account_id = $this->cashAccountOf($companyId)->id;
                $payment->fill(['supplier_id' => null, 'on_credit' => false, 'item_description' => null]);
                break;

            case PaymentMethod::BankTransfer:
                $this->accountOf($companyId, $payment->account_id, AccountType::Bank, 'account_id', $keep);
                $payment->fill(['supplier_id' => null, 'on_credit' => false, 'item_description' => null, 'received_by' => null]);
                break;

            case PaymentMethod::Goods:
                if (! $payment->supplier_id) {
                    throw new BusinessRuleException('Choose the supplier the goods were bought from.', 'supplier_id');
                }
                if ($payment->on_credit) {
                    $payment->account_id = null;
                } else {
                    $this->accountOf($companyId, $payment->account_id, null, 'account_id', $keep);
                }
                $payment->received_by = null;
                break;
        }

        return $this->ledger->record($payment);
    }

    public function saveSupplierPayment(?SupplierPayment $payment, array $data): SupplierPayment
    {
        $payment ??= new SupplierPayment(['created_by' => auth()->id()]);
        $payment->fill(Arr::only($data, ['company_id', 'supplier_id', 'account_id', 'amount', 'date', 'reference', 'notes']));
        $payment->amount = $this->positiveAmount($payment->amount);
        $this->accountOf((int) $payment->company_id, $payment->account_id, null, 'account_id', $payment->getOriginal('account_id'));

        return $this->ledger->record($payment);
    }

    public function saveExpense(?Expense $expense, array $data): Expense
    {
        $expense ??= new Expense(['created_by' => auth()->id()]);
        $fields = Arr::only($data, ['company_id', 'expense_category_id', 'account_id', 'amount', 'date', 'description', 'reference', 'receipt_path', 'notes']);
        if (array_key_exists('receipt_path', $fields) && blank($fields['receipt_path'])) {
            unset($fields['receipt_path']);
        }
        $expense->fill($fields);
        $expense->amount = $this->positiveAmount($expense->amount);
        $this->accountOf((int) $expense->company_id, $expense->account_id, null, 'account_id', $expense->getOriginal('account_id'));

        return $this->ledger->record($expense);
    }

    public function delete(Payment|SupplierPayment|Expense $document): void
    {
        $this->ledger->remove($document);
    }
}
