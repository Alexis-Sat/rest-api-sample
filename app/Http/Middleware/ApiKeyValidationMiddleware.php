<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws \App\Exceptions\UnAuthorizedException
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->header('token') || $request->header('token') !==  config('app.api_key')) {
            throw new \App\Exceptions\UnAuthorizedException();
        }

        return $next($request);

    }
}
