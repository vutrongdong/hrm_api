<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Plan_details\Plan_detail;

class Plan_detailTransformer extends TransformerAbstract
{
    // protected $availableIncludes = [
    //     'departments', 'positions'
    // ];

    public function transform(Plan_detail $plan_detail = null)
    {
        if (is_null($plan_detail)) {
            return [];
        }

        return [
            'id'            => $plan_detail->id,
            'plan_id'       => $plan_detail->plan_id,
            'department_id' => $plan_detail->department_id,
            'position_id'   => $plan_detail->position_id,
            'quantity'      => $plan_detail->quantity,
        ];
    }

    // public function includeDepartments(Plan_detail $plan_detail = null)
    // {
    //     if (is_null($plan_detail)) {
    //         return $this->null();
    //     }

    //     return $this->collection($plan_detail->departments, new DepartmentTransformer);
    // }

    // public function includePositions(Plan_detail $plan_detail = null)
    // {
    //     if (is_null($plan_detail)) {
    //         return $this->null();
    //     }

    //     return $this->collection($plan_detail->positions, new PositionTransformer);
    // }
}
