<?php

namespace App\Repositories\Settings;

trait PresentationTrait
{
	public function getStatus()
	{
        return self::DISPLAY_STATUS[$this->status ?? self::DISABLE];
	}
}
