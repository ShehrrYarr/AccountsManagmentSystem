<?php

/**
 * Users & agents (admin only). No public sign-up.
 *   Administrator: full access.
 *   Agent: works on the admin's behalf; enters govt cheques (sees only their own), keeps their
 *          own cash in hand (created automatically) and bank accounts.
 */

use App\Enums\UserRole;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\User;
use App\Services\MasterDataService;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use function Livewire\Volt\{computed, mount, rules, state, uses};

uses([InteractsWithUi::class]);

mount(fn () => abort_unless(auth()->user()->isAdmin(), 403));

state(['userId' => null, 'devicesFor' => null])->locked();
state(['name' => '', 'email' => '', 'phone' => '', 'role' => 'admin', 'is_active' => true, 'password' => '', 'password_confirmation' => '']);

rules(fn () => [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId)],
    'phone' => ['nullable', 'string', 'max:30'],
    'role' => ['required', Rule::in([UserRole::Admin->value, UserRole::Agent->value])],
    'is_active' => ['boolean'],
    'password' => [$this->userId ? 'nullable' : 'required', 'confirmed', Password::defaults()],
]);

$users = computed(fn () => User::query()->whereIn('role', [UserRole::Admin, UserRole::Agent])
    ->withCount(['cheques', 'agentAccounts', 'tokens'])->orderBy('role')->orderBy('name')->get());

// The mobile app devices a user is signed in on.
$devices = computed(fn () => $this->devicesFor ? User::find($this->devicesFor)?->tokens()->latest('last_used_at')->latest('id')->get() ?? collect() : collect());

$showDevices = function (int $id) {
    $this->devicesFor = $id;
    unset($this->devices);
    $this->showModal('devicesModal');
};

$signOutDevice = function (int $tokenId) {
    $user = User::findOrFail($this->devicesFor);
    $user->tokens()->whereKey($tokenId)->delete();
    unset($this->devices, $this->users);
    $this->toast('success', 'Device signed out of the app.');
};

$signOutAll = function () {
    $user = User::findOrFail($this->devicesFor);
    $user->tokens()->delete();
    unset($this->devices, $this->users);
    $this->toast('success', $user->name.' is signed out of the app on every device.');
};

$create = function (string $role = 'agent') {
    $this->resetErrorBag();
    $this->fill(['name' => '', 'email' => '', 'phone' => '', 'role' => $role === 'admin' ? 'admin' : 'agent', 'is_active' => true, 'password' => '', 'password_confirmation' => '']);
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

    // Nobody can demote or deactivate themselves; every agent gets a cash in hand.
    $user = $this->attempt(fn () => app(\App\Services\DirectoryService::class)->saveUser($this->userId ? User::findOrFail($this->userId) : null, $data, auth()->user()));
    if ($user === false) {
        return;
    }

    $this->toast('success', "{$user->name} saved.");
    $this->hideModal('userModal');
    unset($this->users);
};

