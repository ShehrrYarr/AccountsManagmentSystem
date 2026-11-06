<?php

use Illuminate\Support\Facades\Password;

use function Livewire\Volt\{rules, state};

state(['email' => '', 'sent' => false]);

rules(['email' => ['required', 'string', 'email']]);

$sendLink = function () {
    $this->validate();

    // Always show the same message so the form does not reveal which emails exist.
    Password::sendResetLink(['email' => $this->email, 'is_active' => true]);
    $this->sent = true;
};

?>

<div>
    <div class="mb-5 text-center">
        <h4 class="fw-normal">Forgot your password?</h4>
        <p class="text-muted mb-0">Enter your email and we will send you a reset link.</p>
    </div>

    @if ($sent)
        <div class="alert alert-success">If an active account exists for that email, a reset link has been sent.</div>
    @endif

    <form class="form-custom mt-6" wire:submit="sendLink">
        <div class="mb-5">
            <label class="form-label" for="reset-email">Email<span class="text-danger ms-1">*</span></label>
            <input type="email" wire:model="email" id="reset-email" autofocus
                class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary rounded-2 w-100" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="sendLink">Send Reset Link</span>
            <span wire:loading wire:target="sendLink">Sending...</span>
        </button>

        <p class="mb-0 mt-5 text-muted text-center">
            <a href="{{ route('login') }}" class="text-primary fw-medium"><i class="ri-arrow-left-line me-1"></i>Back to sign in</a>
        </p>
    </form>
</div>
