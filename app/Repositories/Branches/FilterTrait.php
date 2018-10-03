<?php

namespace App\Repositories\Branches;

trait FilterTrait
{
	/**
	 * Tìm kiếm theo tên, email
	 * @param  [type] $query [description]
	 * @param  string $q     name, email
	 * @return Collection Branch Model
	 */
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%")
			->orWhere('email', 'like', "%${q}%");
		}
		return $query;
	}    

	/**
	 * Tìm kiếm theo thành phố
	 * @param  [type] $query  	[description]
	 * @param  int    $cityId 	city_id
	 * @return Collection Branch Model
	 */
	public function scopeCityID($query, $cityId)
	{
		if ($cityId) {
			return $query->where('city_id', $cityId);
		}
		return $query;
	}

	/**
	 * Tìm kiếm theo quận/huyện
	 * @param  [type] $query      	  [description]
	 * @param  int    $districtId 	  district_id
	 * @return Collection Branch Model
	 */
	public function scopeDistrictID($query, $districtId)
	{
		if ($districtId) {
			return $query->where('district_id', $districtId);
		}
		return $query;
	}
}
