<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Positions\Position;
use App\Repositories\Departments\DepartmentRepository;

class PositionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'users'
    ];

    public function transform(Position $position = null)
    {
        if (is_null($position)) {
            return [];
        }

        $data = [
            'id'            => $position->id,
            'name'          => $position->name,
            'status'        => $position->status,
            'status_txt'    => $position->getStatus(),
        ];

        if ($position->pivot && $position->pivot->department_id) {
            $data['department_id'] = $position->pivot->department_id;
            $data['department_name'] = app()->make(DepartmentRepository::class)->getById($data['department_id'])->name;
        }

        return $data;
    }

    public function includeUsers(Position $position = null)
    {
        if (is_null($position)) {
            return $this->null();
        }

        return $this->collection($position->users, new UserTransformer);
    }
}
