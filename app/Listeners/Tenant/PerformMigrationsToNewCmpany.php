<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\CompnyCreatedEvent;
use App\Tenant\ManageTenantDatabase;
use Illuminate\Support\Facades\Artisan;

class PerformMigrationsToNewCmpany
{
    /**
     * Create the event listener.
     */
    public function __construct(protected ManageTenantDatabase $manageTenantDatabase)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CompnyCreatedEvent $event): void
    {
        Artisan::call('tenant-specific:migrate', [
            'id' => $event->company->id,
        ]);
    }
}
