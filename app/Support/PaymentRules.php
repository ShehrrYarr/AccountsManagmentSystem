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

    /** Cleared after each "Add to table" (plus the receipt picture). Quantity and price: goods only. */
    public const ITEM_FIELDS = ['quantity', 'unit_price', 'amount', 'taxes', 'item_description', 'reference', 'received_by', 'notes'];

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
            // Goods: optional, both or neither; they work out the amount on the form.
            'quantity' => $goods ? ['nullable', 'numeric', 'gt:0', 'max:9999999999', 'decimal:0,3', 'required_with:unit_price'] : ['nullable'],
            'unit_price' => $goods ? ['nullable', 'numeric', 'gt:0', 'max:9999999999999', 'decimal:0,2', 'required_with:quantity'] : ['nullable'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            // Taxes paid from the same bank on top of the amount (bank payments only).
            'taxes' => ['nullable', 'array', 'max:10'],
            'taxes.*.tax_id' => ['required', 'integer', 'distinct', 'exists:taxes,id'],
            'taxes.*.amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
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
            'taxes.*.tax_id.required' => 'Choose the tax.',
            'taxes.*.tax_id.distinct' => 'The same tax is listed twice.',
            'taxes.*.amount.required' => 'Enter the tax amount.',
            'taxes.*.amount.gt' => 'Enter the tax amount.',
            'quantity.required_with' => 'Enter the quantity too, or clear the price.',
            'unit_price.required_with' => 'Enter the price too, or clear the quantity.',
            'quantity.decimal' => 'Up to 3 decimal places.',
            'unit_price.decimal' => 'Up to 2 decimal places.',
        ];
    }

    /** @return array<string, string> */
    public static function attributes(): array
    {
        return ['account_id' => 'bank', 'item_description' => 'description', 'unit_price' => 'price', 'reference' => 'reference / slip no.', 'received_by' => 'received by'];
    }
}
