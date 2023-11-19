<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class ManageTenantDatabase
{
    public function createDatabase(Company $company)
    {
        DB::statement(
            "CREATE DATABASE {$company->bd_database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
        );
    }
}