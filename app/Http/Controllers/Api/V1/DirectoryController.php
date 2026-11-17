<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\DirectoryResource;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseCategory;
use App\Models\Supplier;
use App\Services\Balances;
use App\Services\DirectoryService;
use App\Support\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Admin: departments (/departments), suppliers (/suppliers) and expense categories
 * (/expense-categories). Lists carry balances; deleting something with history deactivates it.
 * Department and supplier balances are split by company ("company": null = no company, cash).
 */
class DirectoryController extends ApiController
{
    public function __construct(private DirectoryService $directory) {}

    /** @return array{0: class-string<Model>, 1: array<string, mixed>} */
    private function entity(string $kind, ?int $ignore = null): array
    {
        return match ($kind) {
            'departments' => [Department::class, [
                'name' => ['required', 'string', 'max:255', Rule::unique('departments', 'name')->ignore($ignore)],
                'code' => ['nullable', 'string', 'max:50'],
                'city' => ['nullable', 'string', 'max:255'],
                'contact_person' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:30'],
                'notes' => ['nullable', 'string', 'max:2000'],
                'is_active' => ['boolean'],
            ]],
            'suppliers' => [Supplier::class, [
                'name' => ['required', 'string', 'max:255', Rule::unique('suppliers', 'name')->ignore($ignore)],
                'contact_person' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:30'],
                'ntn' => ['nullable', 'string', 'max:50'],
                'address' => ['nullable', 'string', 'max:1000'],
                'is_active' => ['boolean'],
            ]],
            'expense-categories' => [ExpenseCategory::class, [
                'name' => ['required', 'string', 'max:255', Rule::unique('expense_categories', 'name')->ignore($ignore)],
                'is_active' => ['boolean'],
            ]],
        };
    }

    public function index(Request $request, string $kind): JsonResponse
    {
        $this->requireAdmin($request);
        [$model] = $this->entity($kind);
        $balances = match ($kind) {
            'departments' => Balances::departments($this->balanceCompany($request))->groupBy('department_id'),
            'suppliers' => Balances::suppliers($this->balanceCompany($request))->groupBy('supplier_id'),
            default => collect(),
        };

        $rows = $model::query()
            ->when(! $request->boolean('include_inactive'), fn ($q) => $q->where('is_active', true))
            ->when($request->query('search'), fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->orderBy('name')->get()
            ->map(function ($r) use ($request, $kind, $balances) {
                $b = $balances->get($r->id, collect());

                return (new DirectoryResource($r))->toArray($request) + match ($kind) {
                    'departments' => ['spent' => Money::add(...$b->pluck('spent')->all()), 'received' => Money::add(...$b->pluck('received')->all()), 'balance' => Money::add(...$b->pluck('balance')->all())],
                    'suppliers' => ['purchased' => Money::add(...$b->pluck('purchased')->all()), 'paid' => Money::add(...$b->pluck('paid')->all()), 'owed' => Money::add(...$b->pluck('owed')->all())],
                    default => [],
                };
            });

        return response()->json(['data' => $rows]);
    }

    public function show(Request $request, string $kind, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        [$model] = $this->entity($kind);
        $record = $model::findOrFail($id);
        $names = Company::withTrashed()->pluck('name', 'id');
        $company = fn ($cid) => $cid ? ['id' => $cid, 'name' => $names[$cid] ?? '?'] : null;

        $extra = match ($kind) {
            'departments' => ['by_company' => Balances::departments(null, $id)->map(fn ($r) => [
                'company' => $company($r->company_id), 'spent' => $r->spent, 'received' => $r->received, 'balance' => $r->balance,
            ])->values()],
            'suppliers' => ['by_company' => Balances::suppliers(null, $id)->map(fn ($r) => [
                'company' => $company($r->company_id), 'purchased' => $r->purchased, 'paid' => $r->paid, 'owed' => $r->owed,
            ])->values()],
            default => [],
        };

        return response()->json(['data' => (new DirectoryResource($record))->toArray($request) + $extra]);
    }

    public function store(Request $request, string $kind): JsonResponse
    {
        $this->requireAdmin($request);
        [, $rules] = $this->entity($kind);
        $record = $this->save($kind, null, $request->validate($rules));

        return (new DirectoryResource($record))->response()->setStatusCode(201);
    }

    public function update(Request $request, string $kind, int $id): DirectoryResource
    {
        $this->requireAdmin($request);
        [$model, $rules] = $this->entity($kind, $id);
        $record = $model::findOrFail($id);

        return new DirectoryResource($this->save($kind, $record, $request->validate(array_map(fn ($r) => ['sometimes', ...$r], $rules))));
    }

    public function destroy(Request $request, string $kind, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        [$model] = $this->entity($kind);
        $record = $model::findOrFail($id);
        $result = match ($kind) {
            'departments' => $this->directory->deleteDepartment($record),
            'suppliers' => $this->directory->deleteSupplier($record),
            'expense-categories' => $this->directory->deleteCategory($record),
        };

        return response()->json([
            'result' => $result,
            'message' => $result === 'deleted' ? 'Deleted.' : 'It has history, so it was deactivated instead of deleted.',
        ]);
    }

    private function save(string $kind, ?Model $record, array $data): Model
    {
        return match ($kind) {
            'departments' => $this->directory->saveDepartment($record, $data),
            'suppliers' => $this->directory->saveSupplier($record, $data),
            'expense-categories' => $this->directory->saveCategory($record, $data),
        };
    }
}
