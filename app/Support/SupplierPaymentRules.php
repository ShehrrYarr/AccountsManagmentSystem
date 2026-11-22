<?php

namespace App\Support;

use Illuminate\Validation\Rule;

/**
 * Form validation for paying a supplier, shared by the Pay a Supplier pop-up and the batch
 * Pay Supplier page (which re-checks every table row on the final save).
 */
class SupplierPaymentRules
{
    /** Pay Supplier page: fields that stay the same from one payment to the next. */
    public const BATCH_FIELDS = ['date', 'method', 'company_id', 'account_id', 'supplier_id'];

    /** Cleared after each "Add to table" (plus the receipt picture). */
    public const ITEM_FIELDS = ['amount', 'reference', 'notes'];

    /** Cash comes from the admin's cash in hand (no company); a bank transfer from a company bank. */
    public const METHODS = ['cash', 'bank_transfer'];

    /** @return array<string, mixed> */
    public static function rules(?string $method, bool $withReceipt = true): array
    {
        $bank = $method === 'bank_transfer';

        $rules = [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'method' => ['required', Rule::in(self::METHODS)],
            'company_id' => [Rule::requiredIf($bank), 'nullable', 'exists:companies,id'],
            'account_id' => [Rule::requiredIf($bank), 'nullable', 'exists:accounts,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'reference' => ['nullable', 'string', 'max:255'],
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
            'company_id.required' => 'Choose the company.',
            'account_id.required' => 'Choose the bank the money was paid from.',
            'supplier_id.required' => 'Choose the supplier.',
        ];
    }

    /** @return array<string, string> */
    public static function attributes(): array
    {
        return ['account_id' => 'bank', 'reference' => 'reference'];
    }
}
