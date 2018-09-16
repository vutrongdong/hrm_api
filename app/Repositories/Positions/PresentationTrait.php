<?php

namespace App\Repositories\Positions;

trait PresentationTrait
{
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::DISABLE];
    }
    
    public static function getAllStatus()
    {
        return implode(',', self::ALL_STATUS);
    }
}
