<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Plans\Plan;

class PlanTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'details'
    ];

    public function transform(Plan $plan = null)
    {
        if (is_null($plan)) {
            return [];
        }

        return [
            'id'            => $plan->id,
            'title'         => $plan->title,
            'date_start'    => $plan->date_start,
            'date_end'      => $plan->date_end,
            'content'       => $plan->content,
            'status'        => $plan->status,
            'status_txt'    => $plan->getStatus(),
            'created_at'    => $plan->created_at,
            'updated_at'    => $plan->updated_at,
        ];
    }

    // public function includeDepartments(Plan $plan = null)
    // {
    //     if (is_null($plan)) {
    //         return $this->null();
    //     }

    //     return $this->collection($plan->departments, new DepartmentTransformer);
    // }   

    public function includeDetails(Plan $plan = null)
    {
        if (is_null($plan)) {
            return $this->null();
        }

        return $this->collection($plan->details, new PlanDetailTransformer);
    }  

    // public function includePositions(Plan $plan = null)
    // {
    //     if (is_null($plan)) {
    //         return $this->null();
    //     }

    //     return $this->collection($plan->positions, new PositionTransformer);
    // }
}
