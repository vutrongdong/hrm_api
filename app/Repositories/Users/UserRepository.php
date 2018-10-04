<?php

namespace App\Repositories\Users;

use App\Events\StoreContractUserEvent;
use App\Events\StoreOrUpdateDepartmentUserEvent;
use App\Repositories\BaseRepository;
use App\User;
use Event;

class UserRepository extends BaseRepository {
	/**
	 * User model.
	 * @var Model
	 */
	protected $model;

	/**
	 * UserRepository constructor.
	 * @param User $user
	 */
	public function __construct(User $user) {
		$this->model = $user;
	}

	public function getAllGender() {
		return implode(',', User::ALL_GENDER);
	}

	public function getAllStatus() {
		return implode(',', User::ALL_STATUS);
	}

	public function update($id, $data, $excepts = [], $only = []) {
		$record = parent::update($id, $data);
		$departments = array_get($data, 'departments', []);
		if ($departments) {
			event(new StoreOrUpdateDepartmentUserEvent($record, $departments));
		}

		// $contracts = array_get($data, 'contracts', []);
		// if ($contracts) {
		//     event(new UpdateContractUserEvent($record, $contracts));
		// }
		return $record;
	}

	public function store($data) {
		$user = parent::store($data);
		$departments = array_get($data, 'departments', []);
		if ($departments) {
			event(new StoreOrUpdateDepartmentUserEvent($user, $departments));
		}

		$contracts = array_get($data, 'contracts', []);
		if ($contracts && $contracts['title']) {
			event(new StoreContractUserEvent($user, $contracts));
		}
		return $user;
	}

	public function changeStatus($id) {
		$user = parent::getById($id);
		if ($user->status === 0) {
			parent::update($id, ['status' => 1]);
		} else {
			parent::update($id, ['status' => 0]);
		}
	}
}