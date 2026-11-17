<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Writes (POST / PUT / PATCH / DELETE) may carry an "Idempotency-Key" header (any unique string the
 * app makes, e.g. a UUID per queued entry). The first successful (2xx) response for a key is stored
 * and returned again, unchanged, for every repeat — with "Idempotent-Replayed: true" — so an
 * offline entry sent twice is saved once. A failed attempt (4xx / 5xx) is not stored: fix the entry
 * and send it again with the same key. While the first request is still running, a repeat gets 409.
 */
class IdempotentRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = trim((string) $request->header('Idempotency-Key'));
        $user = $request->user();

        if ($key === '' || ! $user || $request->isMethodSafe()) {
            return $next($request);
        }

        if (mb_strlen($key) > 100) {
            return response()->json(['message' => 'Idempotency-Key is too long (100 characters at most).'], 422);
        }

        $path = '/'.ltrim($request->path(), '/');

        try {
            $id = DB::table('api_idempotency_keys')->insertGetId([
                'user_id' => $user->id, 'key' => $key, 'method' => $request->method(), 'path' => mb_substr($path, 0, 255),
                'created_at' => now(), 'updated_at' => now(),
            ]);
        } catch (UniqueConstraintViolationException) {
            $seen = DB::table('api_idempotency_keys')->where('user_id', $user->id)->where('key', $key)->first();

            if ($seen && ($seen->method !== $request->method() || $seen->path !== mb_substr($path, 0, 255))) {
                return response()->json(['message' => 'This Idempotency-Key was already used for a different request.'], 422);
            }
            if (! $seen || $seen->status_code === null) {
                return response()->json(['message' => 'This entry is still being saved. Try again in a moment.'], 409);
            }

            return response($seen->response, $seen->status_code, ['Content-Type' => 'application/json', 'Idempotent-Replayed' => 'true']);
        }

        try {
            $response = $next($request);
        } catch (\Throwable $e) {
            DB::table('api_idempotency_keys')->where('id', $id)->delete();
            throw $e;
        }

        if ($response->isSuccessful()) {
            DB::table('api_idempotency_keys')->where('id', $id)->update([
                'status_code' => $response->getStatusCode(), 'response' => $response->getContent(), 'updated_at' => now(),
            ]);
        } else {
            DB::table('api_idempotency_keys')->where('id', $id)->delete(); // let the app fix it and retry with the same key
        }

        return $response;
    }
}
