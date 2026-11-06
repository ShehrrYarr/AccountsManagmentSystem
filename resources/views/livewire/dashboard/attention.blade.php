<?php

/**
 * "Needs attention" list: oldest pending cheques, highlighting ones close to expiry.
 */

use App\Models\Cheque;

use function Livewire\Volt\{computed, on};

$cheques = computed(fn () => Cheque::pending()->with('company')->orderBy('expiry_date')->limit(8)->get());

on(['transaction-updated' => function () {
    unset($this->cheques);
}]);

?>

<div class="card h-100">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title mb-0 me-auto">Cheques waiting to clear</h5>
        <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-light">All cheques <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="list-group list-group-flush">
        @forelse ($this->cheques as $c)
            <div class="list-group-item d-flex align-items-center gap-3" wire:key="att-{{ $c->id }}">
                <div class="flex-grow-1 overflow-hidden">
                    <div class="fw-medium text-truncate">{{ $c->company->name }}</div>
                    <div class="fs-12 text-muted">#{{ $c->cheque_number }} · {{ $c->issuing_bank }}</div>
                    <div class="fs-12 {{ $c->isExpired() ? 'text-danger' : ($c->isNearExpiry() ? 'text-warning' : 'text-muted') }}">
                        <i class="ri-time-line"></i>
                        {{ $c->isExpired() ? 'Expired '.$c->expiry_date->diffForHumans() : 'Valid until '.$c->expiry_date->format('d M Y') }}
                    </div>
                </div>
                <div class="text-end">
                    <div class="fw-semibold">{{ money($c->amount) }}</div>
                    @unless ($c->pendingApproval())
                        <button type="button" class="btn btn-sm btn-success mt-1" wire:click="$dispatch('cheque-clear', { id: {{ $c->id }} })">Clear</button>
                    @else
                        <span class="badge bg-info-subtle text-info mt-1">Awaiting approval</span>
                    @endunless
                </div>
            </div>
        @empty
            <div class="list-group-item text-center text-muted py-5">
                <i class="ri-checkbox-circle-line fs-32 d-block mb-2 opacity-50"></i>
                Nothing pending — all cheques are cleared.
            </div>
        @endforelse
    </div>
</div>
