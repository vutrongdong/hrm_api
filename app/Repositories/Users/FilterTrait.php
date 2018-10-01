<?php

namespace App\Repositories\Users;

trait FilterTrait
{
	public function scopeQ($query, $q)
	{
		if ($q) {
			#filter by name/phone/email/code
			// return$query->where('name', 'like', "%${q}%")
			// ->orWhere('phone', 'like', "%${q}%")
			// ->orWhere('email', 'like', "%${q}%")
			// ->orWhere('code', 'like', "%${q}%");

			#filter by department

			return $query->whereHas('departments', function ($query) {
				$query->where('department_user.department_id', '=', '${q}');
			});

			// return $query->select('users.*')->join('department_user', function ($join) {
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// })->where('department_user.department_id', '=', '${q}');

			#filter by position
			// return $query->select('users.*')->join('department_user', function ($join) {
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// })->where('department_user.position_id', '=', "${q}");

			// return $query->whereHas('positions', function ($query) {
			// 	$query->where('department_user.position_id', '=', '${position_id}');
			// });

			// return $query->select('users.*')->join('department_user', function ($join) {
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// })->where('department_user.department_id', '=', "${q}");

			// return $query->select('users.*')
			// ->join('department_user', 'users.id', '=', 'department_user.user_id')
			// ->join('departments', 'department_user.department_id', '=', 'departments.id')
			// ->where('departments.branch_id', '=', '${q}');

			// return $query->select('users.*')->join('department_user', function ($join) {
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// 	$join->join('departments', function ($join) {
			// 		$join->on('department_user.department_id', '=', 'departments.id');
			// 	})->where('departments.branch_id', '=', "${q}");
			// });

			// return $query->whereHas('departments', function ($query) {
			// 	$query->whereHas('users', function ($query) {
			// 		$query->where('departments.branch_id', '=', '${q}');
			// 	});
			// });

			// return $query->select('users.*')->join('department_user', function ($join) {
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// 	$join->on('departments.id', '=', 'department_user.user_id');
			// })->where('department_user.department_id', '=', "${q}");

			// return $query->whereHas('departments', function ($query) {
			// 	$query->join('departments', function ($join) {
			// 		$join->on('users.id', '=', 'department_user.user_id');
			// 	});
			// });
		}
		return $query;
	}	

	// public function scopeDepartmentID($query, $department_id)
	// {
	// 	if ($department_id) {
	// 		return $query->whereHas('departments', function ($query) {
	// 			$query->where('department_user.department_id', '=', '${department_id}');
	// 		});

	// 		// return $query->select('users.*')->join('department_user', function ($join) {
	// 		// 	$join->on('users.id', '=', 'department_user.user_id');
	// 		// })->where('department_user.department_id', '=', "${department_id}");
	// 	}
	// 	return $query;
	// }	

// SELECT * 
// FROM hrm.users 
// INNER JOIN department_user ON users.id=department_user.user_id
// INNER JOIN departments ON department_user.department_id=departments.id AND departments.branch_id=1;

	// public function scopeBranchID($query, $branch_id)
	// {
	// 	if ($branch_id) {
	// 		return $query->select('users.*')->join('department_user', function ($join) {
	// 			$join->on('users.id', '=', 'department_user.user_id');
	// 		})->where('department_user.department_id', '=', '${department_id}');

			// return $query->whereHas('departments', function ($query) {
			// 	$query->join('department_user', function ($join) {
			// 		$join->on('users.id', '=', 'department_user.user_id');
			// 	});
			// });

			// return $query->select('users.*')->join('department_user', function ($join) {
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// 	$join->on('users.id', '=', 'department_user.user_id');
			// })->where('department_user.department_id', '=', "${branch_id}");
	// 	}
	// 	return $query;
	// }
}
