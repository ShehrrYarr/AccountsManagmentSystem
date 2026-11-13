<?php

/**
 * One agent at a glance: what they owe in total and per company, and their accounts with balances.
 * For the admin (agent page) and for the agent themself (My Ledger).
 */

use App\Models\Company;
use App\Models\User;
use App\Services\Balances;
use App\Support\Money;

use function Livewire\Volt\{computed, mount, on, state};

state(['agentId' => null])->locked();

mount(function (int $agentId) {
    abort_unless(auth()->user()->isAdmin() || auth()->id() === $agentId, 403);
    $this->agentId = $agentId;
});

$agent = computed(fn () => User::with(['agentAccounts' => fn ($q) => $q->orderBy('type')->orderBy('name')])->findOrFail($this->agentId));
$byCompany = computed(fn () => Balances::agents(null, $this->agentId)->reject(fn ($r) => Money::isZero($r->owed) && Money::isZero($r->advanced)));
$companies = computed(fn () => Company::withTrashed()->pluck('name', 'id'));

on(['transaction-updated' => function () {
    unset($this->agent, $this->byCompany);
}]);

?>

@php($mine = auth()->id() === $agentId)
<div class="row g-3 mb-3">
    <div class="col-lg-5">
        <div class="card h-100 mb-0 border-success-subtle">
            <div class="card-body">
                <div class="text-muted fs-13">{{ $mine ? 'You owe the companies' : $this->agent->name.' owes the companies' }}</div>
                <div class="fs-24 fw-semibold ams-balance">{{ money(Money::add(...$this->byCompany->pluck('owed')->all())) }}</div>
                <div class="mt-2 fs-13">
                    @forelse ($this->byCompany as $r)
                        <div class="d-flex justify-content-between border-top py-1">
                            <span>{{ $this->companies[$r->company_id] ?? '?' }}</span>
                            <span><span class="text-muted fs-12 me-2">given {{ money($r->advanced) }} · returned / spent {{ money($r->returned) }}</span><strong class="{{ Money::isNegative($r->owed) ? 'text-success' : '' }}" title="{{ Money::isNegative($r->owed) ? 'The company owes '.($mine ? 'you' : $this->agent->name) : '' }}">{{ Money::isNegative($r->owed) ? 'owed '.money(Money::sub(0, $r->owed)) : money($r->owed) }}</strong></span>
                        </div>
                    @empty
                        <div class="text-muted">Nothing given or returned yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header py-2"><h6 class="card-title mb-0">{{ $mine ? 'My accounts' : 'Accounts' }}</h6></div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 fs-13">
                    <tbody>
                        @forelse ($this->agent->agentAccounts as $a)
                            <tr wire:key="sa-{{ $a->id }}">
                                <td>
                                    <i class="{{ $a->type->icon() }} me-1 text-{{ $a->isCash() ? 'success' : 'primary' }}"></i>
                                    <a href="{{ $mine ? route('my-accounts.show', $a) : route('accounts.show', $a) }}" class="text-body fw-medium">{{ $a->shortLabel() }}</a>
                                    @unless ($a->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                                </td>
                                <td class="money fw-semibold">{{ money($a->current_balance) }}</td>
                                <td class="text-end"><a href="{{ $mine ? route('my-accounts.show', $a) : route('accounts.show', $a) }}" class="btn btn-sm btn-light py-0"><i class="ri-file-list-3-line me-1"></i>Statement</a></td>
                            </tr>
                        @empty
                            <tr><td class="text-muted text-center py-3">No accounts.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
