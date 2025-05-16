<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php', // Add this line to load API routes
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: 'api' // Add this line to prefix API routes with '/api'
    )
    ->withMiddleware(function (Middleware $middleware) {
        // You can add API-specific middleware here if needed in the future,
        // for example, Sanctum's EnsureFrontendRequestsAreStateful for SPA cookie auth
        // $middleware->group('api', [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();