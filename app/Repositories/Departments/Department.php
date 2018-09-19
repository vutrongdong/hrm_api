<?php

namespace App\Repositories\Departments;

use App\Repositories\Entity;

class Department extends Entity {
	use FilterTrait, PresentationTrait;

	const ENABLE = 1;
	const DISABLE = 0;

	const ALL_STATUS = [
		self::DISABLE,
		self::ENABLE,
	];
	const DISPLAY_STATUS = [
		self::DISABLE => 'Không hiển thị',
		self::ENABLE => 'Hiển thị',
	];

	/**
	 * Fillable definition
	 * @var array
	 */
	protected $fillable = [
		'name',
		'branch_id',
		'status',
	];

	// public function scopeQ($query, $value = null)
	// {
	//     if ($value) {
	//         return $query->where('name', 'like', "%{$value}%");
	//     }
	//     return $query;
	// }

	public function branch() {
		return $this->belongsTo(\App\Repositories\Branches\Branch::class);
	}

	public function users() {
		return $this->belongsToMany(\App\User::class, 'department_user')->withPivot(['position_id', 'status']);
	}

	// public function branches()
	// {
	//     return $this->hasMany(\App\Repositories\Branches\Branch::class);
	// }

	public function branches() {
		return $this->belongsToMany(\App\Repositories\Branches\Branch::class);
	}
}
