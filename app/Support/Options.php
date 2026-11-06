<?php

namespace App\Support;

use App\Enums\BankAccountType;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\CompanyBankAccount;
use App\Models\GovernmentDepartment;
use App\Models\Vendor;

/**
 * Option lists for <x-searchable-select>: [['value' => id, 'label' => ..., 'hint' => ...], ...]
 */
class Options
{
    public static function companies(bool $withBalance = true, ?int $include = null): array
    {
        return Company::query()
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->orderBy('name')
            ->get(['id', 'name', 'payable_balance'])
            ->map(fn ($c) => [
                'value' => $c->id,
                'label' => $c->name,
                'hint' => $withBalance ? 'Payable '.money($c->payable_balance) : null,
            ])->all();
    }

    /** @param  'bank'|'cash'|null  $type */
    public static function bankAccounts(?string $type = null, ?int $include = null): array
    {
        return BankAccount::query()
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->when($type, fn ($q) => $q->where('type', BankAccountType::from($type)))
            ->orderBy('type')->orderBy('name')
            ->get()
            ->map(fn ($a) => [
                'value' => $a->id,
                'label' => $a->label(),
                'hint' => money($a->current_balance),
            ])->all();
    }

    public static function companyBankAccounts(?int $companyId): array
    {
        if (! $companyId) {
            return [];
        }

        return CompanyBankAccount::where('company_id', $companyId)->where('is_active', true)
            ->orderByDesc('is_default')->orderBy('bank_name')
            ->get()
            ->map(fn ($a) => [
                'value' => $a->id,
                'label' => "{$a->bank_name} — {$a->account_number}",
                'hint' => $a->account_title,
            ])->all();
    }

    public static function vendors(): array
    {
        return Vendor::where('is_active', true)->orderBy('name')->get(['id', 'name', 'phone'])
            ->map(fn ($v) => ['value' => $v->id, 'label' => $v->name, 'hint' => $v->phone])->all();
    }

    public static function departments(): array
    {
        return GovernmentDepartment::where('is_active', true)->orderBy('name')->get(['id', 'name', 'city'])
            ->map(fn ($d) => ['value' => $d->id, 'label' => $d->name, 'hint' => $d->city])->all();
    }

    /** Enum cases as select options. */
    public static function enum(string $enum): array
    {
        return collect($enum::cases())->map(fn ($c) => ['value' => $c->value, 'label' => $c->label()])->all();
    }
}
