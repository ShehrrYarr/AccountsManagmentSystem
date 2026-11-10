<?php

/**
 * Close a deal with a department for one company: the leftover balance becomes profit or loss.
 *
 * Open with: $dispatch('deal-close', { companyId: 1, departmentId: 4 })  or  $dispatch('deal-edit', { id: 7 })
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Company;
use App\Models\DealClosing;
use App\Models\Department;
use App\Services\Balances;
use App\Services\DealService;
use App\Support\Money;
use App\Support\Options;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['closingId' => null])->locked();
state(['company_id' => null, 'department_id' => null, 'date' => '', 'notes' => '']);

rules(fn () => [
    'company_id' => ['required', 'exists:companies,id'],
    'department_id' => ['required', 'exists:departments,id'],
    'date' => ['required', 'date', 'before_or_equal:today'],
    'notes' => ['nullable', 'string', 'max:2000'],
]);

$companyOptions = computed(fn () => Options::companies($this->company_id));
$departmentOptions = computed(fn () => Options::departments($this->department_id));

// Balance on the closing date, ignoring the closing being edited.
$balance = computed(function () {
    if (! $this->company_id || ! $this->department_id || ! $this->date || strtotime($this->date) === false) {
        return null;
    }
    $balance = Balances::departmentBalance((int) $this->department_id, (int) $this->company_id, $this->date);
    if ($this->closingId && ($old = DealClosing::find($this->closingId))
        && $old->company_id == $this->company_id && $old->department_id == $this->department_id && $old->date->toDateString() <= $this->date) {
        $balance = Money::sub($balance, $old->amount); // its posting moved the balance by +amount
    }

    return $balance;
});

on(['deal-close' => function (?int $companyId = null, ?int $departmentId = null) {
    $this->resetErrorBag();
    $this->closingId = null;
    $this->fill(['company_id' => $companyId, 'department_id' => $departmentId, 'date' => now()->toDateString(), 'notes' => '']);
    $this->showModal('dealCloseModal');
}]);

on(['deal-edit' => function (int $id) {
    $this->resetErrorBag();
    $c = DealClosing::findOrFail($id);
    $this->closingId = $c->id;
    $this->fill(['company_id' => $c->company_id, 'department_id' => $c->department_id, 'date' => $c->date->toDateString(), 'notes' => $c->notes ?? '']);
    $this->showModal('dealCloseModal');
}]);

$save = function () {
    $data = $this->validate();
    $ok = $this->attempt(function () use ($data) {
        $c = app(DealService::class)->close($this->closingId ? DealClosing::findOrFail($this->closingId) : null, $data);
        $this->toast('success', 'Deal closed with '.$c->department->name.': '.($c->isProfit() ? 'profit ' : 'loss ').money(Money::isNegative($c->amount) ? Money::sub(0, $c->amount) : $c->amount).'.');
    }, 'department_id');
    if ($ok !== false) {
        $this->hideModal('dealCloseModal');
        $this->broadcastChange();
    }
};

?>

<div>
    <x-modal id="dealCloseModal" :title="$closingId ? 'Edit Deal Closing' : 'Close Deal with Department'" icon="ri-flag-2-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <p class="fs-13 text-muted">Closing a deal books whatever is left between what you spent for the department and the cheques received as your profit (or loss), and brings the balance to zero.</p>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="company_id" :options="$this->companyOptions" placeholder="Select company" :invalid="$errors->has('company_id')" />
                        @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Department <span class="text-danger">*</span></label>
                        <x-searchable-select wire:model.live="department_id" :options="$this->departmentOptions" placeholder="Select department" :invalid="$errors->has('department_id')" />
                        @error('department_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Closing date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model.live="date" max="{{ now()->toDateString() }}">
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes" placeholder="e.g. Furniture supply order 2026-11 complete"></textarea>
                    </div>
                </div>

                @if ($this->balance !== null)
                    @php($b = $this->balance)
                    <div class="mt-3 p-3 rounded {{ Money::isZero($b) ? 'bg-body-tertiary' : (Money::isNegative($b) ? 'bg-success-subtle' : 'bg-danger-subtle') }}">
                        @if (Money::isZero($b))
                            <div class="fw-medium">Balance on that date is zero — nothing to close.</div>
                        @elseif (Money::isNegative($b))
                            <div class="fs-13">Cheques received exceeded what you spent by</div>
                            <div class="fs-4 fw-semibold text-success">{{ money(Money::sub(0, $b)) }} profit</div>
                        @else
                            <div class="fs-13">You spent more than the cheques received by</div>
                            <div class="fs-4 fw-semibold text-danger">{{ money($b) }} loss</div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save" @disabled($this->balance !== null && Money::isZero($this->balance))>
                    <i class="ri-flag-2-line me-1"></i>{{ $closingId ? 'Save closing' : 'Close deal' }}
                </button>
            </div>
        </form>
    </x-modal>
</div>
