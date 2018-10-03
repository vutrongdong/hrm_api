<?php

namespace App\Repositories\Contracts;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('title', 'like', "%${q}%");
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

	public function scopeDateSignStart($query, $dateSignStart)
	{
		if ($dateSignStart) {
			return $query->where('date_sign', '>=', $dateSignStart);
		}
		return $query;
	}	

	public function scopeDateSignEnd($query, $dateSignEnd)
	{
		if ($dateSignEnd) {
			return $query->where('date_sign', '<=', $dateSignEnd);
		}
		return $query;
	}

	public function scopeDateEffective($query, $dateEffective)
	{
		if ($dateEffective) {
			return $query->where('date_effective', '>=', $dateEffective);
		}
		return $query;
	}

	public function scopeDateExpiration($query, $dateExpiration)
	{
		if ($dateExpiration) {
			return $query->where('date_expiration', '>=', $dateExpiration);
		}
		return $query;
	}


}
