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

    /**
    * Listing district by city
    * @param  int    $cID
    * @return array
    */
    // public function getByBranch(int $cID)
    // {
    //     return $this->model->where('branch_id', $cID)->get();
    // }
}
