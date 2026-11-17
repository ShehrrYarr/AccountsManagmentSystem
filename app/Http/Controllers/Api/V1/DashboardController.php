<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Account;
use App\Models\Cheque;
use App\Models\ChequeChangeRequest;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use App\Models\Transfer;
use App\Services\Balances;
use App\Support\Money;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Home screen numbers. Admin: the website's dashboard cards (all companies, or ?company_id=).
 * Agent: what they hold of each company's money, their accounts and this month's work.
 * /notifications: the bell — what waits for whom.
 */
class DashboardController extends ApiController
{
    public function show(Request $request): JsonResponse
    {
        return $this->isAdmin($request) ? $this->admin($request) : $this->agent($request);
    }

    private function admin(Request $request): JsonResponse
    {
        $companyId = $request->integer('company_id') ?: null;
        $depts = Balances::departments($companyId);
        $month = [now()->startOfMonth()->toDateString(), now()->toDateString()];
        $cheques = Cheque::query()->when($companyId, fn ($q) => $q->where('company_id', $companyId))->whereBetween('date', $month);
        $owe = $depts->filter(fn ($r) => Money::isPositive($r->balance));

        return response()->json(['data' => [
            'company_id' => $companyId,
            'money' => Balances::money($companyId),
            'with_agents' => Balances::withAgents($companyId),
            'owed_to_agents' => Balances::owedToAgents($companyId),
            'cheques_this_month' => ['amount' => Money::of((clone $cheques)->sum('amount')), 'count' => (clone $cheques)->count()],
            'departments_owe' => Money::add(...$owe->pluck('balance')->all()),
            'departments_owe_count' => $owe->unique('department_id')->count(),
            'held_for_departments' => Money::sub(0, Money::add(...$depts->filter(fn ($r) => Money::isNegative($r->balance))->pluck('balance')->all())),
            'owed_to_suppliers' => Money::add(...Balances::suppliers($companyId)->pluck('owed')->all()),
            'profit_this_month' => Balances::profit($companyId, now()->startOfMonth(), now()),
            'approvals_pending' => $this->pendingApprovals(),
        ]]);
    }

    private function agent(Request $request): JsonResponse
    {
        $user = $request->user();
        $month = [now()->startOfMonth()->toDateString(), now()->toDateString()];
        $byCompany = Balances::agents(null, $user->id);
        $names = \App\Models\Company::withTrashed()->pluck('name', 'id');

        return response()->json(['data' => [
            'you_hold' => Money::add(...$byCompany->pluck('owed')->all()),
            'by_company' => $byCompany->map(fn ($r) => [
                'company' => ['id' => $r->company_id, 'name' => $names[$r->company_id] ?? '?'],
                'given' => $r->advanced, 'returned_or_spent' => $r->returned, 'you_hold' => $r->owed,
            ])->values(),
            'accounts' => Account::where('agent_id', $user->id)->orderBy('type')->orderBy('name')->get()
                ->map(fn ($a) => ['id' => $a->id, 'label' => $a->shortLabel(), 'type' => $a->type->value, 'balance' => $a->current_balance]),
            'cheques_this_month' => [
                'amount' => Money::of(Cheque::where('created_by', $user->id)->whereBetween('date', $month)->sum('amount')),
                'count' => Cheque::where('created_by', $user->id)->whereBetween('date', $month)->count(),
            ],
            'payments_this_month' => [
                'amount' => Money::of(Payment::where('created_by', $user->id)->whereBetween('date', $month)->sum('amount')),
                'count' => Payment::where('created_by', $user->id)->whereBetween('date', $month)->count(),
            ],
            'waiting_for_admin' => $this->agentPending($user->id),
        ]]);
    }

    /** The bell: counts only, cheap to poll. */
    public function notifications(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return response()->json(['data' => ['approvals_pending' => $this->pendingApprovals()]]);
        }

        $since = now()->subDays(7);

        return response()->json(['data' => [
            'waiting_for_admin' => $this->agentPending($user->id),
            'decided_last_7_days' => [
                'cheque_requests' => ChequeChangeRequest::where('requested_by', $user->id)->whereNotNull('decided_at')->where('decided_at', '>=', $since)->count(),
                'payment_requests' => PaymentChangeRequest::where('requested_by', $user->id)->whereNotNull('decided_at')->where('decided_at', '>=', $since)->count(),
                'returns' => Transfer::where('created_by', $user->id)->whereNotNull('decided_at')->where('decided_at', '>=', $since)->count(),
            ],
        ]]);
    }

    /** @return array{cheque_requests: int, payment_requests: int, returns: int, total: int} */
    private function pendingApprovals(): array
    {
        $counts = [
            'cheque_requests' => ChequeChangeRequest::pending()->count(),
            'payment_requests' => PaymentChangeRequest::pending()->count(),
            'returns' => Transfer::pending()->count(),
        ];

        return $counts + ['total' => array_sum($counts)];
    }

    /** @return array{cheque_requests: int, payment_requests: int, returns: int, total: int} */
    private function agentPending(int $userId): array
    {
        $counts = [
            'cheque_requests' => ChequeChangeRequest::pending()->where('requested_by', $userId)->count(),
            'payment_requests' => PaymentChangeRequest::pending()->where('requested_by', $userId)->count(),
            'returns' => Transfer::pending()->where('created_by', $userId)->count(),
        ];

        return $counts + ['total' => array_sum($counts)];
    }
}
