<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\CompnyCreatedEvent;
use App\Tenant\ManageTenantDatabase;
use Exception;

class CreateCompanyDatabaseListener
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
        try {
            $this->manageTenantDatabase->createDatabase($event->company);
        } catch (Exception $e) {
            report($e);

            throw $e;
        }
    }
}
