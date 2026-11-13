<?php

namespace App\Support;

use App\Enums\AccountType;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Supplier;

/**
 * Option lists for <x-searchable-select>: [['value' => id, 'label' => ..., 'hint' => ...], ...]
 * $include keeps an inactive record selectable when editing something that already uses it.
 */
class Options
{
    public static function companies(?int $include = null): array
    {
        return Company::query()
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->orderBy('name')->get(['id', 'name'])
            ->map(fn ($c) => ['value' => $c->id, 'label' => $c->name])->all();
    }

    /**
     * Accounts a company can use: the admin's cash in hand (shared by all companies) first, then
     * company banks. Agents' accounts are never offered here.
     *
     * @param  int|null  $companyId  only this company's banks (labels without the company name)
     * @param  'bank'|'cash'|null  $type
     */
    public static function accounts(?int $companyId = null, ?string $type = null, ?int $include = null): array
    {
        return Account::query()
            ->with('company')
            ->business()
            ->where(fn ($q) => $q->whereNull('company_id')->orWhereHas('company'))
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->when($companyId, fn ($q) => $q->where(fn ($q) => $q->where('company_id', $companyId)->orWhereNull('company_id')))
            ->when($type, fn ($q) => $q->where('type', AccountType::from($type)))
            ->orderByRaw('company_id IS NOT NULL')->orderBy('company_id')->orderBy('type')->orderBy('name')
            ->get()
            ->map(fn (Account $a) => [
                'value' => $a->id,
                'label' => $companyId ? $a->shortLabel() : $a->label(),
                'hint' => money($a->current_balance),
            ])->all();
    }

    /**
     * Agents' accounts (cash in hand and banks), labelled "Agent · Account" unless one agent is given.
     */
    public static function agentAccounts(?int $agentId = null, ?int $include = null): array
    {
        return Account::query()
            ->with('agent')
            ->whereNotNull('agent_id')
            ->whereHas('agent', fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhereHas('agentAccounts', fn ($q) => $q->whereKey($include))))
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->when($agentId, fn ($q) => $q->where('agent_id', $agentId))
            ->orderBy('agent_id')->orderBy('type')->orderBy('name')
            ->get()
            ->map(fn (Account $a) => [
                'value' => $a->id,
                'label' => $agentId ? $a->shortLabel() : $a->label(),
                'hint' => money($a->current_balance),
            ])->all();
    }

    public static function agents(?int $include = null): array
    {
        return \App\Models\User::query()
            ->where('role', \App\Enums\UserRole::Agent)
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->orderBy('name')->get(['id', 'name', 'phone'])
            ->map(fn ($u) => ['value' => $u->id, 'label' => $u->name, 'hint' => $u->phone])->all();
    }

    public static function departments(?int $include = null): array
    {
        return Department::query()
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->orderBy('name')->get(['id', 'name', 'city'])
            ->map(fn ($d) => ['value' => $d->id, 'label' => $d->name, 'hint' => $d->city])->all();
    }

    public static function suppliers(?int $include = null): array
    {
        return Supplier::query()
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->orderBy('name')->get(['id', 'name', 'phone'])
            ->map(fn ($s) => ['value' => $s->id, 'label' => $s->name, 'hint' => $s->phone])->all();
    }

    public static function expenseCategories(?int $include = null): array
    {
        return ExpenseCategory::query()
            ->where(fn ($q) => $q->where('is_active', true)->when($include, fn ($q) => $q->orWhere('id', $include)))
            ->orderBy('name')->get(['id', 'name'])
            ->map(fn ($c) => ['value' => $c->id, 'label' => $c->name])->all();
    }

    /** Enum cases as select options. */
    public static function enum(string $enum): array
    {
        return collect($enum::cases())->map(fn ($c) => ['value' => $c->value, 'label' => $c->label()])->all();
    }
}
