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

    public function getAllStatus()
    {
        return implode(',', Department::ALL_STATUS);
    }

    public function getByBranch(int $id)
    {
        return $this->model->where('branch_id', $id)->get();
    }

    public function changeStatus($id)
    {
        $department = parent::getById($id);
        if ($department->status === 0) {
            parent::update($id, ['status' => 1]);
        } else {
            parent::update($id, ['status' => 0]);
        }
    }
}
