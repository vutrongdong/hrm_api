<?php

namespace App\Repositories\Plan_details;

use App\Repositories\BaseRepository;

class Plan_detailRepository extends BaseRepository
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
    public function __construct(Plan_detail $plan_detail)
    {
        $this->model = $plan_detail;
    }
}
