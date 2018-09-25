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

    public function getAllStatus()
    {
        return implode(',', Candidate::ALL_STATUS);
    } 

    public function getAllType()
    {
        return implode(',', Candidate::ALL_TYPE);
    }

    public function store($data)
    {
        $candidate = parent::store($data);
        $interview_by = array_get($data, 'interview_by', []);
        if ($interview_by) {
            $this->storeOrUpdateInterview($candidate, $interview_by);
        }
        return $candidate;
    }

    public function update($id, $data, $excepts = [], $only = [])
    {
        $record = parent::update($id, $data);
        $interview_by = array_get($data, 'interview_by', []);
        if ($interview_by) {
            $this->storeOrUpdateInterview($record, $interview_by);
        }
        return $record;
    }

    public function storeOrUpdateInterview(Candidate $candidate, array $data)
    {
        $candidate->users()->sync($data);
    }
}
