<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web(SetLocale::class);
        $middleware->web(append: [
            SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


    $app->withMiddleware(function (Middleware $middleware) {
        // Global middleware
        $middleware->append(\App\Http\Middleware\TrustProxies::class);
        $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
        $middleware->append(\App\Http\Middleware\PreventRequestsDuringMaintenance::class);
        $middleware->append(\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class);
        $middleware->append(\App\Http\Middleware\TrimStrings::class);
        $middleware->append(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);
    });
    
    $app->withRouting(function (Route $route) {
        $route->middleware([
            'web' => [
                \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \App\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                \App\Http\Middleware\SetLocale::class, // Tambahkan SetLocale middleware di sini
            ],
            'api' => [
                \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
        ]);
    
        $route->aliasMiddleware([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            'signed' => \App\Http\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'locale' => \App\Http\Middleware\SetLocale::class, // Alias untuk middleware SetLocale
            'admin' => AdminMiddleware::class, // Gunakan class yang sudah di-import
        ]);
    });