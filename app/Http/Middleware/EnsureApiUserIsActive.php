<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * API: a deactivated user (or one with no AMS role) loses the token they used and gets 401.
 * (Deactivating a user already revokes all their tokens; this also covers older ones.)
 */
class EnsureApiUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && (! $user->is_active || ! ($user->isAdmin() || $user->isAgent()))) {
            $user->currentAccessToken()?->delete();

            return response()->json(['message' => $user->is_active
                ? 'Your account has no access. Please ask an administrator.'
                : 'Your account has been deactivated.'], 401);
        }

        return $next($request);
    }
}
