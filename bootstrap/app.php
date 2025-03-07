<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
   //     commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       $middleware->api(append:[(\App\Http\Middleware\ApiKeyValidationMiddleware::class)]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontReport(\App\Exceptions\UnAuthorizedException::class)->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            if ($request->is('api/organization/*')) {
                return true;
            }
            return $request->expectsJson();
        });
    })->create();
