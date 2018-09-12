<?php

namespace App\Repositories\Users;

use App\User;
use DB;
// use App\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * User model.
     * @var Model
     */
    protected $model;

    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store($data)
    {
        $user = $this->model->create($data);
        $this->storeOrUpdateDepartmentUser($user->id, $data);
        return $user;
    }

    public function update($id, $data, $excepts = [], $only = [])
    {
        $data = array_except($data, $excepts);
        if (count($only)) {
            $data = array_only($data, $only);
        }
        $record = $this->getById($id);
        $this->destroyDepartmentUser($id);
        $this->storeOrUpdateDepartmentUser($id, $data);
        $record->fill($data)->save();
        return $record;
    }

    public function storeOrUpdateDepartmentUser($id, $data)
    {
        if (!empty($data['department_id']) && !empty($data['position_id'])) {
            $length = count($data['department_id']);
            for ($i = 0; $i < $length; $i++) { 
                DB::table('department_user')->insert([
                        'user_id' => $id,
                        'department_id' => $data['department_id'][$i],
                        'position_id' => $data['position_id'][$i]
                ]);
            }
        }
    }

    public function destroyDepartmentUser($id)
    {
        DB::table("department_user")->where("user_id",$id)->delete();
    }
}
