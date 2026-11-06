<?php

use App\Models\ApprovalRequest;

use function Livewire\Volt\{computed, on};

// Admins see the whole queue; staff see their own requests that are still waiting.
$pending = computed(function () {
    $q = ApprovalRequest::pending()->with('requester')->latest();
    if (! auth()->user()->isAdmin()) {
        $q->where('requested_by', auth()->id());
    }

    return $q->limit(6)->get();
});

$count = computed(function () {
    $q = ApprovalRequest::pending();
    if (! auth()->user()->isAdmin()) {
        $q->where('requested_by', auth()->id());
    }

    return $q->count();
});

on(['transaction-updated' => fn () => null, 'approvals-updated' => fn () => null]);

?>

<div class="dropdown features-dropdown" wire:poll.60s>
    <button type="button" class="btn icon-btn btn-text-primary rounded-circle position-relative" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" title="Pending approvals">
        <i class="ri-notification-2-line fs-20"></i>
        @if ($this->count > 0)
            <span class="position-absolute translate-middle badge rounded-pill p-1 min-w-20px badge text-bg-danger" style="top:8px;left:30px">{{ $this->count }}</span>
        @endif
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
        <div class="dropdown-header d-flex align-items-center py-3">
            <h6 class="mb-0 me-auto">{{ auth()->user()->isAdmin() ? 'Awaiting your approval' : 'My pending requests' }}</h6>
            <span class="badge bg-warning-subtle text-warning">{{ $this->count }}</span>
        </div>
        <div class="list-group list-group-flush">
            @forelse ($this->pending as $req)
                <div class="list-group-item">
                    <div class="fs-13 fw-medium">{{ $req->action->label() }}</div>
                    <div class="fs-12 text-muted text-wrap">{{ $req->summary }}</div>
                    <div class="fs-11 text-muted mt-1">{{ $req->requester->name }} · {{ $req->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <div class="list-group-item text-muted fs-13 text-center py-4">Nothing pending.</div>
            @endforelse
        </div>
        @can('admin')
            <div class="p-2 border-top">
                <a href="{{ route('approvals.index') }}" class="btn btn-sm btn-primary w-100">Open approvals queue</a>
            </div>
        @endcan
    </div>
</div>
