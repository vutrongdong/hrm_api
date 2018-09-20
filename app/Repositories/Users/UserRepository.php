<?php

namespace App\Repositories\Users;

use App\User;
use DB;

use App\Repositories\BaseRepository;

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

    public function update($id, $data, $excepts = [], $only = [])
    {
        $record = parent::update($id, $data);
        $departments = array_get($data, 'departments', []);
        if ($departments) {
            $this->storeOrUpdateDepartmentUser($record, $departments);
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
        return $user;
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
                'status' => $value['status']
            ];
        }

        $user->departments()->sync($insertData);
    }
}
