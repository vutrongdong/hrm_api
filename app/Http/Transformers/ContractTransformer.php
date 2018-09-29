<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Contracts\Contract;

class ContractTransformer extends TransformerAbstract
{
    // protected $availableIncludes = [
    //     'user'
    // ];

    public function transform(Contract $contract = null)
    {
        if (is_null($contract)) {
            return [];
        }

        return [
            'id'              => $contract->id,
            'code'            => $contract->name,
            'title'           => $contract->title,
            'type'            => $contract->type,
            'type_txt'        => $contract->getType(),
            'status'          => $contract->status,
            'status_txt'      => $contract->getStatus(),
            'date_sign'       => $contract->date_sign,
            'date_effective'  => $contract->date_effective,
            'date_expiration' => $contract->date_expiration,
            'user_id'         => $contract->user_id,
            'user_name'       => $contract->user->name,
            // 'created_at'   => $contract->created_at,
            // 'updated_at'   => $contract->updated_at,
        ];
    }

    // public function includeUser(Contract $contract = null)
    // {
    //     if (is_null($contract)) {
    //         return $this->null();
    //     }

    //     return $this->item($contract->user, new UserTransformer);
    // }
}
