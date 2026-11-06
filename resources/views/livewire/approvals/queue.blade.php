<?php

/**
 * Admin approvals queue. Approving replays the staff action through the
 * owning service, so balances and statuses are re-checked at that moment.
 */

use App\Enums\ApprovalStatus;
use App\Exceptions\BusinessRuleException;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\ApprovalRequest;
use App\Services\ApprovalService;

use function Livewire\Volt\{computed, mount, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['status' => 'pending', 'notes' => []]);

$requests = computed(fn () => ApprovalRequest::with(['requester', 'reviewer', 'subject'])
    ->when($this->status !== 'all', fn ($q) => $q->where('status', $this->status))
    ->orderByRaw("status = 'pending' desc")->latest()
    ->paginate(20));

$updatedStatus = fn () => $this->resetPage();

mount(fn () => abort_unless(auth()->user()->isAdmin(), 403));

on(['transaction-updated' => function () {
    unset($this->requests);
}]);

$approve = function (int $id) {
    $request = ApprovalRequest::findOrFail($id);
    $ok = $this->attempt(fn () => app(ApprovalService::class)->approve($request, auth()->user(), $this->notes[$id] ?? null));

    if ($ok !== false) {
        $this->toast('success', 'Approved: '.$request->summary);
        $this->broadcastChange();
        $this->dispatch('approvals-updated');
    }
};

$reject = function (int $id) {
    $request = ApprovalRequest::findOrFail($id);
    $ok = $this->attempt(fn () => app(ApprovalService::class)->reject($request, auth()->user(), $this->notes[$id] ?? null));

    if ($ok !== false) {
        $this->toast('info', 'Rejected: '.$request->summary);
        $this->broadcastChange();
        $this->dispatch('approvals-updated');
    }
};

/** Human-readable view of the proposed values in a request payload. */
$describePayload = function (?array $payload): array {
    $labels = [
        'amount' => 'Amount', 'cheque_number' => 'Cheque #', 'issuing_bank' => 'Bank', 'cheque_date' => 'Cheque date',
        'received_date' => 'Received', 'clearing_method' => 'Method', 'cleared_date' => 'Cleared on',
        'commission_type' => 'Commission type', 'commission_rate' => 'Commission', 'bank_charges' => 'Bank charges',
        'closed_reason' => 'Reason', 'closed_date' => 'Date', 'date' => 'Date', 'reference' => 'Reference',
        'received_by' => 'Received by', 'item_description' => 'Items', 'notes' => 'Notes',
    ];
    $out = [];
    foreach ($payload ?? [] as $key => $value) {
        if (isset($labels[$key]) && filled($value) && ! is_array($value)) {
            $out[$labels[$key]] = in_array($key, ['amount', 'bank_charges'], true) ? money($value) : $value;
        }
    }
    if (! empty($payload['lines'])) {
        $out['Transfer lines'] = count($payload['lines']).' account(s)';
    }

    return $out;
};

?>

<div class="card">
    <div class="card-header d-flex align-items-center gap-2">
        <div class="btn-group btn-group-sm">
            @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'all' => 'All'] as $key => $label)
                <button type="button" class="btn {{ $status === $key ? 'btn-primary' : 'btn-light' }}" wire:click="$set('status', '{{ $key }}')">{{ $label }}</button>
            @endforeach
        </div>
    </div>
    <div class="list-group list-group-flush" wire:loading.class="ams-loading" wire:target="approve,reject,status">
        @forelse ($this->requests as $r)
            <div class="list-group-item py-3" wire:key="apr-{{ $r->id }}">
                <div class="d-flex flex-wrap gap-3 align-items-start">
                    <div class="flex-grow-1" style="min-width:280px">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge {{ $r->status->badge() }}">{{ $r->status->label() }}</span>
                            <span class="fw-semibold">{{ $r->action->label() }}</span>
                        </div>
                        <div class="mb-1">{{ $r->summary }}</div>
                        @php($details = $this->describePayload($r->payload))
                        @if ($details)
                            <div class="fs-12 text-muted">
                                @foreach ($details as $k => $v)<span class="me-3"><strong>{{ $k }}:</strong> {{ $v }}</span>@endforeach
                            </div>
                        @endif
                        <div class="fs-12 text-muted mt-1">
                            Requested by {{ $r->requester->name }} · {{ $r->created_at->format('d M Y H:i') }} ({{ $r->created_at->diffForHumans() }})
                            @if ($r->reviewed_at)
                                · {{ $r->status->label() }} by {{ $r->reviewer?->name }} {{ $r->reviewed_at->diffForHumans() }}
                                @if ($r->review_notes) — “{{ $r->review_notes }}” @endif
                            @endif
                        </div>
                    </div>

                    @if ($r->status === ApprovalStatus::Pending)
                        <div class="d-flex flex-column gap-2" style="min-width:260px">
                            <input type="text" class="form-control form-control-sm" placeholder="Note (optional)" wire:model="notes.{{ $r->id }}">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-success flex-grow-1" wire:click="approve({{ $r->id }})" wire:loading.attr="disabled">
                                    <i class="ri-check-line me-1"></i>Approve
                                </button>
                                <button type="button" class="btn btn-sm btn-light-danger flex-grow-1"
                                    x-on:click="amsConfirm('Reject this request?', 'Reject').then(ok => ok && $wire.reject({{ $r->id }}))">
                                    <i class="ri-close-line me-1"></i>Reject
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="list-group-item text-center text-muted py-5">
                <i class="ri-checkbox-multiple-line fs-32 d-block mb-2 opacity-50"></i>
                {{ $status === 'pending' ? 'Nothing waiting for approval.' : 'No requests.' }}
            </div>
        @endforelse
    </div>
    <div class="card-footer">{{ $this->requests->links() }}</div>
</div>
