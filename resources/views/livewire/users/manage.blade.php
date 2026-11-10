<?php

/**
 * User management (admin only). No public sign-up. For now every user is an administrator; staff roles come later.
 */

use App\Enums\UserRole;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use function Livewire\Volt\{computed, mount, rules, state, uses};

uses([InteractsWithUi::class]);

mount(fn () => abort_unless(auth()->user()->isAdmin(), 403));

state(['userId' => null])->locked();
state(['name' => '', 'email' => '', 'phone' => '', 'role' => 'admin', 'is_active' => true, 'password' => '', 'password_confirmation' => '']);

rules(fn () => [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId)],
    'phone' => ['nullable', 'string', 'max:30'],
    'role' => ['required', Rule::in([UserRole::Admin->value])],
    'is_active' => ['boolean'],
    'password' => [$this->userId ? 'nullable' : 'required', 'confirmed', Password::defaults()],
]);

$users = computed(fn () => User::orderBy('role')->orderBy('name')->get());

$create = function () {
    $this->resetErrorBag();
    $this->fill(['name' => '', 'email' => '', 'phone' => '', 'role' => 'admin', 'is_active' => true, 'password' => '', 'password_confirmation' => '']);
    $this->userId = null;
    $this->showModal('userModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $u = User::findOrFail($id);
    $this->userId = $u->id;
    $this->fill($u->only(['name', 'email', 'phone', 'is_active']) + ['role' => $u->role->value, 'password' => '', 'password_confirmation' => '']);
    $this->showModal('userModal');
};

$save = function () {
    $data = $this->validate();

    // Never let the last active administrator lock everyone out.
    if ($this->userId === auth()->id() && ($data['role'] !== 'admin' || ! $data['is_active'])) {
        $this->addError('role', 'You cannot demote or deactivate your own account.');

        return;
    }

    if (blank($data['password'])) {
        unset($data['password']);
    }
    unset($data['password_confirmation']);

    if ($this->userId) {
        $user = User::findOrFail($this->userId);
        $user->update($data);
    } else {
        $user = User::create($data);
        $user->forceFill(['email_verified_at' => now()])->save();
    }
    $this->toast('success', "{$user->name} saved.");
    $this->hideModal('userModal');
    unset($this->users);
};

$toggleActive = function (int $id) {
    abort_if($id === auth()->id(), 422, 'You cannot deactivate yourself.');
    $u = User::findOrFail($id);
    $u->update(['is_active' => ! $u->is_active]);
    $this->toast('success', $u->name.($u->is_active ? ' activated.' : ' deactivated and signed out.'));
    unset($this->users);
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 me-auto">Users</h5>
            <button type="button" class="btn btn-sm btn-primary" wire:click="create"><i class="ri-user-add-line me-1"></i>New User</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light"><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Last sign-in</th><th></th></tr></thead>
                    <tbody>
                        @foreach ($this->users as $u)
                            <tr wire:key="user-{{ $u->id }}">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="avatar avatar-sm rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-semibold">{{ $u->initials() }}</span>
                                        <div>{{ $u->name }} @if ($u->id === auth()->id())<span class="badge bg-light text-body">You</span>@endif
                                            @if ($u->phone)<div class="fs-12 text-muted">{{ $u->phone }}</div>@endif</div>
                                    </div>
                                </td>
                                <td class="fs-13">{{ $u->email }}</td>
                                <td><span class="badge {{ $u->isAdmin() ? 'bg-primary-subtle text-primary' : 'bg-info-subtle text-info' }}">{{ $u->role->label() }}</span></td>
                                <td><span class="badge {{ $u->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">{{ $u->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td class="fs-13">{{ $u->last_login_at?->diffForHumans() ?? 'Never' }}</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="edit({{ $u->id }})"><i class="ri-edit-line"></i></button>
                                    @if ($u->id !== auth()->id())
                                        <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="toggleActive({{ $u->id }})" title="{{ $u->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="{{ $u->is_active ? 'ri-user-unfollow-line text-danger' : 'ri-user-follow-line text-success' }}"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer fs-13 text-muted">
            Every user is an administrator with full access. Staff accounts with limited rights will be added later.
        </div>
    </div>

    <x-modal id="userModal" :title="$userId ? 'Edit User' : 'New User'" icon="ri-user-settings-line" size="md">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Full name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-7">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" autocomplete="off">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" wire:model="phone">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <div class="form-control bg-body-tertiary">Administrator</div>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="user-active" wire:model="is_active">
                            <label class="form-check-label" for="user-active">Active</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ $userId ? 'New password' : 'Password' }} @unless ($userId)<span class="text-danger">*</span>@endunless</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" autocomplete="new-password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm password</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" autocomplete="new-password">
                    </div>
                    @if ($userId)<div class="col-12 form-text mt-1">Leave the password blank to keep the current one.</div>@endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save user</button>
            </div>
        </form>
    </x-modal>
</div>
