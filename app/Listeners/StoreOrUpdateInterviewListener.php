<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Candidates\CandidateRepository;
use App\Events\StoreOrUpdateInterviewEvent;

class StoreOrUpdateInterviewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CandidateRepository $candidateRepo)
    {
        $this->candidate = $candidateRepo;
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(StoreOrUpdateInterviewEvent $event)
    {
        $event->candidate->users()->sync($event->interviewBy);
    }
}
