<?php

namespace App\Repositories\Contracts;

use App\Repositories\BaseRepository;

class ContractRepository extends BaseRepository
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
    public function __construct(Contract $contract)
    {
        $this->model = $contract;
    }

    public function getAllStatus()
    {
        return implode(',', Contract::ALL_STATUS);
    }   

    public function getAllType()
    {
        return implode(',', Contract::ALL_TYPE);
    }
}
