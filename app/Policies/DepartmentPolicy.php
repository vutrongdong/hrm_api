<?php

namespace App\Policies;

use App\User;
use App\Repositories\Departments\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Department.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\department  $department
     * @return mixed
     */
    public function view(User $user, Department $department = null)
    {
        return $user->hasAccess(['department.view']);
    }

    /**
     * Determine whether the user can create Department.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['department.create']);
    }

    /**
     * Determine whether the user can update the Department.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\department  $department
     * @return mixed
     */
    public function update(User $user, Department $department = null)
    {
        return $user->hasAccess(['department.update']);
    }

    /**
     * Determine whether the user can delete the Department.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\department  $department
     * @return mixed
     */
    public function delete(User $user, Department $department = null)
    {
        return $user->hasAccess(['department.delete']);
    }
}
