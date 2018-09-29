<?php

namespace App\Repositories\Users;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			return $query->where('name', 'like', "%${q}%")
			->orWhere('phone', 'like', "%${q}%")
			->orWhere('email', 'like', "%${q}%")
			->orWhere('code', 'like', "%${q}%");
		}
		return $query;
	}	

	public function scopeDepartmentID($query, $department_id)
	{
		if ($department_id) {
			return $query->select('users.*')->join('department_user', function ($join) {
				$join->on('users.id', '=', 'department_user.user_id');
			})->where('department_user.department_id', '=', "${department_id}");
		}
		return $query;
	}	

// SELECT users.*
// FROM users INNER JOIN department_user ON users.id = department_user.user_id
	// public function scopeBranchID($query, $branch_id)
	// {
	// 	if ($branch_id) {
	// 		return $query->select('users.*')->join('department_user', function ($join) {
	// 			$join->on('users.id', '=', 'department_user.user_id');
	// 			$join->on('users.id', '=', 'department_user.user_id');
	// 		})->where('department_user.department_id', '=', "${branch_id}");
	// 	}
	// 	return $query;
	// }
}
