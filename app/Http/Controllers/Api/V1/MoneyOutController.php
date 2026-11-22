<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\MoneyOutResource;
use App\Models\Expense;
use App\Models\SupplierPayment;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

/**
 * Admin: supplier payments (/supplier-payments) and expenses (/expenses). The company follows from
 * the account paid from — a company bank — or none for the admin's cash in hand.
 */
class MoneyOutController extends ApiController
{
    public function __construct(private PaymentService $payments) {}

    // ---- supplier payments ----------------------------------------------

    public function supplierPayments(Request $request): AnonymousResourceCollection
    {
        $this->requireAdmin($request);
        $q = SupplierPayment::query()->with(['company', 'supplier', 'account', 'taxes.tax'])
            ->when($request->integer('supplier_id'), fn ($q, $id) => $q->where('supplier_id', $id))
            ->when($request->query('search'), fn ($q, $s) => $q->where('reference', 'like', "%{$s}%"));
        $this->companyFilter($q, $request);
        $this->dateRange($q, $request);

        return MoneyOutResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function showSupplierPayment(Request $request, int $id): MoneyOutResource
    {
        $this->requireAdmin($request);

        return new MoneyOutResource(SupplierPayment::with(['company', 'supplier', 'account', 'taxes.tax'])->findOrFail($id));
    }

    public function storeSupplierPayment(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $data = $request->validate($this->supplierRules());
        $data['receipt_path'] = $this->storeUpload($request->file('receipt'), 'receipts');

        try {
            $p = $this->payments->saveSupplierPayment(null, $data);
        } catch (\Throwable $ex) {
            $data['receipt_path'] && Storage::disk('local')->delete($data['receipt_path']);
            throw $ex;
        }

        return (new MoneyOutResource($p->load(['company', 'supplier', 'account'])))->response()->setStatusCode(201);
    }

    public function updateSupplierPayment(Request $request, int $id): MoneyOutResource
    {
        $this->requireAdmin($request);
        $model = SupplierPayment::findOrFail($id);
        $data = array_merge($model->only(['supplier_id', 'account_id', 'amount', 'reference', 'notes']) + ['date' => $model->date->toDateString()],
            $request->validate(array_map(fn ($r) => ['sometimes', ...$r], $this->supplierRules())));
        $data['receipt_path'] = $this->storeUpload($request->file('receipt'), 'receipts');
        $old = $model->receipt_path;

        $saved = $this->payments->saveSupplierPayment($model, $data);
        if ($data['receipt_path'] && $old) {
            Storage::disk('local')->delete($old);
        }

        return new MoneyOutResource($saved->load(['company', 'supplier', 'account']));
    }

    public function destroySupplierPayment(Request $request, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        $this->payments->delete(SupplierPayment::findOrFail($id));

        return response()->json(['message' => 'Supplier payment deleted.']);
    }

    // ---- expenses ---------------------------------------------------------

    public function expenses(Request $request): AnonymousResourceCollection
    {
        $this->requireAdmin($request);
        $q = Expense::query()->with(['company', 'category', 'account'])
            ->when($request->integer('category_id'), fn ($q, $id) => $q->where('expense_category_id', $id))
            ->when($request->query('search'), fn ($q, $s) => $q->where(fn ($q) => $q->where('description', 'like', "%{$s}%")->orWhere('reference', 'like', "%{$s}%")));
        $this->companyFilter($q, $request);
        $this->dateRange($q, $request);

        return MoneyOutResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function showExpense(Request $request, int $id): MoneyOutResource
    {
        $this->requireAdmin($request);

        return new MoneyOutResource(Expense::with(['company', 'category', 'account'])->findOrFail($id));
    }

    public function storeExpense(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $data = $request->validate($this->expenseRules());
        $data['receipt_path'] = $this->storeUpload($request->file('receipt'), 'receipts');

        try {
            $e = $this->payments->saveExpense(null, $data);
        } catch (\Throwable $ex) {
            $data['receipt_path'] && Storage::disk('local')->delete($data['receipt_path']);
            throw $ex;
        }

        return (new MoneyOutResource($e->load(['company', 'category', 'account'])))->response()->setStatusCode(201);
    }

    public function updateExpense(Request $request, int $id): MoneyOutResource
    {
        $this->requireAdmin($request);
        $model = Expense::findOrFail($id);
        $data = array_merge(
            $model->only(['expense_category_id', 'account_id', 'amount', 'description', 'reference', 'notes']) + ['date' => $model->date->toDateString()],
            $request->validate(array_map(fn ($r) => ['sometimes', ...$r], $this->expenseRules())),
        );
        $data['receipt_path'] = $this->storeUpload($request->file('receipt'), 'receipts');
        $old = $model->receipt_path;

        $saved = $this->payments->saveExpense($model, $data);
        if ($data['receipt_path'] && $old) {
            Storage::disk('local')->delete($old);
        }

        return new MoneyOutResource($saved->load(['company', 'category', 'account']));
    }

    public function destroyExpense(Request $request, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        $this->payments->delete(Expense::findOrFail($id));

        return response()->json(['message' => 'Expense deleted.']);
    }

    // ---------------------------------------------------------------------

    private function supplierRules(): array
    {
        return [
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'account_id' => ['required', 'integer', 'exists:accounts,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'receipt' => $this->fileRule(),
            'taxes' => ['nullable', 'array', 'max:10'],
            'taxes.*.tax_id' => ['required', 'integer', 'distinct', 'exists:taxes,id'],
            'taxes.*.amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
        ];
    }

    private function expenseRules(): array
    {
        return [
            'expense_category_id' => ['required', 'integer', 'exists:expense_categories,id'],
            'account_id' => ['required', 'integer', 'exists:accounts,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'description' => ['required', 'string', 'max:255'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'receipt' => $this->fileRule(),
        ];
    }
}
