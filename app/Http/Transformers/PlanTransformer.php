<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Plans\Plan;

class PlanTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'departments', 'positions'
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
        ];
    }

    public function includeDepartments(Plan $plan = null)
    {
        if (is_null($plan)) {
            return $this->null();
        }

        return $this->collection($plan->departments, new DepartmentTransformer);
    }  

    public function includePositions(Plan $plan = null)
    {
        if (is_null($plan)) {
            return $this->null();
        }

        return $this->collection($plan->positions, new PositionTransformer);
    }
}
