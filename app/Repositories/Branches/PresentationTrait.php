<?php

namespace App\Repositories\Branches;

trait PresentationTrait
{
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::ENABLE];
    }

    public function getType()
    {
        return self::DISPLAY_BRANCH[$this->type ?? self::NOT_MAIN];
    }

    public static function getAllStatus()
    {
        return implode(',', self::ALL_STATUS);
    }
}
