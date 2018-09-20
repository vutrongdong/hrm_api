<?php

namespace App\Repositories\Departments;

use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository
{
    /**
     * Department model.
     * @var Model
     */
    protected $model;

    /**
     * DepartmentRepository constructor.
     * @param Department $department
     */
    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    public function getByBranch(int $id)
    {
        return $this->model->where('branch_id', $id)->get();
    }
}
