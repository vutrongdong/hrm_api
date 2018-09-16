<?php

namespace App\Repositories\Departments;

trait PresentationTrait
{
    public function getStatus()
    {
        if ($this->status == self::STATUS_ENABLE) {
            return 'Hiển thị';
        } else {
            return 'Không hiển thị';
        }
    }

    public function getAllStatus()
    {
        return implode(',', self::STATUS);
    }
}
