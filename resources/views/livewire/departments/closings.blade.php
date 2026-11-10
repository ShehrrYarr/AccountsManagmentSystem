<?php

/**
 * Closed deals (profit / loss) for a department or company, with edit and delete.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\DealClosing;
use App\Services\DealService;
use App\Support\Money;

use function Livewire\Volt\{computed, on, state, uses};

uses([InteractsWithUi::class]);

state(['companyId' => null, 'departmentId' => null])->locked();

$rows = computed(fn () => DealClosing::with(['company', 'department'])
    ->when($this->companyId, fn ($q, $id) => $q->where('company_id', $id))
    ->when($this->departmentId, fn ($q, $id) => $q->where('department_id', $id))
    ->orderByDesc('date')->orderByDesc('id')->get());

on(['transaction-updated' => function () {
    unset($this->rows);
}]);

$delete = function (int $id) {
    if ($this->attempt(fn () => app(DealService::class)->deleteClosing(DealClosing::findOrFail($id))) !== false) {
        $this->toast('success', 'Closing removed — the department balance is open again.');
        $this->broadcastChange();
    }
};

?>

<div class="card">
    <div class="card-header"><h5 class="card-title mb-0">Closed deals</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 ams-table">
                <thead class="table-light"><tr><th>Date</th><th>{{ $departmentId ? 'Company' : 'Department' }}</th><th class="money">Result</th><th></th></tr></thead>
                <tbody>
                    @forelse ($this->rows as $c)
                        <tr wire:key="close-{{ $c->id }}">
                            <td class="fs-13 text-nowrap">{{ $c->date->format('d M Y') }}</td>
                            <td>
                                {{ $departmentId ? $c->company->name : $c->department->name }}
                                @if ($c->notes)<div class="fs-12 text-muted">{{ $c->notes }}</div>@endif
                            </td>
                            <td class="money fw-semibold {{ $c->isProfit() ? 'text-success' : 'text-danger' }}">
                                {{ $c->isProfit() ? 'Profit' : 'Loss' }} {{ money(Money::isNegative($c->amount) ? Money::sub(0, $c->amount) : $c->amount) }}
                            </td>
                            <td class="text-end text-nowrap">
                                <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="$dispatch('deal-edit', { id: {{ $c->id }} })"><i class="ri-edit-line"></i></button>
                                <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                    x-on:click="amsConfirm('Remove this closing? The balance will be open again.', 'Remove').then(ok => ok && $wire.delete({{ $c->id }}))"><i class="ri-delete-bin-line"></i></button>
                            </td>
                        </tr>
                    @empty
                        <x-empty-row :colspan="4" icon="ri-flag-2-line" message="No deals closed yet." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
