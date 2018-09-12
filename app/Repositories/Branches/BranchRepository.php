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
}
