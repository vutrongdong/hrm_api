<?php

namespace App\Repositories\Users;

use App\User;
use DB;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ContractRepository;

use App\Events\StoreContractUserEvent;
use App\Events\UpdateContractUserEvent;
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
            $this->storeOrUpdateDepartmentUser($record, $departments);
        }

        $contracts = array_get($data, 'contracts', []);
        if ($contracts) {
            $this->updateContract($record, $contracts);
            event(new UpdateContractUserEvent($record, $contracts));
        }
        return $record;
    }

    public function store($data)
    {
        $user = parent::store($data);
        $departments = array_get($data, 'departments', []);
        if ($departments) {
            $this->storeOrUpdateDepartmentUser($user, $departments);
        }

        $contracts = array_get($data, 'contracts', []);
        if ($contracts) {
            $this->storeContract($user, $contracts);
            event(new StoreContractUserEvent($user, $contracts));
        }
        return $user;
    }

    public function storeContract(User $user, $data)
    {
        $data['user_id'] = $user->id;
        app()->make(ContractRepository::class)->store($data);
    }

    public function updateContract(User $user, $data)
    {
        app()->make(ContractRepository::class)->update($data['id'], $data);
    }

    /**
     * store to department_user table
     * @param  User   $user [description]
     * @param  array  $data [department_id, position_id, status]
     * @return [type]       [description]
     */
    public function storeOrUpdateDepartmentUser(User $user, array $data)
    {
        /*department_user
        [
            user_id,
            department_id,
            position_id,
            status
        ]
        =>
        [department_id => ['position_id' => '', 'status' => '']]*/
        $insertData = [];
        foreach ($data as $key => $value) {
            $insertData[$value['department_id']] = [
                'position_id' => $value['position_id'],
                'status' => array_get($data, $key.'.status', 0)
            ];
        }
        $user->departments()->sync($insertData);
    }
}
