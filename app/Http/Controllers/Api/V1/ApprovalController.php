<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\ChangeRequestResource;
use App\Http\Resources\Api\ChequeResource;
use App\Http\Resources\Api\PaymentResource;
use App\Http\Resources\Api\TransferResource;
use App\Models\ChequeChangeRequest;
use App\Models\PaymentChangeRequest;
use App\Models\Transfer;
use App\Services\ChequeApprovalService;
use App\Services\PaymentApprovalService;
use App\Services\TransferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Admin: what agents asked for — cheque and payment edits / deletes, and money returned — with
 * the current record next to each request, plus the latest decisions.
 */
class ApprovalController extends ApiController
{
    public function __construct(
        private ChequeApprovalService $cheques,
        private PaymentApprovalService $payments,
        private TransferService $transfers,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $returnWith = ['fromAccount.agent', 'toAccount.company', 'fromCompany', 'toCompany', 'creator', 'decider'];

        $withRecord = fn ($r, string $key, $resource, $record) => (new ChangeRequestResource($r))->toArray($request)
            + [$key => $record ? (new $resource($record))->toArray($request) : null];

        return response()->json(['data' => [
            'cheque_requests' => ChequeChangeRequest::pending()->with(['cheque.company', 'cheque.department', 'cheque.depositAccount', 'cheque.receiver', 'requester'])->oldest()->get()
                ->map(fn ($r) => $withRecord($r, 'cheque', ChequeResource::class, $r->cheque)),
            'payment_requests' => PaymentChangeRequest::pending()->with(['payment.company', 'payment.department', 'payment.account.agent', 'payment.supplier', 'payment.creator', 'requester'])->oldest()->get()
                ->map(fn ($r) => $withRecord($r, 'payment', PaymentResource::class, $r->payment)),
            'returns' => TransferResource::collection(Transfer::pending()->with($returnWith)->oldest()->get()),
            'recently_decided' => [
                'cheque_requests' => ChangeRequestResource::collection(ChequeChangeRequest::where('status', '!=', 'pending')->with(['requester', 'decider'])->latest('decided_at')->limit(10)->get()),
                'payment_requests' => ChangeRequestResource::collection(PaymentChangeRequest::where('status', '!=', 'pending')->with(['requester', 'decider'])->latest('decided_at')->limit(10)->get()),
                'returns' => TransferResource::collection(Transfer::whereNotNull('decided_at')->with($returnWith)->latest('decided_at')->limit(10)->get()),
            ],
        ]]);
    }

    /** POST approvals/{kind}/{id}/approve — kind: cheque-requests | payment-requests | returns. */
    public function approve(Request $request, string $kind, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        $note = $request->validate(['note' => ['nullable', 'string', 'max:500']])['note'] ?? null;
        $admin = $request->user();

        match ($kind) {
            'cheque-requests' => $this->cheques->approve(ChequeChangeRequest::findOrFail($id), $admin, $note),
            'payment-requests' => $this->payments->approve(PaymentChangeRequest::findOrFail($id), $admin, $note),
            'returns' => $this->transfers->approve(Transfer::findOrFail($id), $admin),
        };

        return response()->json(['message' => 'Approved.']);
    }

    /** POST approvals/{kind}/{id}/reject — body: {note} optional, shown to the agent. */
    public function reject(Request $request, string $kind, int $id): JsonResponse
    {
        $this->requireAdmin($request);
        $note = $request->validate(['note' => ['nullable', 'string', 'max:500']])['note'] ?? null;
        $admin = $request->user();

        match ($kind) {
            'cheque-requests' => $this->cheques->reject(ChequeChangeRequest::findOrFail($id), $admin, $note),
            'payment-requests' => $this->payments->reject(PaymentChangeRequest::findOrFail($id), $admin, $note),
            'returns' => $this->transfers->reject(Transfer::findOrFail($id), $admin, $note),
        };

        return response()->json(['message' => 'Rejected.']);
    }
}
