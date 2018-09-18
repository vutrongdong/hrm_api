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
}
