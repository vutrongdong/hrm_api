<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Districts\District;

class DistrictTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'city'
    ];

    public function transform(District $district = null)
    {
        if (is_null($district)) {
            return [];
        }

        return [
            'id'            => $district->id,
            'name'          => $district->name,
            'slug'          => $district->slug,
            'zipcode'       => $district->zipcode,
            'order'         => $district->order,
            'status'        => $district->status
        ];
    }

    public function includeCity(District $district = null)
    {
        if (is_null($district)) {
            return $this->null();
        }

        return $this->item($district->city, new CityTransformer);
    }
}
