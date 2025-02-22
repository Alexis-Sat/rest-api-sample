<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UnAuthorizedException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message'=>'UnAuthorized'], 401);
    }
}
