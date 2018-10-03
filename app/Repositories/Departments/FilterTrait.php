<?php

namespace App\Repositories\Departments;

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
	 * [scopeBranchID description]
	 * @param  [type] $query    [description]
	 * @param  [type] $branchId [description]
	 * @return [type]           [description]
	 */
	public function scopeBranchID($query, $branchId)
	{
		if ($branchId) {
			return $query->where('branch_id', $branchId);
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
