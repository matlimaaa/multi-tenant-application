<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class TenantMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrations {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for all Tenants';

    public function __construct(protected ManagerTenant $managerTenant)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $companies = Company::all();

        foreach ($companies as $company) {
            $message = 'Starting run migrations for ' . $company->name;

            $this->info($message);
            Log::info($message);

            $this->managerTenant->setConnection($company);

            Artisan::call($command, [
                '--force' => true,
                '--path' => '/database/migrations/tenant',
            ]);

            $endMessage = 'End running migrations for ' . $company->name;
            Log::info($endMessage);
            $this->info($endMessage);
            Log::info('______________________________________________');
        }
    }
}
