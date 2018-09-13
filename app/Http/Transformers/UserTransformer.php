<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'roles', 'departments', 'positions'
    ];

    public function transform(User $user = null)
    {
        if (is_null($user)) {
            return [];
        }

        return [
            'id'          => $user->id,
            'name'        => $user->name,
            'email'       => $user->email,
            'phone'       => $user->phone,
            'password'    => $user->password,
        ];
    }

    public function includeRoles(User $user = null)
    {
        if (is_null($user)) {
            return $this->null();
        }
        return $this->collection($user->roles, new RoleTransformer);
    }

    public function includeDepartments(User $user = null)
    {
        if (is_null($user)) {
            return $this->null();
        }
        return $this->collection($user->departments, new DepartmentTransformer);
    }

    public function includePositions(User $user = null)
    {
        if (is_null($user)) {
            return $this->null();
        }
        return $this->collection($user->positions, new PositionTransformer);
    }
}
