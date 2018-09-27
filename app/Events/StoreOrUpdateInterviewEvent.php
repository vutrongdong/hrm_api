<?php

namespace App\Events;
use App\Repositories\Candidates\Candidate;

class StoreOrUpdateInterviewEvent extends Event
{
    public $candidate;
	public $interview_by;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate, $interview_by)
    {
        $this->candidate = $candidate;
        $this->interview_by = $interview_by;
    }
}
