<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

use function Livewire\Volt\{mount, rules, state};

state(['token' => ''])->locked();
state(['email' => '', 'password' => '', 'password_confirmation' => '']);

mount(function (string $token) {
    $this->token = $token;
    $this->email = request()->string('email')->toString();
});

rules(fn () => [
    'email' => ['required', 'email'],
    'password' => ['required', 'confirmed', PasswordRule::defaults()],
]);

$resetPassword = function () {
    $this->validate();

    $status = Password::reset(
        ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
        function ($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();
            event(new PasswordReset($user));
        }
    );

    if ($status !== Password::PASSWORD_RESET) {
        $this->addError('email', __($status));

        return;
    }

    session()->flash('status', 'Your password has been reset. You can sign in now.');
    $this->redirectRoute('login');
};

?>

<div>
    <div class="mb-5 text-center">
        <h4 class="fw-normal">Choose a new password</h4>
    </div>

    <form class="form-custom mt-6" wire:submit="resetPassword">
        <div class="mb-4">
            <label class="form-label" for="rp-email">Email</label>
            <input type="email" wire:model="email" id="rp-email" class="form-control @error('email') is-invalid @enderror">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="form-label" for="rp-password">New password</label>
            <input type="password" wire:model="password" id="rp-password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-5">
            <label class="form-label" for="rp-password2">Confirm password</label>
            <input type="password" wire:model="password_confirmation" id="rp-password2" autocomplete="new-password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary rounded-2 w-100" wire:loading.attr="disabled">Reset Password</button>
    </form>
</div>
