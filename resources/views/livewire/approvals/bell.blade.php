<?php

/**
 * Admin top-bar bell: how many agent requests wait for approval, with the latest few.
 * Refreshes every minute and whenever a request is sent or decided in this browser.
 */

use App\Models\ChequeChangeRequest;

use function Livewire\Volt\{computed, on};

$count = computed(fn () => ChequeChangeRequest::pending()->count());
$latest = computed(fn () => ChequeChangeRequest::pending()->with(['cheque', 'requester'])->latest()->limit(5)->get());

on(['approval-updated' => function () {
    unset($this->count, $this->latest);
}]);

?>

<div class="dropdown features-dropdown" wire:poll.60s>
    <button type="button" class="btn icon-btn btn-text-primary rounded-circle position-relative" data-bs-toggle="dropdown" aria-expanded="false" title="Approvals">
        <i class="ri-notification-3-line fs-18"></i>
        @if ($this->count)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:10px">{{ $this->count > 99 ? '99+' : $this->count }}</span>
        @endif
        <span class="visually-hidden">{{ $this->count }} requests waiting for approval</span>
    </button>
    <div class="dropdown-menu dropdown-menu-end p-0" style="min-width:300px">
        <div class="px-3 py-2 border-bottom fw-semibold">Approvals {{ $this->count ? '('.$this->count.')' : '' }}</div>
        @forelse ($this->latest as $r)
            <a class="dropdown-item py-2 border-bottom" href="{{ route('approvals.index') }}">
                <div class="fs-13"><strong>{{ $r->requester?->name }}</strong> asks to {{ $r->action }} cheque #{{ $r->cheque?->cheque_number }}</div>
                <div class="fs-11 text-muted">{{ $r->created_at->diffForHumans() }}</div>
            </a>
        @empty
            <div class="px-3 py-3 text-muted fs-13">Nothing waiting for approval.</div>
        @endforelse
        <a class="dropdown-item text-center fs-13 py-2 text-primary" href="{{ route('approvals.index') }}">Open Approvals</a>
    </div>
</div>
