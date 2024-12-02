<?php

namespace Italofantone\ApiTokenValidator\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Italofantone\ApiTokenValidator\Services\ApiTokenValidator;

class EnsureApiTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $token = $request->bearerToken();

        if (!(new ApiTokenValidator())->validate($token)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}