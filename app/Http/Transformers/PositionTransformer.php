<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Positions\Position;

class PositionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'users'
    ];

    public function transform(Position $position = null)
    {
        if (is_null($position)) {
            return [];
        }

        return [
            'id'            => $position->id,
            'name'          => $position->name,
            'status'        => $position->status,
        ];
    }

    public function includeUsers(Position $position = null)
    {
        if (is_null($position)) {
            return $this->null();
        }

        return $this->collection($position->users, new UserTransformer);
    }
}
