<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\AccountResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Company;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Balances;
use App\Support\Money;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Agents and the company money they hold. owes < 0 means the company owes the agent (they paid
 * departments with their own money). Admin: all agents. Agent: only themselves (/agents/{own id}).
 */
class AgentController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $owed = Balances::agents()->groupBy('agent_id');
        $pending = Transfer::pending()->with('fromAccount')->get()->groupBy(fn ($t) => $t->fromAccount?->agent_id);
        $names = Company::withTrashed()->pluck('name', 'id');

        $agents = User::where('role', 'agent')->when(! $request->boolean('include_inactive'), fn ($q) => $q->where('is_active', true))
            ->withCount('agentAccounts')->orderBy('name')->get()
            ->map(fn (User $a) => (new UserResource($a))->toArray($request) + [
                'accounts_count' => $a->agent_accounts_count,
                'owes' => Money::add(...$owed->get($a->id, collect())->pluck('owed')->all()),
                'owes_by_company' => $owed->get($a->id, collect())->reject(fn ($r) => Money::isZero($r->owed))
                    ->map(fn ($r) => ['company' => ['id' => $r->company_id, 'name' => $names[$r->company_id] ?? '?'], 'owes' => $r->owed])->values(),
                'returns_waiting' => $pending->get($a->id, collect())->count(),
            ]);

        return response()->json(['data' => $agents, 'meta' => [
            'with_agents' => Balances::withAgents(),
            'owed_to_agents' => Balances::owedToAgents(),
        ]]);
    }

    public function show(Request $request, int $agent): JsonResponse
    {
        abort_unless($request->user()->isAdmin() || $request->user()->id === $agent, 403);
        $a = User::where('role', 'agent')->findOrFail($agent);
        $names = Company::withTrashed()->pluck('name', 'id');
        $rows = Balances::agents(null, $a->id);

        return response()->json(['data' => (new UserResource($a))->toArray($request) + [
            'owes' => Money::add(...$rows->pluck('owed')->all()),
            'by_company' => $rows->map(fn ($r) => [
                'company' => ['id' => $r->company_id, 'name' => $names[$r->company_id] ?? '?'],
                'given' => $r->advanced, 'returned_or_spent' => $r->returned, 'owes' => $r->owed,
            ])->values(),
            'accounts' => AccountResource::collection($a->agentAccounts()->with(['company', 'agent'])->orderBy('type')->orderBy('name')->get())->toArray($request),
        ]]);
    }
}
