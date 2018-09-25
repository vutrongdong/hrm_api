<?php

namespace App\Repositories\Contracts;

trait PresentationTrait
{
	public function getStatus()
	{
		return self::DISPLAY_STATUS[$this->status ?? self::STANDARD];
	}

	public function getType()
	{
		return self::DISPLAY_TYPE[$this->type ?? self::TRAINING];
	}
}
