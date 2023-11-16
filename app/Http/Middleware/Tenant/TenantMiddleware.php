<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
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
        $managerTenant = app(ManagerTenant::class);

        $company = $this->getCompanyByDomain($request->getHost());

        if (! $company && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        } else if (
            $request->url() != route('404.tenant') &&
            ! $managerTenant->checksIfItIsTheMainDomain()
        ) {
            $managerTenant->setConnection($company);
        }

        return $next($request);
    }

    private function getCompanyByDomain(string $domain): ?Company
    {
        return Company::where('domain', $domain)->first();
    }
}
