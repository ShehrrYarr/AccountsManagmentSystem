<?php

/**
 * Admin: every agent with the company money they hold (and owe back), split by company.
 */

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Balances;
use App\Support\Money;

use function Livewire\Volt\{computed, on, state};

state(['showInactive' => false]);

$agents = computed(fn () => User::query()
    ->where('role', UserRole::Agent)
    ->when(! $this->showInactive, fn ($q) => $q->where('is_active', true))
    ->withCount('agentAccounts')
    ->orderBy('name')->get());

// agent id => [company id => owed]
$owed = computed(fn () => Balances::agents()->groupBy('agent_id')
    ->map(fn ($rows) => $rows->mapWithKeys(fn ($r) => [$r->company_id => $r->owed])->reject(fn ($v) => Money::isZero($v))));

$companies = computed(fn () => Company::withTrashed()->pluck('name', 'id'));

$pending = computed(fn () => Transfer::pending()->with('fromAccount')->get()->groupBy(fn ($t) => $t->fromAccount?->agent_id)->map->count());

on(['transaction-updated' => function () {
    unset($this->owed, $this->pending);
}, 'approval-updated' => function () {
    unset($this->pending);
}]);

?>

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center">
        <h5 class="card-title mb-0 me-auto">Money with agents</h5>
        <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" id="ag-inactive" wire:model.live="showInactive">
            <label class="form-check-label fs-13" for="ag-inactive">Show inactive agents</label>
        </div>
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('transfer-create', { mode: 'advance' })"><i class="ri-user-shared-line me-1"></i>Advance to agent</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 ams-table">
            <thead class="table-light">
                <tr><th>Agent</th><th class="d-none d-md-table-cell">Owes by company</th><th class="money">Owes in total</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($this->agents as $agent)
                    @php($byCompany = $this->owed[$agent->id] ?? collect())
                    <tr wire:key="ag-{{ $agent->id }}">
                        <td>
                            <a href="{{ route('agents.show', $agent) }}" class="fw-semibold text-body">{{ $agent->name }}</a>
                            @unless ($agent->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                            @if ($n = $this->pending[$agent->id] ?? 0)
                                <a href="{{ route('approvals.index') }}" class="badge bg-warning-subtle text-warning ms-1">{{ $n }} return{{ $n > 1 ? 's' : '' }} to approve</a>
                            @endif
                            <div class="fs-12 text-muted">{{ $agent->phone ?: $agent->email }} · {{ $agent->agent_accounts_count }} account{{ $agent->agent_accounts_count === 1 ? '' : 's' }}</div>
                        </td>
                        <td class="fs-13 d-none d-md-table-cell">
                            @forelse ($byCompany as $companyId => $amount)
                                <div><span class="text-muted">{{ $this->companies[$companyId] ?? '?' }}</span> <strong>{{ money($amount) }}</strong></div>
                            @empty
                                <span class="text-muted">—</span>
                            @endforelse
                        </td>
                        <td class="money fw-semibold">{{ money(Money::add(...$byCompany->values()->all())) }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('agents.show', $agent) }}" class="btn btn-sm btn-light"><i class="ri-book-open-line me-1"></i>Ledger</a>
                            <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Send an advance" x-on:click="Livewire.dispatch('transfer-create', { mode: 'advance', agentId: {{ $agent->id }} })"><i class="ri-user-shared-line"></i></button>
                            <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Record a return" x-on:click="Livewire.dispatch('transfer-create', { mode: 'return', agentId: {{ $agent->id }} })"><i class="ri-user-received-line"></i></button>
                        </td>
                    </tr>
                @empty
                    <x-empty-row :colspan="4" icon="ri-user-star-line" message="No agents yet. Add them on Users & Agents." />
                @endforelse
            </tbody>
            @if ($this->agents->isNotEmpty())
                <tfoot class="table-light fw-semibold">
                    <tr>
                        <td colspan="2" class="d-none d-md-table-cell">All agents</td>
                        <td class="d-md-none">All agents</td>
                        <td class="money">{{ money(Balances::withAgents()) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
    <div class="card-footer fs-12 text-muted"><i class="ri-information-line me-1"></i>What each agent holds of the companies' money (advances and opening amounts, less returns). It isn't counted in the companies' cash and bank.</div>
</div>
