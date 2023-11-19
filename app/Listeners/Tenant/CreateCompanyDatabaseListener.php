<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\CompnyCreatedEvent;
use App\Tenant\ManageTenantDatabase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCompanyDatabaseListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected ManageTenantDatabase $manageTenantDatabase)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompnyCreatedEvent $event): void
    {
        $this->manageTenantDatabase->createDatabase($event->company);
    }
}
