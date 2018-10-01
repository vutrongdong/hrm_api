<?php

namespace App\Repositories\Users;

use App\User;
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

    public function changeStatus($id)
    {
        $users = User::where('id',$id)->get();
        foreach ($users as $user) {
            if ($user->status==0) {
                User::where('id',$id)->update([
                    'status'=>1,
                ]);
            }
            else{
                User::where('id',$id)->update([
                    'status'=>0,
                ]);
            }
        }
    }
}
