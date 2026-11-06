<?php

/**
 * Audit trail: who created / changed / deleted what, with before & after values.
 */

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Str;

use function Livewire\Volt\{computed, mount, state, usesPagination};

usesPagination(theme: 'bootstrap');

mount(fn () => abort_unless(auth()->user()->isAdmin(), 403));

state(['type' => '', 'event' => '', 'user' => '', 'from' => '', 'to' => '', 'open' => null]);

$updated = fn () => $this->resetPage();

$logs = computed(fn () => AuditLog::with('user')
    ->when($this->type, fn ($q) => $q->where('auditable_type', $this->type))
    ->when($this->event, fn ($q) => $q->where('event', $this->event))
    ->when($this->user, fn ($q) => $q->where('user_id', $this->user))
    ->when($this->from, fn ($q) => $q->whereDate('created_at', '>=', $this->from))
    ->when($this->to, fn ($q) => $q->whereDate('created_at', '<=', $this->to))
    ->latest('created_at')->latest('id')
    ->paginate(30));

$types = computed(fn () => AuditLog::distinct()->orderBy('auditable_type')->pluck('auditable_type'));
$users = computed(fn () => User::orderBy('name')->get(['id', 'name']));

$toggle = fn (int $id) => $this->open = $this->open === $id ? null : $id;

?>

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center">
        <select class="form-select form-select-sm w-auto" wire:model.live="type">
            <option value="">All records</option>
            @foreach ($this->types as $t)
                <option value="{{ $t }}">{{ Str::headline($t) }}</option>
            @endforeach
        </select>
        <select class="form-select form-select-sm w-auto" wire:model.live="event">
            <option value="">All events</option>
            @foreach (['created', 'updated', 'deleted', 'restored'] as $e)
                <option value="{{ $e }}">{{ ucfirst($e) }}</option>
            @endforeach
        </select>
        <select class="form-select form-select-sm w-auto" wire:model.live="user">
            <option value="">All users</option>
            @foreach ($this->users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="from">
        <input type="date" class="form-control form-control-sm w-auto" wire:model.live="to">
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th>When</th><th>User</th><th>Event</th><th>Record</th><th>Changed fields</th><th></th></tr></thead>
                <tbody>
                    @forelse ($this->logs as $log)
                        @php($fields = array_keys(($log->new_values ?? []) + ($log->old_values ?? [])))
                        <tr wire:key="log-{{ $log->id }}">
                            <td class="fs-13 text-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="fs-13">{{ $log->user?->name ?? 'System' }}</td>
                            <td>
                                <span class="badge {{ match ($log->event) { 'created' => 'bg-success-subtle text-success', 'deleted' => 'bg-danger-subtle text-danger', default => 'bg-info-subtle text-info' } }}">{{ ucfirst($log->event) }}</span>
                            </td>
                            <td class="fs-13">{{ Str::headline($log->auditable_type) }} #{{ $log->auditable_id }}</td>
                            <td class="fs-12 text-muted" style="max-width:360px">{{ Str::limit(implode(', ', $fields), 120) }}</td>
                            <td class="text-end"><button class="btn btn-sm btn-light icon-btn-sm" wire:click="toggle({{ $log->id }})"><i class="{{ $open === $log->id ? 'ri-subtract-line' : 'ri-add-line' }}"></i></button></td>
                        </tr>
                        @if ($open === $log->id)
                            <tr wire:key="log-d-{{ $log->id }}" class="bg-body-tertiary">
                                <td colspan="6">
                                    <table class="table table-sm mb-0 fs-12">
                                        <thead><tr><th>Field</th><th>Before</th><th>After</th></tr></thead>
                                        <tbody>
                                            @foreach ($fields as $f)
                                                <tr>
                                                    <td class="fw-medium">{{ $f }}</td>
                                                    <td class="text-danger">{{ is_scalar($log->old_values[$f] ?? null) ? $log->old_values[$f] : json_encode($log->old_values[$f] ?? null) }}</td>
                                                    <td class="text-success">{{ is_scalar($log->new_values[$f] ?? null) ? $log->new_values[$f] : json_encode($log->new_values[$f] ?? null) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="fs-11 text-muted mt-1">IP {{ $log->ip_address ?? '—' }} · {{ Str::limit($log->user_agent, 90) }}</div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <x-empty-row :colspan="6" icon="ri-history-line" message="No audit entries." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $this->logs->links() }}</div>
</div>
