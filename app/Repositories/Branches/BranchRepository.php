<?php

namespace App\Repositories\Branches;

use App\Repositories\BaseRepository;

class BranchRepository extends BaseRepository
{
    /**
     * Branch model.
     * @var Model
     */
    protected $model;

    /**
     * BranchRepository constructor.
     * @param Branch $branch
     */
    public function __construct(Branch $branch)
    {
        $this->model = $branch;
    }

    public function getAllStatus()
    {
        return implode(',', Branch::ALL_STATUS);
    }

    public function changeStatus($id)
    {
        $branch = parent::getById($id);
        if ($branch->status === 0) {
            parent::update($id, ['status' => 1]);
        } else {
            parent::update($id, ['status' => 0]);
        }
    }
}
