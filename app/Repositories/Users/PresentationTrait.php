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
        switch ($this->gender) {
            case self::GENDER_MALE:
                return 'Nam';
                break;
            case self::GENDER_FEMALE:
                return 'Nữ';
                break;
            default:
                return 'Khác';
                break;
        }
    }

    public function getStatus()
    {
        if ($this->status == self::STATUS_ENABLE) {
            return 'Kích hoạt';
        } else {
            return 'Không kích hoạt';
        }
    }
}
