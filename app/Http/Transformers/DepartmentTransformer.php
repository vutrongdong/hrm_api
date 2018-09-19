<?php

namespace App\Http\Transformers;

use App\Repositories\Departments\Department;
use App\Repositories\Positions\PositionRepository;
use League\Fractal\TransformerAbstract;

class DepartmentTransformer extends TransformerAbstract {
	protected $availableIncludes = [
		'branch', 'users',
	];

	public function transform(Department $department = null) {
		if (is_null($department)) {
			return [];
		}

		$data = [
			'id' => $department->id,
			'name' => $department->name,
			'branch_id' => $department->branch_id,
			'status' => $department->status,
			'status_txt' => $department->getStatus(),
		];

		if ($department->pivot && $department->pivot->position_id) {
			$data['position_id'] = $department->pivot->position_id;
			$data['position_name'] = app()->make(PositionRepository::class)->getById($data['position_id'])->name;
		}

		return $data;
	}

	public function includeBranch(Department $department = null) {
		if (is_null($department)) {
			return $this->null();
		}

		return $this->item($department->branch, new BranchTransformer);
	}

	public function includeUsers(Department $department = null) {
		if (is_null($department)) {
			return $this->null();
		}

		return $this->collection($department->users, new UserTransformer);
	}
}
