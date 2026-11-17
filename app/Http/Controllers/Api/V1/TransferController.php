<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\TransferResource;
use App\Models\Account;
use App\Models\Transfer;
use App\Services\TransferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Transfers. The admin records every kind: what it is follows from the two accounts —
 *   company bank ↔ admin cash      cash & bank move (the cash belongs to no company)
 *   bank of A → bank of B          between companies (B then owes A)
 *   bank / cash → agent's account  advance (from cash: from_company_id says for which company)
 *   agent's account → bank / cash  return  (to cash: from_company_id says for which company)
 * An agent sends returns (POST /transfers/returns): they wait for the admin. An agent sees every
 * transfer touching their accounts, including pending and rejected returns.
 */
class TransferController extends ApiController
{
    private const WITH = ['fromAccount.agent', 'toAccount.agent', 'fromAccount.company', 'toAccount.company', 'fromCompany', 'toCompany', 'creator', 'decider'];

    public function __construct(private TransferService $transfers) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $user = $request->user();
        $agentIds = fn () => Account::withTrashed()->whereNotNull('agent_id')->select('id');

        $q = Transfer::query()->with(self::WITH)
            ->when(! $user->isAdmin(), fn ($q) => $q->forAgent($user->id))
            ->when($user->isAdmin(), fn ($q) => $q->where('status', $request->query('status', Transfer::POSTED)))
            ->when(! $user->isAdmin() && $request->query('status'), fn ($q, $s) => $q->where('status', $s))
            ->when($request->query('type') === 'agent', fn ($q) => $q->where(fn ($q) => $q->whereIn('from_account_id', $agentIds())->orWhereIn('to_account_id', $agentIds())))
            ->when($request->query('type') === 'intercompany', fn ($q) => $q->whereNotNull('from_company_id')->whereNotNull('to_company_id')->whereColumn('from_company_id', '<>', 'to_company_id'))
            ->when($request->query('type') === 'own', fn ($q) => $q->whereNotIn('from_account_id', $agentIds())->whereNotIn('to_account_id', $agentIds())
                ->where(fn ($q) => $q->whereNull('from_company_id')->orWhereNull('to_company_id')->orWhereColumn('from_company_id', 'to_company_id')))
            ->when($request->integer('account_id'), fn ($q, $id) => $q->where(fn ($q) => $q->where('from_account_id', $id)->orWhere('to_account_id', $id)))
            ->when($request->integer('company_id'), fn ($q, $id) => $q->where(fn ($q) => $q->where('from_company_id', $id)->orWhere('to_company_id', $id)));
        $this->dateRange($q, $request);

        return TransferResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function show(Request $request, int $transfer): TransferResource
    {
        $user = $request->user();

        return new TransferResource(Transfer::with(self::WITH)->when(! $user->isAdmin(), fn ($q) => $q->forAgent($user->id))->findOrFail($transfer));
    }

    public function store(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $t = $this->transfers->save(null, $this->validated($request));

        return (new TransferResource($t->load(self::WITH)))->response()->setStatusCode(201);
    }

    public function update(Request $request, int $transfer): TransferResource
    {
        $this->requireAdmin($request);
        $model = Transfer::findOrFail($transfer);
        $data = array_merge($model->only(['from_company_id', 'from_account_id', 'to_account_id', 'amount', 'reference', 'notes']) + ['date' => $model->date->toDateString()], $this->validated($request, partial: true));

        return new TransferResource($this->transfers->save($model, $data)->load(self::WITH));
    }

    /** Admin: delete. Agent: withdraw their own return while it waits for approval. */
    public function destroy(Request $request, int $transfer): JsonResponse
    {
        $model = Transfer::findOrFail($transfer);

        if ($this->isAdmin($request)) {
            $this->transfers->delete($model); // a pending return posted nothing, so this just removes it

            return response()->json(['message' => 'Transfer deleted.']);
        }

        $this->transfers->withdraw($model, $request->user());

        return response()->json(['message' => 'Return withdrawn.']);
    }

    /** Agent: send money back from one of their accounts; waits for the admin (status pending). */
    public function storeReturn(Request $request): JsonResponse
    {
        abort_unless($request->user()->isAgent(), 403, 'Only agents send returns; the admin records them as transfers.');
        $data = $request->validate([
            'from_account_id' => ['required', 'integer', 'exists:accounts,id'],
            'from_company_id' => ['required', 'integer', 'exists:companies,id'],
            'to_account_id' => ['required', 'integer', 'exists:accounts,id', 'different:from_account_id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $t = $this->transfers->requestReturn($data, $request->user());

        return (new TransferResource($t->load(self::WITH)))->additional(['message' => 'Sent to the admin for approval.'])->response()->setStatusCode(201);
    }

    private function validated(Request $request, bool $partial = false): array
    {
        $rules = [
            'from_account_id' => ['required', 'integer', 'exists:accounts,id'],
            'to_account_id' => ['required', 'integer', 'exists:accounts,id', 'different:from_account_id'],
            'from_company_id' => ['nullable', 'integer', 'exists:companies,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
        if ($partial) {
            $rules = array_map(fn ($r) => ['sometimes', ...$r], $rules);
            $rules['to_account_id'] = array_values(array_diff($rules['to_account_id'], ['different:from_account_id']));
        }

        return $request->validate($rules);
    }
}
