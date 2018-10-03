<?php

namespace App\Repositories\Users;

trait PresentationTrait
{
    /**
     * [hasAccess description]
     * @param  array   $permissions
     * @return boolean
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($this->roles as $role) {
            if ($role->hasAccess(['admin.super-admin']) || $role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * [inRole description]
     * @param  string $slug
     * @return boolean
     */
    public function inRole(string $slug) : bool
    {
        return $this->roles()->where('slug', $slug)->count() == 1;
    }

    /**
     * [isSuperAdmin description]
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->hasAccess(['admin.super-admin']);
    }


    public function getGender()
    {
        return self::DISPLAY_GENDER[$this->gender ?? self::FEMALE];
    }

    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::DISABLE];
    }

    public function getAvatar()
    {
        return $this->avatar ? asset($this->avatarPath . '/' . $this->avatar) : 'http://via.placeholder.com/170x170';
    }
}
