<?php

namespace App\Events;
use App\User;

class StoreOrUpdateDepartmentUserEvent extends Event
{
    public $user;
	public $departments;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $departments)
    {
        $this->user = $user;
        $this->departments = $departments;
    }
}
