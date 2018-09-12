<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Positions\Position;

class PositionTransformer extends TransformerAbstract
{
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
}
