<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\StoreContractUserEvent::class => [
            \App\Listeners\StoreContractUserListener::class,
        ], 
        \App\Events\UpdateContractUserEvent::class => [
            \App\Listeners\UpdateContractUserListener::class,
        ],
        \App\Events\StoreOrUpdateDepartmentUserEvent::class => [
            \App\Listeners\StoreOrUpdateDepartmentUserListener::class,
        ], 
        \App\Events\StorePlanDetailEvent::class => [
            \App\Listeners\StorePlanDetailListener::class,
        ], 
        \App\Events\StoreOrUpdateInterviewEvent::class => [
            \App\Listeners\StoreOrUpdateInterviewListener::class,
        ], 
    ];
}
