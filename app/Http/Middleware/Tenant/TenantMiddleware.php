<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = $this->getCompanyByDomain($request->getHost());

        if (! $company) {
            return response()->view('errors.404-tenant', [], 404);
        }

        return $next($request);
    }

    private function getCompanyByDomain(string $domain): ?Company
    {
        return Company::where('domain', $domain)->first();
    }
}
