<?php

namespace App\Repositories\Candidates;

use App\Repositories\BaseRepository;

class CandidateRepository extends BaseRepository
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
    public function __construct(Candidate $candidate)
    {
        $this->model = $candidate;
    }
}
