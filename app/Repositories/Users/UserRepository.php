<?php

namespace App\Repositories\Users;

use Event;
use App\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ContractRepository;
use App\Events\StoreContractUserEvent;
use App\Events\UpdateContractUserEventactUserEvent;
use App\Events\StoreOrUpdateDepartmentUserEvent;

class UserRepository extends BaseRepository
{
    /**
     * User model.
     * @var Model
     */
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAllGender()
    {
        return implode(',', User::ALL_GENDER);
    }

    public function getAllStatus()
    {
        return implode(',', User::ALL_STATUS);
    }

    public function update($id, $data, $excepts = [], $only = [])
    {
        $record = parent::update($id, $data);
        $departments = array_get($data, 'departments', []);
        if ($departments) {
            event(new StoreOrUpdateDepartmentUserEvent($record, $departments));
       }

        $contract = array_get($data, 'contract', []);
        if ($contract) {
            event(new UpdateContractUserEvent($record, $contract));
        }
        return $record;
    }

    public function store($data)
    {
        $user = parent::store($data);
        $departments = array_get($data, 'departments', []);
        if ($departments) {
            event(new StoreOrUpdateDepartmentUserEvent($user, $departments));
        }

        $contract = array_get($data, 'contract', []);
        if ($contract) {
            event(new StoreContractUserEvent($user, $contract));
        }
        return $user;
    }
}
