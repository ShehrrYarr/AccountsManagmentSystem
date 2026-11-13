<?php

namespace App\Support;

use App\Enums\PaymentMethod;
use Illuminate\Validation\Rule;

/**
 * Form validation for department payments, shared by the single-payment modal and the batch
 * Pay Department page (which re-checks every table row on the final save).
 */
class PaymentRules
{
    /** Pay Department page: fields that stay the same from one payment to the next. */
    public const BATCH_FIELDS = ['date', 'method', 'company_id', 'account_id', 'supplier_id', 'on_credit', 'department_id'];

    /** Cleared after each "Add to table" (plus the receipt picture). */
    public const ITEM_FIELDS = ['amount', 'item_description', 'reference', 'received_by', 'notes'];

    /**
     * @param  array<string, mixed>  $values  the form (or row) values the rules depend on
     * @param  bool  $agent  an agent paying from their own bank
     * @return array<string, mixed>
     */
    public static function rules(array $values, bool $agent = false, bool $withReceipt = true): array
    {
        $method = $values['method'] ?? null;
        $goods = $method === PaymentMethod::Goods->value;
        $onCredit = filter_var($values['on_credit'] ?? false, FILTER_VALIDATE_BOOLEAN);

        $rules = [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'method' => ['required', $agent ? Rule::in([PaymentMethod::BankTransfer->value]) : Rule::enum(PaymentMethod::class)],
            'company_id' => [Rule::requiredIf($method !== PaymentMethod::Cash->value), 'nullable', 'exists:companies,id'],
            'account_id' => [Rule::requiredIf($method === PaymentMethod::BankTransfer->value || ($goods && ! $onCredit)), 'nullable', 'exists:accounts,id'],
            'supplier_id' => [Rule::requiredIf($goods), 'nullable', 'exists:suppliers,id'],
            'on_credit' => ['nullable', 'boolean'],
            'department_id' => ['required', 'exists:departments,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'item_description' => [Rule::requiredIf($goods), 'nullable', 'string', 'max:2000'],
            'reference' => ['nullable', 'string', 'max:255'],
            'received_by' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];

        if ($withReceipt) {
            $rules['receipt'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'];
        }

        return $rules;
    }

    /** @return array<string, string> */
    public static function messages(): array
    {
        return [
            'date.before_or_equal' => 'The date cannot be in the future.',
            'method.in' => 'Agents pay departments by bank transfer.',
            'company_id.required' => 'Choose the company.',
            'account_id.required' => 'Choose the bank the money was paid from.',
            'supplier_id.required' => 'Choose the supplier.',
            'department_id.required' => 'Choose the department.',
            'item_description.required' => 'Describe what was bought.',
        ];
    }

    /** @return array<string, string> */
    public static function attributes(): array
    {
        return ['account_id' => 'bank', 'item_description' => 'description', 'reference' => 'reference / slip no.', 'received_by' => 'received by'];
    }
}
