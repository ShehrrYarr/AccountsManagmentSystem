<?php

namespace App\Support;

use Illuminate\Validation\Rule;

/**
 * Form validation for government cheques, shared by the single-cheque modal and the
 * batch deposit page (which re-checks every table row on the final save).
 */
class ChequeRules
{
    /** Deposit page: fields that stay the same from one cheque to the next. */
    public const BATCH_FIELDS = ['cheque_date', 'company_id', 'deposit_account_id', 'issuing_branch', 'department_id'];

    /** @return array<string, mixed> */
    public static function rules(?int $ignoreId = null, bool $withScan = true): array
    {
        $rules = [
            'cheque_date' => ['required', 'date', 'before_or_equal:today'],
            'company_id' => ['required', 'exists:companies,id'],
            'deposit_account_id' => ['required', 'exists:accounts,id'],
            'issuing_branch' => ['nullable', 'string', 'max:50'],
            'department_id' => ['required', 'exists:departments,id'],
            'cheque_number' => [
                'required', 'string', 'max:50',
                Rule::unique('cheques', 'cheque_number')->whereNull('deleted_at')->ignore($ignoreId),
            ],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'bank_charges' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'deposit_reference' => ['nullable', 'string', 'max:255'],
        ];

        if ($withScan) {
            $rules['scan'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'];
        }

        return $rules;
    }

    /** @return array<string, string> */
    public static function messages(): array
    {
        return [
            'cheque_number.unique' => 'This cheque number is already entered.',
            'cheque_date.before_or_equal' => 'The cheque date cannot be in the future.',
            'company_id.required' => 'Choose the company.',
            'department_id.required' => 'Choose the department this cheque is for.',
            'deposit_account_id.required' => 'Choose the company bank it goes into.',
        ];
    }

    /** @return array<string, string> */
    public static function attributes(): array
    {
        return ['deposit_account_id' => 'bank', 'issuing_branch' => 'branch code', 'deposit_reference' => 'deposit slip / reference'];
    }
}
