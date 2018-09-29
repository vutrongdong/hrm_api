<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\PlanDetails\PlanDetailRepository;
use App\Events\UpdatePlanDetailEvent;

class UpdatePlanDetailListener
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
    public function handle(UpdatePlanDetailEvent $event)
    {
        $insertData = [];
        foreach ($event->details as $key => $value) {
            $insertData[] = [
                'department_id' => $value['department_id'],
                'position_id' => $value['position_id'],
                'quantity' => $value['quantity']
            ];
            $this->planDetail->update($event->details[$key]['id'], $insertData[$key]);
        }
    }
}
