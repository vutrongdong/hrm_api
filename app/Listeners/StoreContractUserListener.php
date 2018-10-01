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

        // $insertData = [];
        // foreach ($event->contracts as $key => $value) {
        //     $insertData[] = [
        //         'code' => array_get($event->contracts, $key.'.link', hashid_encode($event->user->id)),
        //         'user_id' => $event->user->id,
        //         'title' => $value['title'],
        //         'type' => $value['type'],
        //         'link' => array_get($event->contracts, $key.'.link', null),
        //         'date_sign' => $value['date_sign'],
        //         'date_effective' => $value['date_effective'],
        //         'date_expiration' => $value['date_expiration'],
        //         'status' => $value['status']
        //     ];
        // }
        // $this->contract->storeArray($insertData);
    }
}
