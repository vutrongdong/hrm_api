<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\PlanDetails\PlanDetail;

class PlanDetailTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'plan'
    ];

    public function transform(PlanDetail $planDetail = null)
    {
        if (is_null($planDetail)) {
            return [];
        }

        return [
            'id'                => $planDetail->id,
            'plan_id'           => $planDetail->plan_id,
            'plan_name'         => $planDetail->plan->title,
            'department_id'     => $planDetail->department_id,
            'department_name'   => $planDetail->department->name,
            'position_id'       => $planDetail->position_id,
            'position_name'     => $planDetail->position->name,
            'quantity'          => $planDetail->quantity,
        ];
    }

    public function includePlan(PlanDetail $planDetail = null)
    {
        if (is_null($planDetail)) {
            return $this->null();
        }

        return $this->item($planDetail->plan, new PlanTransformer);
    }  
}
