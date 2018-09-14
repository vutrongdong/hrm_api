<?php

namespace App\Policies;

use App\User;
use App\Repositories\Settings\Setting;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Setting.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\setting  $setting
     * @return mixed
     */
    public function view(User $user, Setting $setting = null)
    {
        return $user->hasAccess(['setting.view']);
    }

    /**
     * Determine whether the user can create Setting.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['setting.create']);
    }

    /**
     * Determine whether the user can update the Setting.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\setting  $setting
     * @return mixed
     */
    public function update(User $user, Setting $setting = null)
    {
        return $user->hasAccess(['setting.update']);
    }

    /**
     * Determine whether the user can delete the Setting.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\setting  $setting
     * @return mixed
     */
    public function delete(User $user, Setting $setting = null)
    {
        return $user->hasAccess(['setting.delete']);
    }
}
