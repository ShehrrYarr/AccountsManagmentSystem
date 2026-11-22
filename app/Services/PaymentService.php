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
use App\Models\Tax;
use App\Models\User;
use App\Services\Concerns\ChecksDocuments;
use App\Support\Money;
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
        'reference', 'received_by', 'item_description', 'quantity', 'unit_price', 'receipt_path', 'notes',
    ];

    public function __construct(private LedgerService $ledger) {}

    public function savePayment(?Payment $payment, array $data, ?User $by = null): Payment
    {
        return $this->recordWithTaxes($this->preparePayment($payment, $data, $by));
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
        return $this->recordWithTaxes($this->prepareSupplierPayment($payment, $data));
    }

    /**
     * Save several new supplier payments all-or-nothing (the Pay Supplier page). A failing row is
     * reported as a BusinessRuleException whose field is "rows.<index>".
     *
     * @param  array<int, array<string, mixed>>  $rows
     * @return array<int, SupplierPayment>
     */
    public function saveSupplierPayments(array $rows): array
    {
        return $this->ledger->batch(function () use ($rows) {
            $saved = [];
            foreach ($rows as $i => $row) {
                try {
                    $saved[] = $this->saveSupplierPayment(null, $row);
                } catch (BusinessRuleException $e) {
                    throw new BusinessRuleException($e->getMessage(), "rows.{$i}");
                }
            }

            return $saved;
        });
    }

    /** The checks a save would run on the form, without saving (the page's "Add to table"). */
    public function checkSupplierPayment(array $data, ?SupplierPayment $payment = null): SupplierPayment
    {
        return $this->prepareSupplierPayment($payment ? clone $payment : null, $data);
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

    /** Paid from the cash in hand (no company) or a company bank; a given company_id must match the bank. */
    private function prepareSupplierPayment(?SupplierPayment $payment, array $data): SupplierPayment
    {
        $payment ??= new SupplierPayment(['created_by' => auth()->id()]);
        $fields = Arr::only($data, ['supplier_id', 'account_id', 'amount', 'date', 'reference', 'notes', 'receipt_path']);
        if (array_key_exists('receipt_path', $fields) && blank($fields['receipt_path'])) {
            unset($fields['receipt_path']); // keep the existing receipt
        }
        $payment->fill($fields);
        $payment->amount = $this->positiveAmount($payment->amount);
        $account = $this->businessAccount($payment->account_id, null, 'account_id', $payment->getOriginal('account_id'));
        if (! empty($data['company_id']) && $account->company_id && (int) $account->company_id !== (int) $data['company_id']) {
            throw new BusinessRuleException("{$account->shortLabel()} is not a bank of that company.", 'account_id');
        }
        $payment->company_id = $account->company_id; // none for cash
        $this->prepareTaxes($payment, $data, (bool) $payment->company_id);

        return $payment;
    }

    /** Save the document, its taxes, then post (the tax postings read the saved taxes). */
    private function recordWithTaxes(Payment|SupplierPayment $document): Payment|SupplierPayment
    {
        return $this->ledger->batch(function () use ($document) {
            $document->save();
            if ($document->pendingTaxes !== null) {
                $document->taxes()->delete();
                foreach ($document->pendingTaxes as $tax) {
                    $document->taxes()->create($tax);
                }
                $document->pendingTaxes = null;
            }
            $this->ledger->sync($document);

            return $document;
        });
    }

    /**
     * The taxes from the form, checked: each a known tax (a turned-off one only if the payment
     * already had it), a positive amount, no tax twice. Payments that can't carry taxes drop them.
     */
    private function prepareTaxes(Payment|SupplierPayment $payment, array $data, bool $allowed): void
    {
        if (! $allowed) {
            $payment->pendingTaxes = $payment->exists || array_key_exists('taxes', $data) ? [] : null;

            return;
        }
        if (! array_key_exists('taxes', $data)) {
            return; // leave the saved taxes as they are
        }

        $lines = [];
        foreach (is_array($data['taxes']) ? $data['taxes'] : [] as $i => $line) {
            $taxId = (int) ($line['tax_id'] ?? 0);
            $amount = $line['amount'] ?? null;
            if (! $taxId && blank($amount)) {
                continue; // an empty row
            }
            if (! $taxId) {
                throw new BusinessRuleException('Choose the tax.', "taxes.{$i}.tax_id");
            }
            if (! is_numeric($amount) || Money::cmp($amount, 0) <= 0) {
                throw new BusinessRuleException('Enter the tax amount.', "taxes.{$i}.amount");
            }
            if (isset($lines[$taxId])) {
                throw new BusinessRuleException('The same tax is listed twice.', "taxes.{$i}.tax_id");
            }
            $lines[$taxId] = ['tax_id' => $taxId, 'amount' => Money::of($amount)];
        }

        $had = $payment->exists ? $payment->taxes()->pluck('tax_id')->all() : [];
        $taxes = Tax::whereKey(array_keys($lines))->get()->keyBy('id');
        foreach (array_keys($lines) as $taxId) {
            $tax = $taxes->get($taxId);
            if (! $tax) {
                throw new BusinessRuleException('That tax no longer exists.', 'taxes');
            }
            if (! $tax->is_active && ! in_array($taxId, $had)) {
                throw new BusinessRuleException("{$tax->name} is turned off.", 'taxes');
            }
        }

        $payment->pendingTaxes = array_values($lines);
    }

    private function preparePayment(?Payment $payment, array $data, ?User $by): Payment
    {
        $by ??= auth()->user();
        $payment ??= new Payment(['created_by' => $by?->id]);

        $fields = Arr::only($data, self::PAYMENT_FIELDS);
        if (array_key_exists('receipt_path', $fields) && blank($fields['receipt_path'])) {
            unset($fields['receipt_path']); // keep the existing receipt
        }
        foreach (['quantity', 'unit_price'] as $f) {
            if (array_key_exists($f, $fields) && ! is_numeric($fields[$f])) {
                $fields[$f] = null; // blank: no quantity / price
            }
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
        // Quantity and price describe goods, and only together.
        if ($method !== PaymentMethod::Goods || ! is_numeric($payment->quantity) || ! is_numeric($payment->unit_price)) {
            $payment->quantity = null;
            $payment->unit_price = null;
        }

        $keep = $payment->getOriginal('account_id');
        $account = $payment->account_id ? Account::find($payment->account_id) : null;
        $agentPayment = $account?->isAgentAccount() || ($by && ! $by->isAdmin());

        if ($agentPayment) {
            $this->prepareAgentPayment($payment, $method, $account, $by, $keep);
            $this->prepareTaxes($payment, $data, true);

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
        // Taxes leave the bank on top of the payment: not for cash, nor goods bought on credit.
        $this->prepareTaxes($payment, $data, $method === PaymentMethod::BankTransfer || ($method === PaymentMethod::Goods && ! $payment->on_credit));

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
