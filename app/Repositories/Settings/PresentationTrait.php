<?php

namespace App\Repositories\Settings;

trait PresentationTrait
{
	public function getStatus()
	{
		return $this->status === self::STATUS_ENABLE ? 'Hiển thị' : 'Không hiển thị';
	}
}
