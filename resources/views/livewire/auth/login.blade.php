<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\{rules, state};

state(['email' => '', 'password' => '', 'remember' => false, 'showPassword' => false]);

rules([
    'email' => ['required', 'string', 'email'],
    'password' => ['required', 'string'],
]);

$login = function () {
    $this->validate();

    $key = Str::transliterate(Str::lower($this->email).'|'.request()->ip());

    if (RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);
        throw ValidationException::withMessages([
            'email' => "Too many login attempts. Try again in {$seconds} seconds.",
        ]);
    }

    if (! Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => true], $this->remember)) {
        RateLimiter::hit($key);
        throw ValidationException::withMessages([
            'email' => 'These credentials do not match an active account.',
        ]);
    }

    RateLimiter::clear($key);
    session()->regenerate();
    Auth::user()->forceFill(['last_login_at' => now()])->saveQuietly();

    $this->redirectIntended(route('home'));
};

?>

<div>
    <div class="mb-5 text-center">
        <h4 class="fw-normal">Welcome to <span class="fw-bold text-primary">{{ config('app.name') }}</span></h4>
        <p class="text-muted mb-0">Sign in with the account your administrator created for you.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form class="form-custom mt-6" wire:submit="login">
        <div class="mb-5">
            <label class="form-label" for="login-email">Email<span class="text-danger ms-1">*</span></label>
            <input type="email" wire:model="email" id="login-email" autocomplete="username" autofocus
                class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-5">
            <label class="form-label" for="login-password">Password<span class="text-danger ms-1">*</span></label>
            <div class="input-group has-validation">
                <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model="password" id="login-password" autocomplete="current-password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                <button type="button" class="input-group-text bg-transparent" wire:click="$toggle('showPassword')" aria-label="Show password">
                    <i class="{{ $showPassword ? 'ri-eye-line' : 'ri-eye-off-line' }} text-muted"></i>
                </button>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-6">
                <div class="form-check form-check-sm d-flex align-items-center gap-2 mb-0">
                    <input class="form-check-input" type="checkbox" wire:model="remember" id="remember-me">
                    <label class="form-check-label" for="remember-me">Remember me</label>
                </div>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('password.request') }}" class="fs-14 text-muted">Forgot your password?</a>
            </div>
        </div>

        <button type="submit" class="btn btn-primary rounded-2 w-100" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="login">Sign In</span>
            <span wire:loading wire:target="login"><i class="ri-loader-2-fill me-1"></i>Please wait...</span>
        </button>
    </form>
</div>
