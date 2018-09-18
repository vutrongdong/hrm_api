<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Contracts\Contract;

class ContractTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'users'
    ];

    public function transform(Contract $contract = null)
    {
        if (is_null($contract)) {
            return [];
        }

        return [
            'id'            => $contract->id,
            'code'          => $contract->name,
            'title'         => $contract->title,
            'type'          => $contract->type,
            'type_txt'      => $contract->getType(),
            'status'        => $contract->status,
            'status_txt'    => $contract->getStatus(),
        ];
    }

    public function includeUsers(Contract $contract = null)
    {
        if (is_null($contract)) {
            return $this->null();
        }

        return $this->collection($contract->users, new UserTransformer);
    }
}
