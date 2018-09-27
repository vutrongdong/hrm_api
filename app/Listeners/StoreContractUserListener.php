<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Contracts\ContractRepository;
use App\Events\StoreContractUserEvent;

class StoreContractUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ContractRepository $contractRepo)
    {
        $this->contract = $contractRepo;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(StoreContractUserEvent $event)
    {
        $event->contract['user_id'] = $event->user->id;
        $this->contract->store($event->contract);
    }
}
