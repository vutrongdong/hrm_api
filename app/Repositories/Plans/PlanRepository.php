<?php

namespace App\Repositories\Plans;

use App\Repositories\BaseRepository;

class PlanRepository extends BaseRepository
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
    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }
}
