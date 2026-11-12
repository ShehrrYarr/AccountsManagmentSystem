<?php

/**
 * Latest government cheques deposited.
 */

use App\Models\Cheque;

use function Livewire\Volt\{computed, on};

$cheques = computed(fn () => Cheque::with(['company', 'department', 'depositAccount'])->latest('date')->latest('id')->limit(8)->get());

on(['transaction-updated' => function () {
    unset($this->cheques);
}]);

?>

<div class="card h-100">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title mb-0 me-auto">Latest cheques</h5>
        <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-light">All cheques <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="list-group list-group-flush">
        @forelse ($this->cheques as $c)
            <div class="list-group-item d-flex align-items-center gap-3" wire:key="att-{{ $c->id }}">
                <div class="flex-grow-1 overflow-hidden">
                    <div class="fw-medium text-truncate">{{ $c->department->name }}</div>
                    <div class="fs-12 text-muted text-truncate">#{{ $c->cheque_number }} · {{ $c->company->name }}</div>
                    <div class="fs-12 text-muted text-truncate"><i class="ri-bank-line"></i> {{ $c->depositAccount?->shortLabel() }} · {{ $c->date->format('d M Y') }}</div>
                </div>
                <div class="fw-semibold text-nowrap">{{ money($c->amount) }}</div>
            </div>
        @empty
            <div class="list-group-item text-center text-muted py-5">
                <i class="ri-bank-card-line fs-32 d-block mb-2 opacity-50"></i>
                No cheques yet.
            </div>
        @endforelse
    </div>
</div>
