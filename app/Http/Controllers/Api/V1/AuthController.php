<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Sign in with the website's email + password. Each sign-in is a device (token) that stays signed
 * in until it logs out, the admin signs it out, or the user is deactivated.
 */
class AuthController extends ApiController
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string', 'max:100'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => 'These credentials do not match our records.']);
        }
        if (! $user->is_active) {
            throw ValidationException::withMessages(['email' => 'Your account has been deactivated.']);
        }
        if (! ($user->isAdmin() || $user->isAgent())) {
            throw ValidationException::withMessages(['email' => 'Your account has no access. Please ask an administrator.']);
        }

        $token = $user->createToken(trim($data['device_name']));
        $user->forceFill(['last_login_at' => now()])->saveQuietly();

        return response()->json([
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'device_id' => $token->accessToken->id,
            'user' => new UserResource($user),
        ], 201);
    }

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    /** Sign this device out. */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Signed out.']);
    }

    /** The signed-in user's devices. */
    public function devices(Request $request): JsonResponse
    {
        return response()->json(['data' => self::deviceList($request->user(), $request)]);
    }

    /** Sign one of your own devices out. */
    public function revokeDevice(Request $request, int $device): JsonResponse
    {
        $request->user()->tokens()->whereKey($device)->firstOrFail()->delete();

        return response()->json(['message' => 'Device signed out.']);
    }

    /** @return array<int, array<string, mixed>> */
    public static function deviceList(User $user, Request $request): array
    {
        $current = $request->user()?->currentAccessToken();

        return $user->tokens()->latest('last_used_at')->latest('id')->get()
            ->map(fn (PersonalAccessToken $t) => [
                'id' => $t->id,
                'name' => $t->name,
                'last_used_at' => $t->last_used_at?->toIso8601String(),
                'signed_in_at' => $t->created_at?->toIso8601String(),
                'current' => $current instanceof PersonalAccessToken && $current->id === $t->id,
            ])->values()->all();
    }
}