$toggleActive = function (int $id) {
    abort_if($id === auth()->id(), 422, 'You cannot deactivate yourself.');
    $u = User::findOrFail($id);
    app(\App\Services\DirectoryService::class)->setActive($u, ! $u->is_active, auth()->user());
    $this->toast('success', $u->name.($u->is_active ? ' activated.' : ' deactivated and signed out.'));
    unset($this->users);
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 me-auto">Users &amp; Agents</h5>
            <button type="button" class="btn btn-sm btn-light" wire:click="create('admin')"><i class="ri-shield-user-line me-1"></i>New Administrator</button>
            <button type="button" class="btn btn-sm btn-primary ms-2" wire:click="create('agent')"><i class="ri-user-add-line me-1"></i>New Agent</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light"><tr><th>Name</th><th>Email</th><th>Role</th><th class="d-none d-md-table-cell">Cheques received</th><th>Status</th><th class="d-none d-md-table-cell">Last sign-in</th><th class="d-none d-md-table-cell">App devices</th><th></th></tr></thead>
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
                                <td>
                                    <span class="badge {{ $u->isAdmin() ? 'bg-primary-subtle text-primary' : 'bg-info-subtle text-info' }}">{{ $u->role->label() }}</span>
                                    @if ($u->isAgent())
                                        <div class="fs-11 text-muted">{{ $u->agent_accounts_count }} {{ \Illuminate\Support\Str::plural('account', $u->agent_accounts_count) }}</div>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell fs-13">{{ $u->cheques_count }}</td>
                                <td><span class="badge {{ $u->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">{{ $u->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td class="d-none d-md-table-cell fs-13">{{ $u->last_login_at?->diffForHumans() ?? 'Never' }}</td>
                                <td class="d-none d-md-table-cell fs-13">
                                    @if ($u->tokens_count)
                                        <a href="#" wire:click.prevent="showDevices({{ $u->id }})"><i class="ri-smartphone-line me-1"></i>{{ $u->tokens_count }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    @if ($u->isAgent())
                                        <a class="btn btn-sm btn-light icon-btn-sm" href="{{ route('accounts.index') }}#agent-{{ $u->id }}" title="Cash & bank accounts"><i class="ri-wallet-3-line"></i></a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" wire:click="showDevices({{ $u->id }})" title="App devices"><i class="ri-smartphone-line"></i></button>
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
            Administrators have full access. Agents enter govt cheques and department payments (and see only their own), keep their own cash in hand and bank accounts, and send money back; their edits and deletes need your approval. Deactivating someone also signs them out of the mobile app.
        </div>
    </div>

    <x-modal id="devicesModal" title="Mobile app devices" icon="ri-smartphone-line" size="md">
        <div class="modal-body">
            @php($who = $devicesFor ? $this->users->firstWhere('id', $devicesFor) : null)
            <p class="fs-13 text-muted mb-2">Phones where <strong class="text-body">{{ $who?->name }}</strong> is signed in to the AMS app. Sign out a lost or old phone here.</p>
            <ul class="list-group">
                @forelse ($this->devices as $d)
                    <li class="list-group-item d-flex align-items-center gap-2" wire:key="dev-{{ $d->id }}">
                        <i class="ri-smartphone-line fs-20 text-primary"></i>
                        <div class="me-auto">
                            <div class="fw-medium">{{ $d->name }}</div>
                            <div class="fs-12 text-muted">Signed in {{ $d->created_at?->format('d M Y') }} · last used {{ $d->last_used_at?->diffForHumans() ?? 'never' }}</div>
                        </div>
                        <button type="button" class="btn btn-sm btn-light-danger" x-on:click="amsConfirm(@js('Sign '.$d->name.' out of the app?'), 'Sign out').then(ok => ok && $wire.signOutDevice({{ $d->id }}))"><i class="ri-logout-box-r-line me-1"></i>Sign out</button>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Not signed in to the app on any device.</li>
                @endforelse
            </ul>
        </div>
        <div class="modal-footer">
            @if ($this->devices->count() > 1)
                <button type="button" class="btn btn-light-danger me-auto" x-on:click="amsConfirm('Sign out of the app on every device?', 'Sign out all').then(ok => ok && $wire.signOutAll())">Sign out all</button>
            @endif
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        </div>
    </x-modal>

    <x-modal id="userModal" :title="($userId ? 'Edit ' : 'New ').($role === 'agent' ? 'Agent' : 'Administrator')" icon="ri-user-settings-line" size="md">
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
                        <select class="form-select @error('role') is-invalid @enderror" wire:model.live="role" @disabled($userId === auth()->id())>
                            <option value="agent">Agent</option>
                            <option value="admin">Administrator</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    @if ($role === 'agent' && ! $userId)<div class="col-12 form-text mt-1"><i class="ri-wallet-3-line"></i> A cash in hand is created for the agent. Add their bank accounts on the Cash &amp; Bank page.</div>@endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save {{ $role === 'agent' ? 'agent' : 'administrator' }}</button>
            </div>
        </form>
    </x-modal>
</div>
