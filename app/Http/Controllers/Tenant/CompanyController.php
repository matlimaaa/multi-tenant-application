<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompnyCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct(protected Company $company)
    {
    }

    public function index()
    {
        return response()->json([
            'companies' => CompanyResource::collection($this->company->all()),
        ]);
    }

    public function store(StoreUpdateCompanyRequest $request)
    {
        $company = $this->company->create([
            'name' => $request->name,
            'domain' => $request->domain,
            'bd_database' => $request->bd_database,
            'bd_hostname' => $request->bd_hostname,
            'bd_username' => $request->bd_username,
            'bd_password' => $request->bd_password,
        ]);

        event(new CompnyCreatedEvent($company));
    }

    public function show(string $domain)
    {
        $company = $this->company->where('domain', $domain)->firstOrFail();

        return response()->json(new CompanyResource($company));
    }

    public function update(StoreUpdateCompanyRequest $request, string $domain)
    {
        $company = $this->company->where('domain', $domain)->firstOrFail();

        $company->update([
            'name' => $request->name,
            'domain' => $request->domain,
            'bd_database' => $request->bd_database,
            'bd_hostname' => $request->bd_hostname,
            'bd_username' => $request->bd_username,
            'bd_password' => $request->bd_password,
        ]);

        return response()->json(['message' => 'updated']);
    }

    public function destroy(string $domain)
    {
        $company = $this->company->where('domain', $domain)->firstOrFail();

        $company->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
