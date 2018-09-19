<?php

namespace App\Policies;

use App\User;
use App\Repositories\plans\plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Plan.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\plan $plan
     * @return mixed
     */
    public function view(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.view']);
    }

    /**
     * Determine whether the user can create Plan.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['plan.create']);
    }

    /**
     * Determine whether the user can update the Plan.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\plan  $plan
     * @return mixed
     */
    public function update(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.update']);
    }

    /**
     * Determine whether the user can delete the Plan.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\plan  $plan
     * @return mixed
     */
    public function delete(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.delete']);
    }
}
