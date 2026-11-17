<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\LedgerRecordResource;
use App\Models\AuditLog;
use App\Models\Transaction;
use App\Services\Balances;
use App\Services\StatementService;
use App\Support\Money;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Statements (running balances, as JSON; the PDF is at .../pdf), the journal and the audit log.
 *
 * Statement kinds: account | department | supplier | company | agent. Admin: any. Agent: their
 * own ledger (agent/{own id}) and their own accounts. ?company_id= narrows department, supplier,
 * agent and agent-account statements ("none" = the no-company part paid from the cash).
 */
class ReportController extends ApiController
{
    public function __construct(private StatementService $statements) {}

    public function statement(Request $request, string $kind, int $id): JsonResponse
    {
        abort_unless(in_array($kind, StatementService::KINDS, true), 404);
        abort_unless(StatementService::canView($request->user(), $kind, $id), 403);
        $request->validate(['from' => ['nullable', 'date'], 'to' => ['nullable', 'date', 'after_or_equal:from']]);

        $company = $this->balanceCompany($request);
        $s = $this->statements->build($kind, $id, $company, $request->query('from'), $request->query('to'));

        return response()->json(['data' => [
            'kind' => $s['kind'],
            'title' => $s['title'],
            'name' => $s['name'],
            'company' => $s['company'] ? ['id' => $s['company']->id, 'name' => $s['company']->name] : ($company === Balances::NONE ? ['id' => null, 'name' => 'No company (cash)'] : null),
            'labels' => $s['labels'],
            'note' => $s['note'],
            'from' => $s['from']?->toDateString(),
            'to' => $s['to']?->toDateString(),
            'opening' => $s['opening'],
            'totals' => $s['totals'],
            'closing' => $s['closing'],
            'rows' => collect($s['rows'])->map(fn ($r) => [
                'transaction_id' => $r['id'],
                'date' => $r['date']->toDateString(),
                'type' => $r['type']->value,
                'type_label' => $r['type']->label(),
                'description' => $r['description'],
                'reference' => $r['reference'],
                'notes' => $r['notes'],
                'company' => $r['company'],
                'amount' => $s['showAmount'] ? Money::of($r['amount']) : null,
                'debit' => $r['debit'],
                'credit' => $r['credit'],
                'balance' => $r['balance'],
            ])->values(),
            'pdf_url' => route('api.statements.pdf', array_filter([
                'kind' => $kind, 'id' => $id, 'company_id' => $request->query('company_id'),
                'from' => $request->query('from'), 'to' => $request->query('to'),
            ], fn ($v) => $v !== null && $v !== '')),
            'generated_at' => $s['generatedAt']->toIso8601String(),
        ]]);
    }

    /** The same PDF as the website's (download / share from the app). */
    public function statementPdf(Request $request, string $kind, int $id)
    {
        if ($request->has('company_id')) {
            $value = $request->query('company_id');
            $request->query->set('company', $value === 'none' ? '0' : $value);
        }

        return app(\App\Http\Controllers\StatementController::class)->pdf($request, $kind, $id);
    }

    /** Admin: the journal (every posted / voided transaction), with lines on ?with_lines=1. */
    public function transactions(Request $request): AnonymousResourceCollection
    {
        $this->requireAdmin($request);
        $q = Transaction::query()->with(['company', 'creator'])
            ->when($request->boolean('with_lines'), fn ($q) => $q->with('entries.account', 'entries.department', 'entries.supplier', 'entries.counterparty', 'entries.category'))
            ->when($request->query('type'), fn ($q, $t) => $q->where('type', $t))
            ->when($request->query('status', 'posted') !== 'all', fn ($q) => $q->where('status', $request->query('status', 'posted')))
            ->when($request->integer('company_id'), fn ($q, $id) => $q->whereHas('entries', fn ($e) => $e->where('company_id', $id)))
            ->when($request->integer('account_id'), fn ($q, $id) => $q->whereHas('entries', fn ($e) => $e->where('account_id', $id)))
            ->when($request->integer('department_id'), fn ($q, $id) => $q->where('department_id', $id))
            ->when($request->query('search'), fn ($q, $s) => $q->where(fn ($q) => $q->where('description', 'like', "%{$s}%")->orWhere('reference', 'like', "%{$s}%")));
        $this->dateRange($q, $request);

        return LedgerRecordResource::collection($q->orderByDesc('date')->orderByDesc('id')->paginate($this->perPage($request)));
    }

    public function transaction(Request $request, int $id): LedgerRecordResource
    {
        $this->requireAdmin($request);

        return new LedgerRecordResource(Transaction::with(['company', 'creator', 'entries.account', 'entries.department', 'entries.supplier', 'entries.counterparty', 'entries.category'])->findOrFail($id));
    }

    /** Admin: who changed what. */
    public function auditLog(Request $request): JsonResponse
    {
        $this->requireAdmin($request);
        $page = AuditLog::query()->with('user')
            ->when($request->integer('user_id'), fn ($q, $id) => $q->where('user_id', $id))
            ->when($request->query('type'), fn ($q, $t) => $q->where('auditable_type', $t))
            ->when($request->query('event'), fn ($q, $e) => $q->where('event', $e))
            ->when($request->date('from'), fn ($q, $d) => $q->where('created_at', '>=', $d->startOfDay()))
            ->when($request->date('to'), fn ($q, $d) => $q->where('created_at', '<=', $d->endOfDay()))
            ->latest('id')->paginate($this->perPage($request));

        $page->getCollection()->transform(fn (AuditLog $l) => [
            'id' => $l->id,
            'event' => $l->event,
            'record' => ['type' => $l->auditable_type, 'id' => $l->auditable_id],
            'user' => $l->user ? ['id' => $l->user->id, 'name' => $l->user->name] : null,
            'old_values' => $l->old_values,
            'new_values' => $l->new_values,
            'ip_address' => $l->ip_address,
            'created_at' => $l->created_at?->toIso8601String(),
        ]);

        return response()->json($page);
    }
}
