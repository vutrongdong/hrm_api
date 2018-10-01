<?php

namespace App\Repositories\Contracts;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%");
		}
		return $query;
	}  

	public function scopeType($query, $type)
	{
		if (in_array($type, self::ALL_TYPE)) {
			return $query->where('type', $type);
		}
		return $query;
	}


}
