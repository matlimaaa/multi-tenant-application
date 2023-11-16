<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMasterDomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getHost() !== config('master-domain.master_domain')) {
            abort(401);
        }

        return $next($request);
    }
}
