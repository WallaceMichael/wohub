<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * This middleware will be run on every request.
     *
     * @var array<int, class-string>
     */
    protected $middleware = [
        // Global middleware
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Pipeline\Pipeline::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Http\Middleware\SetCacheHeaders::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'session.token' => \App\Http\Middleware\EnsureSessionWithToken::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * These middleware may be assigned to groups of routes.
     *
     * @var array<string, array<int, class-string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Middleware that applies to all routes in the 'web' group
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'sessionToken' => \App\Http\Middleware\EnsureSessionWithToken::class,
        ],

        'api' => [
            // Middleware that applies to all routes in the 'api' group
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware can be assigned to specific routes.
     *
     * @var array<string, class-string>
     */
    protected $routeMiddleware = [
        // Define custom route-specific middleware
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    /**
     * The application's console middleware.
     *
     * These middleware will be run on the console commands.
     *
     * @var array<int, class-string>
     */
    protected $middlewarePriority = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    ];
}
