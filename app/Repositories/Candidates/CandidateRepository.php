<?php

namespace App\Repositories\Candidates;

use App\Repositories\BaseRepository;
use App\Events\StoreOrUpdateInterviewEvent;

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
            event(new StoreInterviewEvent($candidate, $interview_by));
        }
        return $candidate;
    }

    public function update($id, $data, $excepts = [], $only = [])
    {
        $record = parent::update($id, $data);
        $interview_by = array_get($data, 'interview_by', []);
        if ($interview_by) {
            event(new StoreOrUpdateInterviewEvent($record, $interview_by));
        }
        return $record;
    }
}
