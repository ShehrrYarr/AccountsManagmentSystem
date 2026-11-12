<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Signs out users who were deactivated or who have no role in AMS (only administrators and
 * agents may sign in).
 */
class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && (! $user->is_active || ! ($user->isAdmin() || $user->isAgent()))) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', $user->is_active
                ? 'Your account has no access. Please ask an administrator.'
                : 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
