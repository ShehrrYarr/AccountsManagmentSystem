<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\BusinessRuleException;
use App\Http\Resources\Api\ChangeRequestResource;
use App\Http\Resources\Api\ChequeResource;
use App\Models\Cheque;
use App\Models\ChequeChangeRequest;
use App\Services\ChequeApprovalService;
use App\Services\ChequeService;
use App\Support\ChequeRules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Government cheques. Entering a cheque deposits it the same day (or on deposited_on, for an
 * entry made offline earlier; never in the future). An agent sees only the cheques they received,
 * and their edits / deletes become requests the admin approves.
 */
class ChequeController extends ApiController
{
    private const FIELDS = ['cheque_date', 'company_id', 'deposit_account_id', 'issuing_branch', 'department_id', 'cheque_number', 'amount', 'bank_charges', 'notes', 'deposit_reference'];

    public function __construct(private ChequeService $cheques, private ChequeApprovalService $approvals) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $q = Cheque::query()->visibleTo($request->user())
            ->with(['company', 'department', 'depositAccount', 'receiver', 'pendingRequest.requester', 'latestRequest.requester', 'latestRequest.decider'])
            ->when($request->query('search'), fn ($q, $s) => $q->where(fn ($q) => $q->where('cheque_number', 'like', "%{$s}%")
                ->orWhere('deposit_reference', 'like', "%{$s}%")->orWhere('notes', 'like', "%{$s}%")))
            ->when($request->integer('department_id'), fn ($q, $id) => $q->where('department_id', $id))
            ->when($request->integer('account_id'), fn ($q, $id) => $q->where('deposit_account_id', $id))
            ->when($this->isAdmin($request) && $request->integer('received_by'), fn ($q, $id) => $q->where('created_by', $id))
            ->when($request->boolean('pending_request'), fn ($q) => $q->whereHas('pendingRequest'));
        $this->companyFilter($q, $request);
        $this->dateRange($q, $request);

        return ChequeResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function show(Request $request, int $cheque): ChequeResource
    {
        return new ChequeResource(Cheque::visibleTo($request->user())
            ->with(['company', 'department', 'depositAccount', 'receiver', 'pendingRequest.requester', 'latestRequest.requester', 'latestRequest.decider'])
            ->findOrFail($cheque));
    }

    /** Deposit one cheque (multipart when a picture is attached). */
    public function store(Request $request): JsonResponse
    {
        $data = $this->validated($request);
        $data['scan_path'] = $this->storeUpload($request->file('picture'), 'cheques');

        try {
            $cheque = $this->cheques->save(null, $data, $request->user());
        } catch (\Throwable $e) {
            $this->forget($data['scan_path']);
            throw $e;
        }

        return (new ChequeResource($cheque->load(['company', 'department', 'depositAccount', 'receiver'])))->response()->setStatusCode(201);
    }

    /**
     * Deposit several cheques together, all-or-nothing (the Deposit Cheque page's table).
     * rows[i][...] like a single cheque, rows[i][picture] optional. A failing row is reported as
     * errors["rows.i.<field>"] or errors["rows.i"].
     */
    public function batch(Request $request): JsonResponse
    {
        $rows = $request->input('rows');
        if (! is_array($rows) || $rows === [] || count($rows) > 100) {
            throw ValidationException::withMessages(['rows' => 'Send 1 to 100 cheques in rows[].']);
        }

        $clean = [];
        $numbers = [];
        foreach (array_values($rows) as $i => $row) {
            $row = is_array($row) ? $row : [];
            $v = Validator::make($row + ['picture' => $request->file("rows.$i.picture")], $this->rules(), ChequeRules::messages(), ChequeRules::attributes());
            if ($v->fails()) {
                throw ValidationException::withMessages(collect($v->errors()->messages())->mapWithKeys(fn ($m, $f) => ["rows.$i.$f" => $m])->all());
            }
            $number = mb_strtolower(trim((string) $row['cheque_number']));
            if (isset($numbers[$number])) {
                throw ValidationException::withMessages(["rows.$i.cheque_number" => 'This cheque number is already in rows (row '.($numbers[$number] + 1).').']);
            }
            $numbers[$number] = $i;
            $clean[$i] = $this->toServiceData($v->validated());
        }

        $stored = [];
        try {
            foreach ($clean as $i => $data) {
                $clean[$i]['scan_path'] = $stored[] = $this->storeUpload($request->file("rows.$i.picture"), 'cheques');
            }
            $saved = $this->cheques->saveMany($clean, $request->user());
        } catch (\Throwable $e) {
            array_map(fn ($p) => $this->forget($p), $stored);
            throw $e;
        }

        return ChequeResource::collection(collect($saved)->map->load(['company', 'department', 'depositAccount', 'receiver']))
            ->response()->setStatusCode(201);
    }

