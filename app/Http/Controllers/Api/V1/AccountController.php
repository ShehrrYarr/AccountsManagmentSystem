<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\AccountResource;
use App\Models\Account;
use App\Models\User;
use App\Services\MasterDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

/**
 * Cash & bank accounts. Admin: the admin cash, every company bank and every agent account (and
 * may add / edit any except the admin cash). Agent: only their own accounts; they may add bank
 * accounts and change or delete the ones they added (not those the admin added, nor their cash).
 */
class AccountController extends ApiController
{
    public function __construct(private MasterDataService $master) {}

    /** May this user change / delete this account? (Same rule as the website.) */
    public static function canChange(User $user, Account $account): bool
    {
        if ($account->isAdminCash()) {
            return false;
        }
        if ($user->isAdmin()) {
            return true;
        }

        return $account->agent_id === $user->id && $account->created_by === $user->id && ! $account->isCash();
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $user = $request->user();

        $q = Account::query()->with(['company', 'agent'])
            ->when(! $user->isAdmin(), fn ($q) => $q->where('agent_id', $user->id))
            ->when(! $request->boolean('include_inactive'), fn ($q) => $q->where('is_active', true))
            ->when($request->query('holder') === 'admin', fn ($q) => $q->adminCashOnly())
            ->when($request->query('holder') === 'company', fn ($q) => $q->whereNotNull('company_id'))
            ->when($request->query('holder') === 'agent', fn ($q) => $q->whereNotNull('agent_id'))
            ->when($request->integer('company_id'), fn ($q, $id) => $q->where('company_id', $id))
            ->when($user->isAdmin() && $request->integer('agent_id'), fn ($q, $id) => $q->where('agent_id', $id))
            ->when($request->query('type'), fn ($q, $t) => $q->where('type', $t))
            ->orderByRaw('company_id IS NULL AND agent_id IS NULL DESC')->orderBy('company_id')->orderBy('agent_id')->orderBy('type')->orderBy('name');

        return AccountResource::collection($q->get());
    }

    public function show(Request $request, int $account): AccountResource
    {
        $a = Account::withTrashed()->with(['company', 'agent'])->findOrFail($account);
        abort_unless($request->user()->isAdmin() || $a->agent_id === $request->user()->id, 403);

        return new AccountResource($a);
    }

    /**
     * Admin: a company bank (company_id) or an agent account (agent_id). Agent: their own bank
     * (holder fields are ignored).
     */
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();
        $data = $this->validated($request, null);
        $a = $this->master->saveAccount(null, $data, $user);

        return (new AccountResource($a->load(['company', 'agent'])))->response()->setStatusCode(201);
    }

    public function update(Request $request, int $account): AccountResource
    {
        $a = Account::findOrFail($account);
        abort_unless(self::canChange($request->user(), $a), 403, 'You cannot change this account.');
        $data = array_merge(
            $a->only(['company_id', 'agent_id', 'name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban', 'opening_balance', 'is_active'])
                + ['type' => $a->type->value, 'opening_date' => $a->opening_date?->toDateString()],
            $this->validated($request, $a),
        );

        return new AccountResource($this->master->saveAccount($a, $data, $request->user())->load(['company', 'agent']));
    }

    public function destroy(Request $request, int $account): JsonResponse
    {
        $a = Account::findOrFail($account);
        abort_unless(self::canChange($request->user(), $a), 403, 'You cannot delete this account.');
        $this->master->deleteAccount($a);

        return response()->json(['message' => 'Account deleted.']);
    }

    private function validated(Request $request, ?Account $existing): array
    {
        $user = $request->user();
        if (! $user->isAdmin()) {
            $request->merge(['agent_id' => $user->id, 'company_id' => null, 'type' => 'bank']);
        }
        $partial = (bool) $existing;
        $agentId = $request->input('agent_id', $existing?->agent_id);
        $companyId = $request->input('company_id', $existing?->company_id);
        $type = $request->input('type', $existing?->type->value ?? 'bank');

        $rules = [
            'company_id' => [Rule::requiredIf(! $agentId && ! $partial), 'nullable', 'integer', 'exists:companies,id'],
            'agent_id' => ['nullable', 'integer', 'exists:users,id'],
            'type' => ['nullable', Rule::in(['bank', 'cash'])],
            'name' => [$partial ? 'sometimes' : 'required', 'string', 'max:255', Rule::unique('accounts', 'name')
                ->where($agentId ? 'agent_id' : 'company_id', $agentId ?: $companyId)->whereNull('deleted_at')->ignore($existing?->id)],
            'bank_name' => [$type === 'bank' && ! $partial ? 'required' : 'nullable', 'string', 'max:255'],
            'branch' => ['nullable', 'string', 'max:255'],
            'account_title' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:50'],
            'iban' => ['nullable', 'string', 'max:34'],
            'opening_balance' => ['nullable', 'numeric', 'min:0'],
            'opening_date' => ['nullable', 'date'],
            'is_active' => ['boolean'],
        ];

        $data = $request->validate($rules, ['name.unique' => 'There is already an account with that name.']);
        if (! $user->isAdmin()) {
            $data = array_merge($data, ['agent_id' => $user->id, 'company_id' => null, 'type' => 'bank']);
            unset($data['opening_balance'], $data['opening_date']);
        }

        return $data;
    }
}
