<?php

namespace App\Repositories\Positions;

trait FilterTrait
{
	/**
	 * [scopeQ description]
	 * @param  [type] $query [description]
	 * @param  [type] $q     [description]
	 * @return [type]        [description]
	 */
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%");
		}
		return $query;
	}

	/**
	 * [scopeID description]
	 * @param  [type] $query [description]
	 * @param  [type] $id    [description]
	 * @return [type]        [description]
	 */
	public function scopeID($query, $id)
	{
		if ($id) {
			return $query->where('id', $id);
		}
		return $query;
	}
}
