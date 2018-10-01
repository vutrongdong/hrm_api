<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Contracts\ContractRepository;
use App\Events\UpdateContractUserEvent;

class UpdateContractUserListener
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
    public function handle(UpdateContractUserEvent $event)
    {
        $this->contract->update($event->contracts['id'], $event->contracts);
        // $insertData = [];
        // foreach ($event->contracts as $key => $value) {
        //     $insertData[] = [
        //         'title' => $value['title'],
        //         'type' => $value['type'],
        //         'link' => array_get($event->contracts, $key.'.link', null),
        //         'date_sign' => $value['date_sign'],
        //         'date_effective' => $value['date_effective'],
        //         'date_expiration' => $value['date_expiration'],
        //         'status' => $value['status']
        //     ];
        //     $this->contract->update($event->contracts[$key]['id'], $insertData[$key]);
        // }
    }
}
