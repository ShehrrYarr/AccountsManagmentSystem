<?php

use App\Livewire\Concerns\InteractsWithUi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use function Livewire\Volt\{mount, state, uses};

uses([InteractsWithUi::class]);

state(['name' => '', 'email' => '', 'phone' => '', 'current_password' => '', 'password' => '', 'password_confirmation' => '']);

mount(function () {
    $this->fill(auth()->user()->only(['name', 'email', 'phone']));
});

$saveProfile = function () {
    $data = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
        'phone' => ['nullable', 'string', 'max:30'],
    ]);
    auth()->user()->update($data);
    $this->toast('success', 'Profile updated.');
};

$changePassword = function () {
    $this->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);
    auth()->user()->update(['password' => Hash::make($this->password)]);
    $this->reset(['current_password', 'password', 'password_confirmation']);
    $this->toast('success', 'Password changed.');
};

?>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header"><h5 class="card-title mb-0">Profile</h5></div>
            <form wire:submit="saveProfile">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input class="form-control" wire:model="phone">
                    </div>
                    <div class="fs-13 text-muted">Role: {{ auth()->user()->role->label() }}</div>
                </div>
                <div class="card-footer text-end"><button class="btn btn-primary" type="submit">Save profile</button></div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header"><h5 class="card-title mb-0">Change password</h5></div>
            <form wire:submit="changePassword">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Current password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" wire:model="current_password" autocomplete="current-password">
                        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" autocomplete="new-password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm new password</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
                <div class="card-footer text-end"><button class="btn btn-primary" type="submit">Change password</button></div>
            </form>
        </div>
    </div>
</div>
