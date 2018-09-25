<?php

namespace App\Repositories\Plans;

trait PresentationTrait
{
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::CREATED];
    }
}
