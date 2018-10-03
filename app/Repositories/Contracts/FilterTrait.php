<?php

namespace App\Repositories\Contracts;

trait FilterTrait
{
	/**
	 * Tìm kiếm theo tiêu đề hợp đồng
	 * @param  [type] $query [description]
	 * @param  [type] $q     [description]
	 * @return Collection Contract Model
	 */
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('title', 'like', "%${q}%");
		}
		return $query;
	}  

	/**
	 * Tìm kiếm theo loại hợp đồng
	 * @param  [type] $query [description]
	 * @param  [type] $type  [description]
	 * @return Collection Contract Model
	 */
	public function scopeType($query, $type)
	{
		if (in_array($type, self::ALL_TYPE)) {
			return $query->where('type', $type);
		}
		return $query;
	}

	/**
	 * Tìm kiếm theo ngày ký trong khoảng [$dateSignStart, $dateSignEnd]
	 * @param  [type] $query         [description]
	 * @param  [type] $dateSignStart [description]
	 * @return Collection Contract Model
	 */
	public function scopeDateSignStart($query, $dateSignStart)
	{
		if ($dateSignStart) {
			return $query->where('date_sign', '>=', $dateSignStart);
		}
		return $query;
	}	

	/**
	 * Tìm kiếm theo ngày ký trong khoảng [$dateSignStart, $dateSignEnd]
	 * @param  [type] $query       		[description]
	 * @param  int[1-12] $dateSignEnd   [description]
	 * @return Collection Contract Model
	 */
	public function scopeDateSignEnd($query, $dateSignEnd)
	{
		if ($dateSignEnd) {
			return $query->where('date_sign', '<=', $dateSignEnd);
		}
		return $query;
	}

	/**
	 * Tìm kiếm hợp đồng sắp hết hạn trong 1 tháng cụ thể
	 * @param  [type] $query          [description]
	 * @param  int[1-12] $dateExpiration [description]
	 * @return Collection Contract Model
	 */
	public function scopeMonthExpiration($query, $monthExpiration)
	{
		if ($monthExpiration) {
			return $query->where('date_expiration', $monthExpiration);
		}
		return $query;
	}


}
