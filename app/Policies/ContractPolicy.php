<?php

namespace App\Policies;

use App\User;
use App\Repositories\Contracts\Contract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Contract.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Contract $contract
     * @return mixed
     */
    public function view(User $user, Contract $contract = null)
    {
        return $user->hasAccess(['contract.view']);
    }

    /**
     * Determine whether the user can create Contract.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['contract.create']);
    }

    /**
     * Determine whether the user can update the Contract.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Contract  $contract
     * @return mixed
     */
    public function update(User $user, Contract $contract = null)
    {
        return $user->hasAccess(['contract.update']);
    }

    /**
     * Determine whether the user can delete the Contract.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\Contract  $contract
     * @return mixed
     */
    public function delete(User $user, Contract $contract = null)
    {
        return $user->hasAccess(['contract.delete']);
    }
}
