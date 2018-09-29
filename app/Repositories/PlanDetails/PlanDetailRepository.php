<?php

namespace App\Repositories\PlanDetails;

use App\Repositories\BaseRepository;
use DB;

class PlanDetailRepository extends BaseRepository
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
    public function __construct(PlanDetail $planDetail)
    {
        $this->model = $planDetail;
    }

    // public function store($data)
    // {
    //     $lastPlanID = DB::table('plans')->latest('id')->first()->id;
    //     $data['plan_id'] = $lastPlanID;
    //     $planDetail = parent::store($data);
    //     return $planDetail;
    // }
}
