<?php

/**
 * Generic list + modal CRUD for simple lookup tables.
 *
 *   <livewire:master.simple-crud entity="expense-categories" />
 */

use App\Livewire\Concerns\InteractsWithUi;
use App\Models\ExpenseCategory;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, mount, rules, state, uses, usesPagination};

uses([InteractsWithUi::class]);
usesPagination(theme: 'bootstrap');

state(['entity' => 'expense-categories', 'recordId' => null])->locked();
state(['search' => '', 'form' => []]);

$config = computed(fn () => match ($this->entity) {
    'expense-categories' => [
        'model' => ExpenseCategory::class,
        'singular' => 'Category',
        'icon' => 'ri-price-tag-3-line',
        'fields' => [
            'name' => ['label' => 'Category name', 'required' => true, 'col' => 12],
        ],
        'countRelation' => 'expenses',
        'countLabel' => 'Expenses',
    ],
    default => abort(404),
});

mount(function () {
    $this->config; // validates entity
});

rules(function () {
    $model = $this->config['model'];
    $table = (new $model)->getTable();
    $rules = ['form.is_active' => ['boolean']];
    foreach ($this->config['fields'] as $field => $meta) {
        $rules["form.$field"] = ($meta['required'] ?? false) ? ['required', 'string', 'max:255'] : ['nullable', 'string', 'max:1000'];
    }
    $rules['form.name'][] = Rule::unique($table, 'name')->ignore($this->recordId);

    return $rules;
});

$records = computed(function () {
    $model = $this->config['model'];

    return $model::query()
        ->withCount($this->config['countRelation'])
        ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
        ->orderBy('name')
        ->paginate(20);
});

$updatedSearch = fn () => $this->resetPage();

$create = function () {
    $this->resetErrorBag();
    $this->recordId = null;
    $this->form = array_fill_keys(array_keys($this->config['fields']), '') + ['is_active' => true];
    $this->showModal('simpleCrudModal-'.$this->entity);
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $record = $this->config['model']::findOrFail($id);
    $this->recordId = $record->id;
    $this->form = $record->only([...array_keys($this->config['fields']), 'is_active']);
    $this->showModal('simpleCrudModal-'.$this->entity);
};

$save = function () {
    $data = $this->validate()['form'];
    $model = $this->config['model'];
    $this->recordId ? $model::findOrFail($this->recordId)->update($data) : $model::create($data);
    $this->toast('success', $this->config['singular'].' saved.');
    $this->hideModal('simpleCrudModal-'.$this->entity);
    unset($this->records);
};

$delete = function (int $id) {
    $record = $this->config['model']::withCount($this->config['countRelation'])->findOrFail($id);
    $countKey = \Illuminate\Support\Str::snake($this->config['countRelation']).'_count';
    if ($record->{$countKey} > 0) {
        $record->update(['is_active' => false]);
        $this->toast('info', 'It is used on existing records, so it was deactivated instead of deleted.');
    } else {
        try {
            $record->delete();
            $this->toast('success', $this->config['singular'].' deleted.');
        } catch (\Illuminate\Database\QueryException) {
            // Still referenced by deleted (history) records.
            $record->update(['is_active' => false]);
            $this->toast('info', 'It is referenced by older records, so it was deactivated instead of deleted.');
        }
    }
    unset($this->records);
};

?>

<div>
    @php($cfg = $this->config)
    <div class="card">
        <div class="card-header d-flex align-items-center gap-2">
            <input type="search" class="form-control form-control-sm" style="max-width:300px" placeholder="Search…" wire:model.live.debounce.300ms="search">
            <button type="button" class="btn btn-sm btn-primary ms-auto" wire:click="create"><i class="ri-add-line me-1"></i>New {{ $cfg['singular'] }}</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            @foreach ($cfg['fields'] as $field => $meta)
                                @if ($field !== 'address')<th>{{ $meta['label'] }}</th>@endif
                            @endforeach
                            <th class="text-center">{{ $cfg['countLabel'] }}</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->records as $r)
                            <tr wire:key="sc-{{ $entity }}-{{ $r->id }}">
                                @foreach ($cfg['fields'] as $field => $meta)
                                    @if ($field !== 'address')
                                        <td class="{{ $field === 'name' ? 'fw-medium' : 'fs-13' }}">{{ $r->{$field} ?: '—' }}</td>
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $r->{\Illuminate\Support\Str::snake($cfg['countRelation']).'_count'} }}</td>
                                <td>
                                    <span class="badge {{ $r->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">{{ $r->is_active ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $r->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm"
                                        x-on:click="amsConfirm(@js('Delete '.$r->name.'?'), 'Delete').then(ok => ok && $wire.delete({{ $r->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="count($cfg['fields']) + 3" :icon="$cfg['icon']" message="Nothing here yet." />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $this->records->links() }}</div>
    </div>

    <x-modal :id="'simpleCrudModal-'.$entity" :title="($recordId ? 'Edit ' : 'New ').$cfg['singular']" :icon="$cfg['icon']" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    @foreach ($cfg['fields'] as $field => $meta)
                        <div class="col-md-{{ $meta['col'] }}">
                            <label class="form-label">{{ $meta['label'] }} @if ($meta['required'] ?? false)<span class="text-danger">*</span>@endif</label>
                            <input type="text" class="form-control @error('form.'.$field) is-invalid @enderror" wire:model="form.{{ $field }}">
                            @error('form.'.$field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="sc-active-{{ $entity }}" wire:model="form.is_active">
                            <label class="form-check-label" for="sc-active-{{ $entity }}">Active (shown in dropdowns)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </x-modal>
</div>
