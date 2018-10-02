<?php

namespace App\Repositories\Branches;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%")
			->orWhere('email', 'like', "%${q}%");
		}
		return $query;
	}    

	public function scopeCityID($query, $cityId)
	{
		if ($cityId) {
			return $query->where('city_id', $cityId);
		}
		return $query;
	}

	public function scopeDistrictID($query, $districtId)
	{
		if ($districtId) {
			return $query->where('district_id', $districtId);
		}
		return $query;
	}
}
