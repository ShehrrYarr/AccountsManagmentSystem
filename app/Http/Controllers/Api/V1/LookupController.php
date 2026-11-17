<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\PaymentMethod;
use App\Enums\TransactionType;
use App\Http\Resources\Api\UserResource;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Supplier;
use App\Models\User;
use App\Services\Balances;
use App\Services\StatementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Everything the app's pickers need, in one call — download it on sign-in and on refresh, and
 * keep it on the phone for the offline queue. Inactive records are left out unless
 * ?include_inactive=1 (useful to show names on older entries).
 */
class LookupController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $admin = $user->isAdmin();
        $all = $request->boolean('include_inactive');
        $active = fn ($q) => $q->when(! $all, fn ($q) => $q->where('is_active', true));

        $accountRow = fn (Account $a, bool $withBalance) => [
            'id' => $a->id,
            'label' => $a->label(),
            'short_label' => $a->shortLabel(),
            'type' => $a->type->value,
            'holder' => $a->isAdminCash() ? 'admin' : ($a->agent_id ? 'agent' : 'company'),
            'company_id' => $a->company_id,
            'agent_id' => $a->agent_id,
            'is_active' => (bool) $a->is_active,
            'balance' => $withBalance ? $a->current_balance : null,
        ];

        // Company banks + the admin's cash (agents need them as "to" accounts for returns).
        $business = Account::query()->with('company')->business()->tap($active)
            ->orderByRaw('company_id IS NOT NULL')->orderBy('company_id')->orderBy('name')->get()
            ->map(fn ($a) => $accountRow($a, $admin));

        $holds = $admin ? collect() : Balances::agents(null, $user->id)->pluck('owed', 'company_id');

        return response()->json(['data' => [
            'me' => new UserResource($user),
            'server_time' => now()->toIso8601String(),
            'companies' => Company::query()->tap($active)->orderBy('name')->get(['id', 'name', 'is_active'])
                ->map(fn ($c) => ['id' => $c->id, 'name' => $c->name, 'is_active' => (bool) $c->is_active]
                    + ($admin ? [] : ['you_hold' => $holds[$c->id] ?? '0.00'])),
            'departments' => Department::query()->tap($active)->orderBy('name')->get(['id', 'name', 'city', 'is_active']),
            'suppliers' => Supplier::query()->tap($active)->orderBy('name')->get(['id', 'name', 'phone', 'is_active']),
            'expense_categories' => $admin ? ExpenseCategory::query()->tap($active)->orderBy('name')->get(['id', 'name', 'is_active']) : [],
            'accounts' => $business,
            'my_accounts' => $admin ? [] : Account::where('agent_id', $user->id)->tap($active)->orderBy('type')->orderBy('name')->get()
                ->map(fn ($a) => $accountRow($a, true) + ['can_edit' => AccountController::canChange($user, $a)]),
            'agent_accounts' => $admin ? Account::query()->with('agent')->whereNotNull('agent_id')->tap($active)->orderBy('agent_id')->orderBy('name')->get()
                ->map(fn ($a) => $accountRow($a, true) + ['agent_name' => $a->agent?->name]) : [],
            'agents' => $admin ? User::where('role', 'agent')->tap($active)->orderBy('name')->get(['id', 'name', 'phone', 'is_active']) : [],
            'payment_methods' => collect(PaymentMethod::cases())
                ->reject(fn ($m) => ! $admin && $m !== PaymentMethod::BankTransfer)
                ->map(fn ($m) => ['value' => $m->value, 'label' => $m->label(), 'hint' => $m->hint()])->values(),
            'transaction_types' => collect(TransactionType::cases())->map(fn ($t) => ['value' => $t->value, 'label' => $t->label()]),
            'statement_kinds' => StatementService::KINDS,
        ]]);
    }
}
