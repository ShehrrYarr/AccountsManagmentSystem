<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\LedgerRecordResource;
use App\Models\Account;
use App\Models\DealClosing;
use App\Models\OpeningBalance;
use App\Services\DealService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

/**
 * Admin: opening balances (/opening-balances) and deal closings (/deal-closings).
 *
 * Opening balance "party": cash (the admin cash, no company) | department | supplier | agent
 * (an agent's account + company). Department amounts: > 0 it owes you, < 0 you hold its money.
 * Bank openings live on the bank account (PUT /accounts/{id} opening_balance).
 *
 * Deal closing: the department's leftover balance with one company (or company_id "none" for its
 * no-company part, paid from the cash) becomes profit or loss.
 */
class BooksController extends ApiController
{
    public function __construct(private DealService $deals) {}

    // ---- opening balances ---------------------------------------------------

    public function openings(Request $request): AnonymousResourceCollection
    {
        $this->requireAdmin($request);
        $q = OpeningBalance::with(['company', 'department', 'supplier', 'account.agent']);
        $this->companyFilter($q, $request);

        return LedgerRecordResource::collection($q->orderBy('company_id')->orderByDesc('account_id')->get());
    }

    public function storeOpening(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $o = $this->deals->saveOpening(null, $this->openingData($request));

        return (new LedgerRecordResource($o->load(['company', 'department', 'supplier', 'account.agent'])))->response()->setStatusCode(201);
    }

    public function updateOpening(Request $request, int $id): LedgerRecordResource
    {
        $this->requireAdmin($request);
        $o = OpeningBalance::findOrFail($id);

        return new LedgerRecordResource($this->deals->saveOpening($o, $this->openingData($request))->load(['company', 'department', 'supplier', 'account.agent']));
    }

    public function destroyOpening(Request $request, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        $this->deals->deleteOpening(OpeningBalance::findOrFail($id));

        return response()->json(['message' => 'Opening balance removed.']);
    }

    private function openingData(Request $request): array
    {
        $party = $request->input('party');
        $data = $request->validate([
            'party' => ['required', Rule::in(['cash', 'department', 'supplier', 'agent'])],
            'company_id' => [$party === 'cash' ? 'nullable' : 'required', 'nullable', 'integer', 'exists:companies,id'],
            'department_id' => [$party === 'department' ? 'required' : 'nullable', 'integer', 'exists:departments,id'],
            'supplier_id' => [$party === 'supplier' ? 'required' : 'nullable', 'integer', 'exists:suppliers,id'],
            'account_id' => [$party === 'agent' ? 'required' : 'nullable', 'integer', 'exists:accounts,id'],
            'amount' => ['required', 'numeric', 'not_in:0'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        return [
            'company_id' => $party === 'cash' ? null : $data['company_id'],
            'department_id' => $party === 'department' ? $data['department_id'] : null,
            'supplier_id' => $party === 'supplier' ? $data['supplier_id'] : null,
            'account_id' => match ($party) { 'cash' => Account::adminCash()->id, 'agent' => $data['account_id'], default => null },
            'amount' => $data['amount'],
            'date' => $data['date'],
            'notes' => $data['notes'] ?? null,
        ];
    }

    // ---- deal closings --------------------------------------------------------

    public function closings(Request $request): AnonymousResourceCollection
    {
        $this->requireAdmin($request);
        $q = DealClosing::with(['company', 'department'])
            ->when($request->integer('department_id'), fn ($q, $id) => $q->where('department_id', $id));
        $this->companyFilter($q, $request);
        $this->dateRange($q, $request);

        return LedgerRecordResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function storeClosing(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $c = $this->deals->close(null, $this->closingData($request));

        return (new LedgerRecordResource($c->load(['company', 'department'])))->response()->setStatusCode(201);
    }

    public function updateClosing(Request $request, int $id): LedgerRecordResource
    {
        $this->requireAdmin($request);

        return new LedgerRecordResource($this->deals->close(DealClosing::findOrFail($id), $this->closingData($request))->load(['company', 'department']));
    }

    public function destroyClosing(Request $request, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        $this->deals->deleteClosing(DealClosing::findOrFail($id));

        return response()->json(['message' => 'Deal closing removed.']);
    }

    private function closingData(Request $request): array
    {
        $none = in_array($request->input('company_id'), ['none', '0', 0, null], true);
        $data = $request->validate([
            'company_id' => $none ? ['nullable'] : ['required', 'integer', 'exists:companies,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
        $data['company_id'] = $none ? null : (int) $data['company_id'];

        return $data;
    }
}