    /**
     * Change a cheque (send only the fields that change; picture to replace it). Admin: applied.
     * Agent: becomes a request for the admin (202) — the cheque stays as it is until approved.
     */
    public function update(Request $request, int $cheque): JsonResponse
    {
        $model = Cheque::visibleTo($request->user())->findOrFail($cheque);
        $current = $model->only(self::FIELDS);
        $current['cheque_date'] = $model->cheque_date->toDateString();
        $data = $this->toServiceData(array_merge($current, $this->validated($request, $model->id, partial: true)));
        unset($data['date']); // an edit keeps its deposit date
        $data['scan_path'] = $this->storeUpload($request->file('picture'), 'cheques');

        try {
            if ($this->isAdmin($request)) {
                $old = $model->scan_path;
                $saved = $this->cheques->save($model, $data, $request->user());
                if ($data['scan_path'] && $old) {
                    $this->forget($old);
                }

                return (new ChequeResource($saved->load(['company', 'department', 'depositAccount', 'receiver'])))->response();
            }

            $req = $this->approvals->requestEdit($model, $data, $request->user(), $request->input('reason'));
        } catch (\Throwable $e) {
            $this->forget($data['scan_path']);
            throw $e;
        }

        return (new ChangeRequestResource($req->load('requester')))->additional(['message' => 'Sent to the admin for approval.'])->response()->setStatusCode(202);
    }

    /** Admin: delete. Agent: ask the admin to delete it (202). Body: {reason} optional. */
    public function destroy(Request $request, int $cheque): JsonResponse
    {
        $model = Cheque::visibleTo($request->user())->findOrFail($cheque);

        if ($this->isAdmin($request)) {
            $this->cheques->delete($model);

            return response()->json(['message' => "Cheque #{$model->cheque_number} deleted."]);
        }

        $req = $this->approvals->requestDelete($model, $request->user(), $request->input('reason'));

        return (new ChangeRequestResource($req->load('requester')))->additional(['message' => 'Sent to the admin for approval.'])->response()->setStatusCode(202);
    }

    /** Agent: withdraw their own pending request. */
    public function withdrawRequest(Request $request, int $changeRequest): JsonResponse
    {
        $this->approvals->cancel(ChequeChangeRequest::findOrFail($changeRequest), $request->user());

        return response()->json(['message' => 'Request withdrawn.']);
    }

    // ---------------------------------------------------------------------

    private function rules(?int $ignoreId = null, bool $partial = false): array
    {
        $rules = ChequeRules::rules($ignoreId, false) + [
            'picture' => $this->fileRule(),
            'deposited_on' => ['nullable', 'date', 'before_or_equal:today'],
        ];

        return $partial ? array_map(fn ($r) => ['sometimes', ...$r], $rules) : $rules;
    }

    private function validated(Request $request, ?int $ignoreId = null, bool $partial = false): array
    {
        $data = Validator::make($request->all() + ['picture' => $request->file('picture')], $this->rules($ignoreId, $partial), ChequeRules::messages(), ChequeRules::attributes())->validate();

        return $partial ? Arr::except($data, ['picture', 'deposited_on']) : $this->toServiceData($data);
    }

    /** Form fields → ChequeService fields (deposited_on → date). */
    private function toServiceData(array $data): array
    {
        $out = Arr::only($data, self::FIELDS);
        if (! empty($data['deposited_on'])) {
            $out['date'] = substr((string) $data['deposited_on'], 0, 10);
        }

        return $out;
    }

    private function forget(?string $path): void
    {
        if ($path) {
            Storage::disk('local')->delete($path);
        }
    }
}
