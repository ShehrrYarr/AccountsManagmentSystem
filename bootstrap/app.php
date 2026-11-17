<?php

use App\Exceptions\BusinessRuleException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'active' => \App\Http\Middleware\EnsureUserIsActive::class,
            'api.active' => \App\Http\Middleware\EnsureApiUserIsActive::class,
            'idempotent' => \App\Http\Middleware\IdempotentRequest::class,
        ]);
        $middleware->redirectGuestsTo(fn (Request $request) => $request->is('api/*') ? null : route('login'));
        $middleware->redirectUsersTo(fn () => route('home'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // The mobile app's API always answers in JSON.
        $exceptions->shouldRenderJsonWhen(fn (Request $request) => $request->is('api/*') || $request->expectsJson());

        // An accounting rule that was broken (not enough money, overpaying, duplicate cheque...): 422 with the field.
        $exceptions->render(fn (BusinessRuleException $e, Request $request) => $request->is('api/*')
            ? response()->json(['message' => $e->getMessage(), 'errors' => [$e->field ?? 'general' => [$e->getMessage()]]], 422)
            : null);
    })->create();
