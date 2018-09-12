<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Departments\Department;

class DepartmentTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'branch'
    ];

    public function transform(Department $department = null)
    {
        if (is_null($department)) {
            return [];
        }

        return [
            'id'            => $department->id,
            'name'          => $department->name,
            'branch_id'     => $department->branch,
            'status'        => $department->status,
        ];
    }

    public function includeBranch(Department $department = null)
    {
        if (is_null($department)) {
            return $this->null();
        }
    }
}
