<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Candidates\Candidate;

class CandidateTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'users'
    ];

    public function transform(Candidate $candidate = null)
    {
        if (is_null($candidate)) {
            return [];
        }

        return [
            'id'               => $candidate->id,
            'name'             => $candidate->name,
            'email'            => $candidate->email,
            'phone'            => $candidate->phone,
            'source'           => $candidate->source,
            'date_apply'       => $candidate->date_apply,
            'time_interview'   => $candidate->time_interview,
            'plan_id'          => $candidate->plan_id,
            'position_id'      => $candidate->position_id,
            'status'           => $candidate->status,
            'status_txt'       => $candidate->getStatus(),
        ];
    }

    public function includeUsers(Candidate $candidate = null)
    {
        if (is_null($candidate)) {
            return $this->null();
        }

        return $this->collection($candidate->users, new UserTransformer);
    }
}
