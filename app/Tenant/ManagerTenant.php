<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ManagerTenant
{
    public function setConnection(Company $company): void
    {
        DB::purge('tenant');

        Log::info('connection changed from:' . json_encode(config('database.connections.tenant')));

        config()->set('database.connections.tenant.host', $company->bd_hostname);
        config()->set('database.connections.tenant.database', $company->bd_database);
        config()->set('database.connections.tenant.username', $company->bd_username);
        config()->set('database.connections.tenant.password', $company->bd_password);

        DB::reconnect('tenant');
        Schema::connection('tenant')->getConnection()->reconnect();

        Log::info('connection changed to:' . json_encode(config('database.connections.tenant')));
    }

    public function checksIfItIsTheMainDomain(): bool
    {
        return request()->getHost() === config('master-domain.master_domain');
    }
}