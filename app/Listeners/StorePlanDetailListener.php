<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\PlanDetails\PlanDetailRepository;
use App\Events\StorePlanDetailEvent;

class StorePlanDetailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PlanDetailRepository $planDetailRepo)
    {
        $this->planDetail = $planDetailRepo;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(StorePlanDetailEvent $event)
    {
        $data = $event->details;
        $insertData = [];
        foreach ($data as $key => $value) {
            $insertData[] = [
                'plan_id' => $event->plan->id,
                'department_id' => $value['department_id'],
                'position_id' => $value['position_id'],
                'quantity' => $value['quantity']
            ];
        }
        $this->planDetail->storeArray($insertData);
    }
}
