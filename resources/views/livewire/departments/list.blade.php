<?php

/**
 * Customers (government departments): balance across all my companies, plus create / edit.
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Department;
use App\Services\Balances;
use App\Support\Money;
use App\Support\Options;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['recordId' => null])->locked();
state(['search' => '', 'filter' => 'open', 'filterCompany' => null]);
state(['name' => '', 'code' => '', 'city' => '', 'contact_person' => '', 'phone' => '', 'notes' => '', 'is_active' => true]);

rules(fn () => [
    'name' => ['required', 'string', 'max:255', Rule::unique('departments', 'name')->ignore($this->recordId)],
    'code' => ['nullable', 'string', 'max:50'],
    'city' => ['nullable', 'string', 'max:255'],
    'contact_person' => ['nullable', 'string', 'max:255'],
    'phone' => ['nullable', 'string', 'max:30'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'is_active' => ['boolean'],
]);

$rows = computed(function () {
    $balances = Balances::departments(filled($this->filterCompany) ? (int) $this->filterCompany : null)->groupBy('department_id');
    return Department::query()
        ->when($this->search, fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', "%{$this->search}%")->orWhere('city', 'like', "%{$this->search}%")))
        ->when($this->filter !== 'inactive', fn ($q) => $q->where('is_active', true), fn ($q) => $q->where('is_active', false))
        ->orderBy('name')->get()
        ->map(function (Department $d) use ($balances) {
            $b = $balances->get($d->id, collect());

            return (object) [
                'department' => $d,
                'spent' => Money::add(...$b->pluck('spent')->all()),
                'received' => Money::add(...$b->pluck('received')->all()),
                'balance' => Money::add(...$b->pluck('balance')->all()),
            ];
        })
        ->when($this->filter === 'owe', fn ($c) => $c->filter(fn ($r) => Money::isPositive($r->balance)))
        ->when($this->filter === 'held', fn ($c) => $c->filter(fn ($r) => Money::isNegative($r->balance)))
        ->when($this->filter === 'open', fn ($c) => $c->reject(fn ($r) => Money::isZero($r->balance) && Money::isZero($r->spent)))
        ->values();
});

$totals = computed(function () {
    $all = Balances::departments(filled($this->filterCompany) ? (int) $this->filterCompany : null);

    return [
        'owe' => Money::add(...$all->filter(fn ($r) => Money::isPositive($r->balance))->pluck('balance')->all()),
        'held' => Money::sub(0, Money::add(...$all->filter(fn ($r) => Money::isNegative($r->balance))->pluck('balance')->all())),
    ];
});

$companyOptions = computed(fn () => [['value' => \App\Services\Balances::NONE, 'label' => 'No company (cash)'], ...Options::companies()]);

on(['transaction-updated' => function () {
    unset($this->rows, $this->totals);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->fill(['name' => '', 'code' => '', 'city' => '', 'contact_person' => '', 'phone' => '', 'notes' => '', 'is_active' => true]);
    $this->showModal('departmentModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $d = Department::findOrFail($id);
    $this->recordId = $d->id;
    $this->fill($d->only(['name', 'code', 'city', 'contact_person', 'phone', 'notes', 'is_active']));
    $this->showModal('departmentModal');
};

$save = function () {
    $data = $this->validate();
    $d = $this->recordId ? tap(Department::findOrFail($this->recordId))->update($data) : Department::create($data);
    $this->toast('success', "{$d->name} saved.");
    $this->hideModal('departmentModal');
    unset($this->rows);
};

$delete = function (int $id) {
    $d = Department::findOrFail($id);
    if ($d->ledgerEntries()->exists() || $d->cheques()->withTrashed()->exists() || $d->payments()->withTrashed()->exists()) {
        $d->update(['is_active' => false]);
        $this->toast('info', "{$d->name} has history, so it was deactivated instead of deleted.");
    } else {
        $d->delete();
        $this->toast('success', 'Department deleted.');
    }
    unset($this->rows);
};

?>

<div>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <x-stat-card label="Departments owe you" :value="money($this->totals['owe'])" icon="ri-arrow-left-down-line" color="danger" hint="Spent for them, cheque not received yet" />
        </div>
        <div class="col-md-6">
            <x-stat-card label="You hold for departments" :value="money($this->totals['held'])" icon="ri-safe-2-line" color="success" hint="Cheques received ahead of spending" />
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <input type="search" class="form-control form-control-sm" style="max-width:280px" placeholder="Search name, code, city…" aria-label="Search departments" wire:model.live.debounce.350ms="search">
            <div class="btn-group btn-group-sm" role="group">
                @foreach (['open' => 'With activity', 'owe' => 'Owe me', 'held' => 'I hold', 'all' => 'All active', 'inactive' => 'Inactive'] as $key => $label)
                    <button type="button" class="btn {{ $filter === $key ? 'btn-primary' : 'btn-light' }}" wire:click="$set('filter', '{{ $key }}')">{{ $label }}</button>
                @endforeach
            </div>
            <div style="min-width:180px"><x-searchable-select wire:model.live="filterCompany" :options="$this->companyOptions" placeholder="All companies" size="sm" /></div>
            <button type="button" class="btn btn-sm btn-primary ms-auto" wire:click="create"><i class="ri-add-line me-1"></i>New department</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <th>Department</th>
                            <th class="money d-none d-md-table-cell">Spent for them</th>
                            <th class="money d-none d-md-table-cell">Cheques received</th>
                            <th class="money">Balance</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $r)
                            <tr wire:key="dept-{{ $r->department->id }}">
                                <td>
                                    <a href="{{ route('departments.show', $r->department) }}" class="fw-semibold text-body">{{ $r->department->name }}</a>
                                    <div class="fs-12 text-muted">{{ collect([$r->department->code, $r->department->city])->filter()->implode(' · ') }}</div>
                                </td>
                                <td class="money d-none d-md-table-cell">{{ money($r->spent) }}</td>
                                <td class="money d-none d-md-table-cell">{{ money($r->received) }}</td>
                                <td class="money fw-semibold">
                                    @if (Money::isPositive($r->balance))
                                        <span class="text-danger">{{ money($r->balance) }}</span><div class="fs-11 text-muted">owes you</div>
                                    @elseif (Money::isNegative($r->balance))
                                        <span class="text-success">{{ money(Money::sub(0, $r->balance)) }}</span><div class="fs-11 text-muted">you hold</div>
                                    @else
                                        <span class="text-muted">settled</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('departments.show', $r->department) }}" class="btn btn-sm btn-light" title="Open ledger"><i class="ri-book-open-line"></i><span class="d-none d-xl-inline ms-1">Ledger</span></a>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $r->department->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete '.$r->department->name.'?'), 'Delete').then(ok => ok && $wire.delete({{ $r->department->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="5" icon="ri-government-line" message="No departments here." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal id="departmentModal" :title="$recordId ? 'Edit Department' : 'New Department'" icon="ri-government-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Department name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="e.g. District Health Office Lahore">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6"><label class="form-label">Code / DDO</label><input type="text" class="form-control" wire:model="code"></div>
                    <div class="col-sm-6"><label class="form-label">City</label><input type="text" class="form-control" wire:model="city"></div>
                    <div class="col-sm-6"><label class="form-label">Contact person</label><input type="text" class="form-control" wire:model="contact_person"></div>
                    <div class="col-sm-6"><label class="form-label">Phone</label><input type="text" class="form-control" wire:model="phone"></div>
                    <div class="col-12"><label class="form-label">Notes</label><textarea class="form-control" rows="2" wire:model="notes"></textarea></div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="dept-active" wire:model="is_active">
                            <label class="form-check-label" for="dept-active">Active (shown in dropdowns)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
