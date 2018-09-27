<?php

namespace App\Repositories\Plans;

use App\Repositories\BaseRepository;
use App\Repositories\PlanDetails\PlanDetailRepository;
use App\Events\StorePlanDetailEvent;

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

    public function getAllStatus()
    {
        return implode(',', Plan::ALL_STATUS);
    }

    public function store($data)
    {
        $plan = parent::store($data);
        $details = array_get($data, 'details', []);
        if ($details) {
            event(new StorePlanDetailEvent($plan, $details));
        }

        return $plan;
    }
}
