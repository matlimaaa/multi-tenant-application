<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompnyCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct(protected Company $company)
    {
    }

    public function store()
    {
        $company = $this->company->create([
            'name' => 'test',
            'domain' => 'test.local' . random_int(0, PHP_INT_MAX),
            'bd_database' => 'banco_' . random_int(0, PHP_INT_MAX),
            'bd_hostname' => 'mysql',
            'bd_username' => 'root',
            'bd_password' => 'root',
        ]);

        event(new CompnyCreatedEvent($company));
    }
}
