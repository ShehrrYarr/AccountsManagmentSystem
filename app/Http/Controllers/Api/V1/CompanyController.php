<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\AccountResource;
use App\Http\Resources\Api\DirectoryResource;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\User;
use App\Services\Balances;
use App\Services\MasterDataService;
use App\Support\Money;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Admin: my companies. The list carries each company's bank total and what it moved into the
 * cash in hand; show adds the company page's summary (owed by departments, to suppliers, between
 * companies, with agents, profit).
 */
class CompanyController extends ApiController
{
    public function __construct(private MasterDataService $master) {}

    public function index(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $moved = Balances::movedToCash();

        $rows = Company::query()->when(! $request->boolean('include_inactive'), fn ($q) => $q->where('is_active', true))
            ->orderBy('name')->get()
            ->map(fn (Company $c) => (new DirectoryResource($c))->toArray($request) + [
                'bank_balance' => Balances::money($c->id)['bank'],
                'moved_to_cash' => $moved[$c->id] ?? '0.00',
            ]);

        return response()->json(['data' => $rows]);
    }

    public function show(Request $request, int $company): JsonResponse
    {
        $this->requireAdmin($request);
        $c = Company::withTrashed()->with(['accounts' => fn ($q) => $q->orderBy('name')])->findOrFail($company);
        $depts = Balances::departments($c->id);
        $names = Company::withTrashed()->pluck('name', 'id');
        $month = Cheque::where('company_id', $c->id)->whereBetween('date', [now()->startOfMonth()->toDateString(), now()->toDateString()]);

        return response()->json(['data' => (new DirectoryResource($c))->toArray($request) + ['summary' => [
            'money' => Balances::money($c->id),
            'cheques_this_month' => ['amount' => Money::of((clone $month)->sum('amount')), 'count' => (clone $month)->count()],
            'departments_owe' => Money::add(...$depts->filter(fn ($r) => Money::isPositive($r->balance))->pluck('balance')->all()),
            'held_for_departments' => Money::sub(0, Money::add(...$depts->filter(fn ($r) => Money::isNegative($r->balance))->pluck('balance')->all())),
            'owed_to_suppliers' => Money::add(...Balances::suppliers($c->id)->pluck('owed')->all()),
            'inter_company' => Balances::interCompany($c->id)->map(fn ($bal, $id) => ['company' => ['id' => $id, 'name' => $names[$id] ?? '?'], 'balance' => $bal])->values(),
            'with_agents' => Balances::agents($c->id)->reject(fn ($r) => Money::isZero($r->owed))
                ->map(fn ($r) => ['agent' => ['id' => $r->agent_id, 'name' => User::find($r->agent_id)?->name], 'owes' => $r->owed])->values(),
            'profit_this_month' => Balances::profit($c->id, now()->startOfMonth(), now()),
            'profit_this_year' => Balances::profit($c->id, now()->startOfYear(), now()),
        ], 'bank_accounts' => AccountResource::collection($c->accounts)->toArray($request)]]);
    }

    public function store(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $c = $this->master->saveCompany(null, $request->validate($this->rules()) + ['is_active' => true]);

        return (new DirectoryResource($c))->response()->setStatusCode(201);
    }

    public function update(Request $request, int $company): DirectoryResource
    {
        $this->requireAdmin($request);
        $c = Company::findOrFail($company);

        return new DirectoryResource($this->master->saveCompany($c, $request->validate(array_map(fn ($r) => ['sometimes', ...$r], $this->rules($c->id)))));
    }

    public function destroy(Request $request, int $company): JsonResponse
    {
        $this->requireAdmin($request);
        $this->master->deleteCompany(Company::findOrFail($company));

        return response()->json(['message' => 'Company deleted.']);
    }

    private function rules(?int $ignore = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('companies', 'name')->ignore($ignore)],
            'ntn' => ['nullable', 'string', 'max:50'],
            'registration_no' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'is_active' => ['boolean'],
        ];
    }
}
