<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleCheck
{

    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            return $this->apiResponse(null, 'Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
