<?php

/**
 * Admin: agents' requests to edit or delete cheques they received. Each pending request shows
 * the current and requested values; Approve applies it, Reject keeps the cheque as it is.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\ChequeChangeRequest;
use App\Models\Company;
use App\Models\Department;
use App\Services\ChequeApprovalService;
use App\Support\Money;

use function Livewire\Volt\{computed, on, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['rejectingId' => null, 'rejectNote' => '']);

$pending = computed(fn () => ChequeChangeRequest::pending()
    ->with(['cheque.company', 'cheque.department', 'cheque.depositAccount', 'requester'])
    ->oldest()->get());

$history = computed(fn () => ChequeChangeRequest::query()->where('status', '!=', ChequeChangeRequest::PENDING)
    ->with(['cheque', 'requester', 'decider'])
    ->latest('decided_at')->latest('id')->paginate(15, pageName: 'historyPage'));

// Names for the ids that requests mention.
$names = computed(function () {
    $ids = fn (string $f) => $this->pending->map(fn ($r) => [$r->changes[$f] ?? null, $r->cheque?->{$f}])->flatten()->filter()->unique();

    return [
        'company_id' => Company::withTrashed()->whereIn('id', $ids('company_id'))->pluck('name', 'id'),
        'department_id' => Department::whereIn('id', $ids('department_id'))->pluck('name', 'id'),
        'deposit_account_id' => Account::withTrashed()->whereIn('id', $ids('deposit_account_id'))->get()->mapWithKeys(fn ($a) => [$a->id => $a->label()]),
    ];
});

on(['approval-updated' => function () {
    unset($this->pending, $this->history);
}]);

$approve = function (int $id) {
    $request = ChequeChangeRequest::findOrFail($id);
    $ok = $this->attempt(fn () => app(ChequeApprovalService::class)->approve($request, auth()->user()));
    if ($ok !== false) {
        $this->toast('success', 'Approved: cheque #'.$request->cheque?->cheque_number.($request->isDelete() ? ' deleted.' : ' updated.'));
        unset($this->pending, $this->history);
        $this->broadcastChange();
        $this->dispatch('approval-updated');
    }
};

$startReject = function (int $id) {
    $this->fill(['rejectingId' => $id, 'rejectNote' => '']);
    $this->showModal('rejectModal');
};

$reject = function () {
    $this->validate(['rejectNote' => ['nullable', 'string', 'max:500']]);
    $request = ChequeChangeRequest::findOrFail($this->rejectingId);
    $ok = $this->attempt(fn () => app(ChequeApprovalService::class)->reject($request, auth()->user(), trim($this->rejectNote) ?: null));
    if ($ok !== false) {
        $this->toast('success', 'Rejected: cheque #'.$request->cheque?->cheque_number.' stays as it was.');
        $this->hideModal('rejectModal');
        $this->fill(['rejectingId' => null, 'rejectNote' => '']);
        unset($this->pending, $this->history);
        $this->dispatch('approval-updated');
    }
};

?>

@php
    $show = function (string $field, $value, $request = null) {
        if ($value === null || $value === '') {
            return '<span class="text-muted">—</span>';
        }

        return match ($field) {
            'company_id', 'department_id', 'deposit_account_id' => e($this->names[$field][$value] ?? '#'.$value),
            'amount', 'bank_charges' => e(money($value)),
            'cheque_date' => e(\Illuminate\Support\Carbon::parse($value)->format('d M Y')),
            'scan_path' => $request
                ? '<a href="'.e(route('files.show', ['cheque-request', $request->id])).'" target="_blank"><i class="ri-image-line"></i> New picture</a>'
                : '<i class="ri-image-line"></i> Current picture',
            default => e($value),
        };
    };
@endphp

<div>
    <div class="card">
        <div class="card-header d-flex align-items-center gap-2">
            <h5 class="card-title mb-0 me-auto">Waiting for you <span class="badge bg-warning-subtle text-warning ms-1">{{ $this->pending->count() }}</span></h5>
            <span class="fs-12 text-muted">Agents can't change saved cheques until you approve</span>
        </div>
        <div class="card-body">
            @forelse ($this->pending as $r)
                @php($c = $r->cheque)
                <div class="border rounded p-3 mb-3 {{ $r->isDelete() ? 'border-danger-subtle' : 'border-warning-subtle' }}" wire:key="req-{{ $r->id }}">
                    <div class="d-flex flex-wrap align-items-start gap-2 mb-2">
                        <div class="me-auto">
                            <span class="badge {{ $r->isDelete() ? 'bg-danger' : 'bg-warning text-dark' }} me-1">{{ $r->isDelete() ? 'Delete' : 'Edit' }}</span>
                            <strong>Cheque #{{ $c?->cheque_number }}</strong>
                            <span class="text-muted">· {{ $c?->department?->name }} · {{ $c?->company?->name }} · {{ $c ? money($c->amount) : '' }}</span>
                            <div class="fs-12 text-muted mt-1">
                                <i class="ri-user-line"></i> {{ $r->requester?->name }} · {{ $r->created_at->format('d M Y, h:i A') }} ({{ $r->created_at->diffForHumans() }})
                            </div>
                            @if ($r->reason)
                                <div class="fs-13 mt-1"><i class="ri-chat-3-line text-muted"></i> “{{ $r->reason }}”</div>
                            @endif
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-success" wire:loading.attr="disabled"
                                x-on:click="amsConfirm(@js($r->isDelete() ? 'Delete cheque #'.$c?->cheque_number.'? It will be removed from the bank and the department ledger.' : 'Apply these changes to cheque #'.$c?->cheque_number.'?'), 'Approve').then(ok => ok && $wire.approve({{ $r->id }}))">
                                <i class="ri-check-line me-1"></i>Approve
                            </button>
                            <button type="button" class="btn btn-sm btn-light-danger" wire:click="startReject({{ $r->id }})"><i class="ri-close-line me-1"></i>Reject</button>
                        </div>
                    </div>

                    @unless ($r->isDelete())
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0 fs-13">
                                <thead class="table-light"><tr><th style="width:30%">Field</th><th>Now</th><th>Requested</th></tr></thead>
                                <tbody>
                                    @foreach (ChequeChangeRequest::FIELDS as $field => $label)
                                        @continue(! array_key_exists($field, $r->changes ?? []))
                                        <tr>
                                            <td class="fw-medium">{{ $label }}</td>
                                            <td class="text-muted text-decoration-line-through">{!! $show($field, $field === 'scan_path' ? ($c?->scan_path ? 1 : null) : ($c ? ($field === 'cheque_date' ? $c->cheque_date?->toDateString() : $c->getRawOriginal($field)) : null)) !!}</td>
                                            <td class="fw-semibold text-success">{!! $show($field, $r->changes[$field], $field === 'scan_path' ? $r : null) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endunless
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="ri-checkbox-circle-line fs-32 d-block mb-2 opacity-50"></i>
                    Nothing waiting. Agents' edit and delete requests will appear here.
                </div>
            @endforelse
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Decided</h5></div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 fs-13">
                <thead class="table-light"><tr><th>Cheque</th><th>Request</th><th>Agent</th><th>Decision</th><th>Note</th></tr></thead>
                <tbody>
                    @forelse ($this->history as $r)
                        <tr wire:key="hist-{{ $r->id }}">
                            <td class="fw-medium">#{{ $r->cheque?->cheque_number }}</td>
                            <td>{{ $r->isDelete() ? 'Delete' : 'Edit ('.collect(array_keys($r->changes ?? []))->map(fn ($f) => ChequeChangeRequest::FIELDS[$f] ?? $f)->join(', ').')' }}</td>
                            <td>{{ $r->requester?->name }}<div class="fs-11 text-muted">{{ $r->created_at->format('d M Y') }}</div></td>
                            <td>
                                <span class="badge {{ $r->status === ChequeChangeRequest::APPROVED ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ ucfirst($r->status) }}</span>
                                <div class="fs-11 text-muted">{{ $r->decider?->name }} · {{ $r->decided_at?->format('d M Y') }}</div>
                            </td>
                            <td class="text-muted">{{ $r->decision_note ?: '—' }}</td>
                        </tr>
                    @empty
                        <x-empty-row :colspan="5" icon="ri-history-line" message="No decisions yet." />
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($this->history->hasPages())
            <div class="card-footer">{{ $this->history->onEachSide(1)->links() }}</div>
        @endif
    </div>

    <x-modal id="rejectModal" title="Reject request" icon="ri-close-circle-line" size="md">
        <form wire:submit="reject">
            <div class="modal-body">
                <p class="mb-2">The cheque stays as it is. The agent will see that the request was rejected.</p>
                <label class="form-label">Reason <span class="text-muted">(optional, shown to the agent)</span></label>
                <textarea class="form-control @error('rejectNote') is-invalid @enderror" rows="2" wire:model="rejectNote" maxlength="500"></textarea>
                @error('rejectNote') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" wire:loading.attr="disabled" wire:target="reject"><i class="ri-close-line me-1"></i>Reject</button>
            </div>
        </form>
    </x-modal>
</div>
