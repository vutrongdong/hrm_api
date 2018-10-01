<?php

namespace App\Events;

use App\User;

class StoreContractUserEvent extends Event
{
    public $user;
	public $contracts;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $contracts)
    {
        $this->user = $user;
        $this->contracts = $contracts;
        // dd($this->contracts);
    }
}
