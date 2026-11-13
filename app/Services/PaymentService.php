<?php

namespace App\Services;

use App\Enums\AccountType;
use App\Enums\PaymentMethod;
use App\Exceptions\BusinessRuleException;
use App\Models\Account;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\SupplierPayment;
use App\Models\User;
use App\Services\Concerns\ChecksDocuments;
use Illuminate\Support\Arr;

/**
 * Money going out: spending for departments (cash / bank transfer / goods), paying suppliers,
 * and general expenses.
 *
 * Cash always comes from the admin's cash in hand, which belongs to no company, so anything
 * paid in cash has no company. A bank payment belongs to the bank's company.
 *
 * Agents pay departments by bank transfer from their own bank accounts, for a company they
 * choose; it lowers what they owe that company (it may go below zero: the company owes them).
 */
class PaymentService
{
    use ChecksDocuments;

    private const PAYMENT_FIELDS = [
        'company_id', 'department_id', 'method', 'account_id', 'supplier_id', 'on_credit', 'amount', 'date',
        'reference', 'received_by', 'item_description', 'receipt_path', 'notes',
    ];

    public function __construct(private LedgerService $ledger) {}

    public function savePayment(?Payment $payment, array $data, ?User $by = null): Payment
    {
        return $this->ledger->record($this->preparePayment($payment, $data, $by));
    }

    /**
     * Save several new payments all-or-nothing. A failing row is reported as a
     * BusinessRuleException whose field is "rows.<index>".
     *
     * @param  array<int, array<string, mixed>>  $rows
     * @return array<int, Payment>
     */
    public function savePayments(array $rows, ?User $by = null): array
    {
        return $this->ledger->batch(function () use ($rows, $by) {
            $saved = [];
            foreach ($rows as $i => $row) {
                try {
                    $saved[] = $this->savePayment(null, $row, $by);
                } catch (BusinessRuleException $e) {
                    throw new BusinessRuleException($e->getMessage(), "rows.{$i}");
                }
            }

            return $saved;
        });
    }

    /** Every check a save would run, without saving (batch table rows, agents' edit requests). */
    public function checkPayment(array $data, ?Payment $payment = null, ?User $by = null): Payment
    {
        return $this->preparePayment($payment ? clone $payment : null, $data, $by);
    }

    public function saveSupplierPayment(?SupplierPayment $payment, array $data): SupplierPayment
    {
        $payment ??= new SupplierPayment(['created_by' => auth()->id()]);
        $payment->fill(Arr::only($data, ['supplier_id', 'account_id', 'amount', 'date', 'reference', 'notes']));
        $payment->amount = $this->positiveAmount($payment->amount);
        $account = $this->businessAccount($payment->account_id, null, 'account_id', $payment->getOriginal('account_id'));
        $payment->company_id = $account->company_id; // none for cash

        return $this->ledger->record($payment);
    }

    public function saveExpense(?Expense $expense, array $data): Expense
    {
        $expense ??= new Expense(['created_by' => auth()->id()]);
        $fields = Arr::only($data, ['expense_category_id', 'account_id', 'amount', 'date', 'description', 'reference', 'receipt_path', 'notes']);
        if (array_key_exists('receipt_path', $fields) && blank($fields['receipt_path'])) {
            unset($fields['receipt_path']);
        }
        $expense->fill($fields);
        $expense->amount = $this->positiveAmount($expense->amount);
        $account = $this->businessAccount($expense->account_id, null, 'account_id', $expense->getOriginal('account_id'));
        $expense->company_id = $account->company_id; // none for cash

        return $this->ledger->record($expense);
    }

    public function delete(Payment|SupplierPayment|Expense $document): void
    {
        $this->ledger->remove($document);
    }

    // ---------------------------------------------------------------------

    private function preparePayment(?Payment $payment, array $data, ?User $by): Payment
    {
        $by ??= auth()->user();
        $payment ??= new Payment(['created_by' => $by?->id]);

        $fields = Arr::only($data, self::PAYMENT_FIELDS);
        if (array_key_exists('receipt_path', $fields) && blank($fields['receipt_path'])) {
            unset($fields['receipt_path']); // keep the existing receipt
        }
        $payment->fill($fields);
        $payment->amount = $this->positiveAmount($payment->amount);
        $payment->item_description = filled($payment->item_description) ? trim($payment->item_description) : null;
        $payment->received_by = filled($payment->received_by) ? trim($payment->received_by) : null;

        $method = $payment->method instanceof PaymentMethod ? $payment->method : PaymentMethod::tryFrom((string) $payment->method);
        if (! $method) {
            throw new BusinessRuleException('Choose how the payment was made.', 'method');
        }
        if (! $payment->department_id) {
            throw new BusinessRuleException('Choose the department.', 'department_id');
        }

        $keep = $payment->getOriginal('account_id');
        $account = $payment->account_id ? Account::find($payment->account_id) : null;
        $agentPayment = $account?->isAgentAccount() || ($by && ! $by->isAdmin());

        if ($agentPayment) {
            $this->prepareAgentPayment($payment, $method, $account, $by, $keep);

            return $payment;
        }

        switch ($method) {
            case PaymentMethod::Cash:
                $payment->account_id = Account::adminCash()->id;
                $payment->fill(['company_id' => null, 'supplier_id' => null, 'on_credit' => false]);
                break;

            case PaymentMethod::BankTransfer:
                $bank = $this->businessAccount($payment->account_id, AccountType::Bank, 'account_id', $keep);
                $payment->fill(['company_id' => $bank->company_id, 'supplier_id' => null, 'on_credit' => false]);
                break;

            case PaymentMethod::Goods:
                $this->assertCompany($payment->company_id);
                if (! $payment->supplier_id) {
                    throw new BusinessRuleException('Choose the supplier the goods were bought from.', 'supplier_id');
                }
                if ($payment->on_credit) {
                    $payment->account_id = null;
                } else {
                    $this->accountOf((int) $payment->company_id, $payment->account_id, AccountType::Bank, 'account_id', $keep);
                }
                break;
        }

        return $payment;
    }

    /** An agent's bank transfer from their own bank account, for the company they choose. */
    private function prepareAgentPayment(Payment $payment, PaymentMethod $method, ?Account $account, ?User $by, ?int $keep): void
    {
        if ($method !== PaymentMethod::BankTransfer) {
            throw new BusinessRuleException('Agents pay departments by bank transfer from their own bank account.', 'method');
        }
        if (! $account?->isAgentAccount() || $account->type !== AccountType::Bank) {
            throw new BusinessRuleException('Choose your bank account the money was sent from.', 'account_id');
        }
        if ($by && ! $by->isAdmin() && (int) $account->agent_id !== $by->id) {
            throw new BusinessRuleException('Choose one of your own bank accounts.', 'account_id');
        }
        if (! $account->is_active && $account->id !== $keep) {
            throw new BusinessRuleException("{$account->shortLabel()} is inactive.", 'account_id');
        }

        $this->assertCompany($payment->company_id);
        $payment->fill(['supplier_id' => null, 'on_credit' => false]);
    }

    private function assertCompany(mixed $companyId): void
    {
        if (! $companyId || ! Company::whereKey($companyId)->exists()) {
            throw new BusinessRuleException('Choose the company.', 'company_id');
        }
    }
}
