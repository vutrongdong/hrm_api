<?php

namespace App\Repositories\Candidates;

trait PresentationTrait
{
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::CREATED];
    }

    public function getType()
    {
        return self::DISPLAY_TYPE[$this->status ?? self::TRAINING];
    }
}
