<?php

use App\Http\Middleware\FirstStepsBusiness;
use App\Http\Middleware\FirstStepsSubscription;
use App\Http\Middleware\WithBusiness;
use App\Http\Middleware\WithSubscription;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/panel.php'));
            Route::middleware('web')
                ->group(base_path('routes/master.php'));
            Route::middleware('web')
                ->group(base_path('routes/webhook.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'with-business' => WithBusiness::class,
            'with-subscription' => WithSubscription::class,
            'first-steps-subscription' => FirstStepsSubscription::class,

        ]);
        $middleware->validateCsrfTokens(except: [
            'webhook/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
