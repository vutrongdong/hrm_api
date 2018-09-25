<?php

namespace App\Repositories\Plans;

use App\Repositories\BaseRepository;
use App\Repositories\PlanDetails\PlanDetail;

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
            $this->storePlanDetails($plan, $details);
        }

        return $plan;
    }

    public function storePlanDetails(Plan $plan, array $data)
    {
        $insertData = [];
        foreach ($data as $key => $value) {
            $insertData[] = [
                'plan_id' => $plan->id,
                'department_id' => $value['department_id'],
                'position_id' => $value['position_id'],
                'quantity' => $value['quantity']
            ];
        }
        PlanDetail::insert($insertData);
    }
}
