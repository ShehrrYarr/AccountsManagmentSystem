<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\ChangeRequestResource;
use App\Http\Resources\Api\PaymentResource;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use App\Services\PaymentApprovalService;
use App\Services\PaymentService;
use App\Support\PaymentRules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Department payments (Pay Department). Admin: cash (no company), bank transfer from a company
 * bank, or goods (paid from a bank or on credit). Agent: bank transfer from their own bank for a
 * company they choose; saved straight away; their edits / deletes go to the admin.
 */
class PaymentController extends ApiController
{
    private const WITH = ['company', 'department', 'account.agent', 'supplier', 'creator', 'taxes.tax'];

    public function __construct(private PaymentService $payments, private PaymentApprovalService $approvals) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $q = Payment::query()->visibleTo($request->user())
            ->with([...self::WITH, 'pendingRequest.requester', 'latestRequest.requester', 'latestRequest.decider'])
            ->when($request->query('method'), fn ($q, $m) => $q->where('method', $m))
            ->when($request->integer('department_id'), fn ($q, $id) => $q->where('department_id', $id))
            ->when($request->integer('supplier_id'), fn ($q, $id) => $q->where('supplier_id', $id))
            ->when($request->integer('account_id'), fn ($q, $id) => $q->where('account_id', $id))
            ->when($request->boolean('pending_request'), fn ($q) => $q->whereHas('pendingRequest'))
            ->when($request->query('search'), function ($q, $s) {
                $q->where(fn ($q) => $q->where('reference', 'like', "%{$s}%")->orWhere('item_description', 'like', "%{$s}%")
                    ->orWhere('received_by', 'like', "%{$s}%")->orWhere('notes', 'like', "%{$s}%"));
            });
        $this->companyFilter($q, $request);
        $this->dateRange($q, $request);

        return PaymentResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function show(Request $request, int $payment): PaymentResource
    {
        return new PaymentResource(Payment::visibleTo($request->user())
            ->with([...self::WITH, 'pendingRequest.requester', 'latestRequest.requester', 'latestRequest.decider'])->findOrFail($payment));
    }

    /** One payment (multipart when a receipt is attached). */
    public function store(Request $request): JsonResponse
    {
        $data = $this->validated($request->all() + ['receipt' => $request->file('receipt')], $request);
        $data['receipt_path'] = $this->storeUpload($request->file('receipt'), 'receipts');

        try {
            $payment = $this->payments->savePayment(null, $data, $request->user());
        } catch (\Throwable $e) {
            $this->forget($data['receipt_path']);
            throw $e;
        }

        return (new PaymentResource($payment->load(self::WITH)))->response()->setStatusCode(201);
    }

    /**
     * Several payments together, all-or-nothing (the Pay Department page's table).
     * rows[i][...] like a single payment, rows[i][receipt] optional. A failing row is reported as
     * errors["rows.i.<field>"] or errors["rows.i"]; a total-level problem (e.g. not enough cash for
     * all of them) as errors["amount"].
     */
    public function batch(Request $request): JsonResponse
    {
        $rows = $request->input('rows');
        if (! is_array($rows) || $rows === [] || count($rows) > 100) {
            throw ValidationException::withMessages(['rows' => 'Send 1 to 100 payments in rows[].']);
        }

        $clean = [];
        foreach (array_values($rows) as $i => $row) {
            $row = is_array($row) ? $row : [];
            try {
                $clean[$i] = $this->validated($row + ['receipt' => $request->file("rows.$i.receipt")], $request);
            } catch (ValidationException $e) {
                throw ValidationException::withMessages(collect($e->errors())->mapWithKeys(fn ($m, $f) => ["rows.$i.$f" => $m])->all());
            }
        }

        $stored = [];
        try {
            foreach ($clean as $i => $data) {
                $clean[$i]['receipt_path'] = $stored[] = $this->storeUpload($request->file("rows.$i.receipt"), 'receipts');
            }
            $saved = $this->payments->savePayments($clean, $request->user());
        } catch (\Throwable $e) {
            array_map(fn ($p) => $this->forget($p), $stored);
            throw $e;
        }

        return PaymentResource::collection(collect($saved)->map->load(self::WITH))->response()->setStatusCode(201);
    }

    /**
     * Change a payment (send only what changes; receipt to replace it). Admin: applied.
     * Agent: becomes a request for the admin (202).
     */
    public function update(Request $request, int $payment): JsonResponse
    {
        $model = Payment::visibleTo($request->user())->findOrFail($payment);
        $current = $model->only([...PaymentRules::BATCH_FIELDS, ...PaymentRules::ITEM_FIELDS]);
        $current['method'] = $model->method->value;
        $current['date'] = $model->date->toDateString();
        $current['on_credit'] = $model->on_credit ? '1' : '0';
        $current['taxes'] = $model->taxes->map(fn ($t) => ['tax_id' => $t->tax_id, 'amount' => $t->amount])->all();
        $data = $this->validated(array_merge($current, Arr::except($request->all(), ['receipt'])) + ['receipt' => $request->file('receipt')], $request);
        $data['receipt_path'] = $this->storeUpload($request->file('receipt'), 'receipts');

        try {
            if ($this->isAdmin($request)) {
                $old = $model->receipt_path;
                $saved = $this->payments->savePayment($model, $data, $request->user());
                if ($data['receipt_path'] && $old) {
                    $this->forget($old);
                }

                return (new PaymentResource($saved->load(self::WITH)))->response();
            }

            $req = $this->approvals->requestEdit($model, $data, $request->user(), $request->input('reason'));
        } catch (\Throwable $e) {
            $this->forget($data['receipt_path']);
            throw $e;
        }

        return (new ChangeRequestResource($req->load('requester')))->additional(['message' => 'Sent to the admin for approval.'])->response()->setStatusCode(202);
    }

    /** Admin: delete. Agent: ask the admin to delete it (202). Body: {reason} optional. */
    public function destroy(Request $request, int $payment): JsonResponse
    {
        $model = Payment::visibleTo($request->user())->findOrFail($payment);

        if ($this->isAdmin($request)) {
            $this->payments->delete($model);

            return response()->json(['message' => 'Payment deleted.']);
        }

        $req = $this->approvals->requestDelete($model, $request->user(), $request->input('reason'));

        return (new ChangeRequestResource($req->load('requester')))->additional(['message' => 'Sent to the admin for approval.'])->response()->setStatusCode(202);
    }

    public function withdrawRequest(Request $request, int $changeRequest): JsonResponse
    {
        $this->approvals->cancel(PaymentChangeRequest::findOrFail($changeRequest), $request->user());

        return response()->json(['message' => 'Request withdrawn.']);
    }

    // ---------------------------------------------------------------------

    /** Validate with the website's rules; an agent's payment is always a bank transfer. */
    private function validated(array $input, Request $request): array
    {
        if (! $this->isAdmin($request)) {
            $input['method'] ??= 'bank_transfer';
        }
        $input['description'] ??= $input['item_description'] ?? null; // the API calls it "description"
        $input['item_description'] = $input['description'];

        $data = Validator::make($input, PaymentRules::rules($input, ! $this->isAdmin($request)), PaymentRules::messages(), PaymentRules::attributes())->validate();

        return Arr::only($data, [...PaymentRules::BATCH_FIELDS, ...PaymentRules::ITEM_FIELDS]);
    }

    private function forget(?string $path): void
    {
        if ($path) {
            Storage::disk('local')->delete($path);
        }
    }
}
