<?php

/**
 * Mark a cheque as Bounced (pending or cleared) or Cancelled (pending only).
 * Open with:  $dispatch('cheque-close', { id: 12, action: 'bounce' | 'cancel' })
 */

use App\Enums\ChequeStatus;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Cheque;
use App\Services\ChequeService;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['chequeId' => null, 'action' => 'bounce'])->locked();
state(['closed_date' => '', 'closed_reason' => '']);

rules([
    'closed_date' => ['required', 'date', 'before_or_equal:today'],
    'closed_reason' => ['required', 'string', 'max:255'],
]);

$cheque = computed(fn () => $this->chequeId ? Cheque::with('company')->find($this->chequeId) : null);

on(['cheque-close' => function (int $id, string $action) {
    $this->resetErrorBag();
    $this->chequeId = $id;
    $this->action = in_array($action, ['bounce', 'cancel'], true) ? $action : 'bounce';
    $this->closed_date = now()->toDateString();
    $this->closed_reason = '';
    unset($this->cheque);
    $this->showModal('closeChequeModal');
}]);

$save = function () {
    $data = $this->validate();
    $cheque = Cheque::findOrFail($this->chequeId);
    $service = app(ChequeService::class);

    $ok = $this->attempt(function () use ($service, $cheque, $data) {
        $outcome = $this->action === 'cancel'
            ? $service->cancel($cheque, $data, auth()->user())
            : $service->bounce($cheque, $data, auth()->user());

        $this->toastOutcome($outcome, "Cheque #{$cheque->cheque_number} marked as ".($this->action === 'cancel' ? 'cancelled' : 'bounced').'.', 'The status change');
    }, 'closed_reason');

    if ($ok !== false) {
        $this->hideModal('closeChequeModal');
        $this->broadcastChange();
    }
};

?>

<div>
    <x-modal id="closeChequeModal" :title="$action === 'cancel' ? 'Cancel Cheque' : 'Mark Cheque as Bounced'" icon="ri-close-circle-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                @if ($c = $this->cheque)
                    <p class="mb-3">
                        Cheque <strong>#{{ $c->cheque_number }}</strong> for <strong>{{ $c->company->name }}</strong>,
                        amount <strong>{{ money($c->amount) }}</strong>.
                    </p>
                    @if ($action === 'bounce' && $c->status === ChequeStatus::Cleared)
                        <div class="alert alert-warning fs-13">
                            <i class="ri-error-warning-line me-1"></i>
                            This cheque was already cleared. Bouncing it reverses
                            <strong>{{ money($c->netToCompany()) }}</strong> from {{ $c->company->name }}'s payable and
                            <strong>{{ money($c->netToAccount()) }}</strong> from {{ $c->clearedInto?->name }}.
                            If that money was already paid out, record an <em>Overpaid → Receivable</em> adjustment first.
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('closed_date') is-invalid @enderror" wire:model="closed_date" max="{{ now()->toDateString() }}">
                        @error('closed_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="form-label">Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('closed_reason') is-invalid @enderror" rows="3" wire:model="closed_reason"
                            placeholder="{{ $action === 'cancel' ? 'e.g. Cheque returned to department for correction' : 'e.g. Returned unpaid — signature mismatch' }}"></textarea>
                        @error('closed_reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" wire:loading.attr="disabled" wire:target="save">
                    {{ auth()->user()->needsApproval() ? 'Submit for approval' : ($action === 'cancel' ? 'Cancel cheque' : 'Mark bounced') }}
                </button>
            </div>
        </form>
    </x-modal>
</div>
