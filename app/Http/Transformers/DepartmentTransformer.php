<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Departments\Department;

class DepartmentTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'branch', 'users'
    ];

    public function transform(Department $department = null)
    {
        if (is_null($department)) {
            return [];
        }

        return [
            'id'            => $department->id,
            'name'          => $department->name,
            'branch_id'     => $department->branch_id,
            'status'        => $department->status,
            'status_txt'    => $department->getStatus(),
        ];
    }

    public function includeBranch(Department $department = null)
    {
        if (is_null($department)) {
            return $this->null();
        }

        return $this->item($department->branch, new BranchTransformer);
    }

    public function includeUsers(Department $department = null)
    {
        if (is_null($department)) {
            return $this->null();
        }

        return $this->collection($department->users, new UserTransformer);
    }
}
