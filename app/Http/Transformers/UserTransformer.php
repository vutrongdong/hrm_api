<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'roles', 'branches', 'departments', 'positions', 'contracts', 'candidates'
    ];

    public function transform(User $user = null)
    {
        if (is_null($user)) {
            return [];
        }

        return [
            'id'            => $user->id,
            'code'          => $user->code,
            'name'          => $user->name,
            'qualification' => $user->qualification,
            'address'       => $user->address,
            'email'         => $user->email,
            'phone'         => $user->phone,
            'date_of_birth' => $user->date_of_birth,
            'avatar'        => $user->avatar,
            'gender'        => $user->gender,
            'gender_txt'    => $user->getGender(),
            'status'        => $user->status,
            'status_txt'    => $user->getStatus(),
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

    public function includeContracts(User $user = null)
    {
        if (is_null($user)) {
            return $this->null();
        }
        return $this->collection($user->contracts, new ContractTransformer);
    }     

    public function includeCandidates(User $user = null)
    {
        if (is_null($user)) {
            return $this->null();
        }
        return $this->collection($user->candidates, new CandidateTransformer);
    }  
}
