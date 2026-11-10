<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Signs out users who were deactivated, and (for now) anyone who is not an administrator:
 * staff accounts are not enabled yet.
 */
class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && (! $user->is_active || ! $user->isAdmin())) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', $user->is_active
                ? 'Staff accounts are not enabled yet. Please ask an administrator.'
                : 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
