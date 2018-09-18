<?php

namespace App\Repositories\Contracts;

trait PresentationTrait
{
	public function getStatus()
	{
		return self::DISPLAY_STATUS[$this->status ?? self::ENABLE];
	}

	public function getType()
	{
		return self::DISPLAY_TYPE[$this->type ?? self::TRAINING];
	}

	public static function getAllStatus()
	{
		return implode(',', self::ALL_STATUS);
	}

	public static function getAllType()
	{
		return implode(',', self::ALL_TYPE);
	}
}
