<?php

namespace App\Repositories\Departments;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%");
		}
		return $query;
	}   

	public function scopeBranchID($query, $branchId)
	{
		if ($branchId) {
			return $query->where('branch_id', $branchId);
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
