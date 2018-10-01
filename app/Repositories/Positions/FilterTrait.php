<?php

namespace App\Repositories\Positions;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%");
		}
		return $query;
	}

	public function scopeID($query, $id)
	{
		if ($id) {
			return $query->where('id', $id);
		}
		return $query;
	}
}
