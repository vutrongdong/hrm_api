<?php

namespace App\Events;
use App\User;

class StoreContractUserEvent extends Event
{
    public $user;
	public $contract;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $contract)
    {
        $this->user = $user;
        $this->contract = $contract;
    }
}
