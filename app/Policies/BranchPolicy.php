<?php

namespace App\Policies;

use App\User;
use App\Repositories\Branches\Branch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Branch.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Branch  $Branch
     * @return mixed
     */
    public function view(User $user, Branch $branch = null)
    {
        return $user->hasAccess(['branch.view']);
    }

    /**
     * Determine whether the user can create Branch.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['branch.create']);
    }

    /**
     * Determine whether the user can update the Branch.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Branch  $Branch
     * @return mixed
     */
    public function update(User $user, Branch $branch = null)
    {
        return $user->hasAccess(['branch.update']);
    }

    /**
     * Determine whether the user can delete the Branch.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Branch  $Branch
     * @return mixed
     */
    public function delete(User $user, Branch $branch = null)
    {
        return $user->hasAccess(['branch.delete']);
    }
}
