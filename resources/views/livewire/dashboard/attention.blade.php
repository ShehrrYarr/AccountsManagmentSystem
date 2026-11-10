<?php

/**
 * "Needs attention": cheques in hand (closest to expiry first), ready to deposit.
 */

use App\Models\Cheque;

use function Livewire\Volt\{computed, on};

$cheques = computed(fn () => Cheque::inHand()->with(['company', 'department'])->orderBy('expiry_date')->limit(8)->get());

on(['transaction-updated' => function () {
    unset($this->cheques);
}]);

?>

<div class="card h-100">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title mb-0 me-auto">Cheques to deposit</h5>
        <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-light">All cheques <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="list-group list-group-flush">
        @forelse ($this->cheques as $c)
            <div class="list-group-item d-flex align-items-center gap-3" wire:key="att-{{ $c->id }}">
                <div class="flex-grow-1 overflow-hidden">
                    <div class="fw-medium text-truncate">{{ $c->department->name }}</div>
                    <div class="fs-12 text-muted text-truncate">#{{ $c->cheque_number }} · {{ $c->company->name }}</div>
                    <div class="fs-12 {{ $c->isExpired() ? 'text-danger' : ($c->isNearExpiry() ? 'text-warning' : 'text-muted') }}">
                        <i class="ri-time-line"></i>
                        {{ $c->isExpired() ? 'Expired '.$c->expiry_date->diffForHumans() : 'Valid until '.$c->expiry_date->format('d M Y') }}
                    </div>
                </div>
                <div class="text-end">
                    <div class="fw-semibold text-nowrap">{{ money($c->amount) }}</div>
                    <button type="button" class="btn btn-sm btn-success mt-1" wire:click="$dispatch('cheque-deposit', { id: {{ $c->id }} })">Deposit</button>
                </div>
            </div>
        @empty
            <div class="list-group-item text-center text-muted py-5">
                <i class="ri-checkbox-circle-line fs-32 d-block mb-2 opacity-50"></i>
                No cheques waiting — everything is deposited.
            </div>
        @endforelse
    </div>
</div>
