<?php

namespace App\Repositories\Branches;

trait PresentationTrait
{
    /**
     * Check specific role has access a resource
     * @param  array   $permissions
     * @return boolean
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check a specific permission that belongs to this role
     * @param  string  $permission
     * @return boolean
     */
    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }

    public function getStatus()
    {
        if ($this->status == self::STATUS_ENABLE) {
            return 'Hiển thị';
        } else {
            return 'Không hiển thị';
        }
    }

    public function getType()
    {
        if ($this->type == self::BRANCH_MAIN) {
            return 'Chi nhánh chính';
        } else {
            return 'Chi nhánh phụ';
        }
    }
}
