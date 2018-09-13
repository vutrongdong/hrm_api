<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Branches\Branch;

class BranchTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'departments', 'city', 'district'
    ];

    public function transform(Branch $branch = null)
    {
        if (is_null($branch)) {
            return [];
        }

        return [
            'id'            => $branch->id,
            'name'          => $branch->name,
            'description'   => $branch->description,
            'about'         => $branch->about,
            'phone'         => $branch->phone,
            'address'       => $branch->address,
            'website'       => $branch->website,
            'email'         => $branch->email,
            'facebook'      => $branch->facebook,
            'instagram'     => $branch->instagram,
            'zalo'          => $branch->zalo,
            'tax_number'    => $branch->tax_number,
            'bank'          => $branch->bank,
            'type'          => $branch->type,
            'city_id'       => $branch->city_id,
            'district_id'   => $branch->district_id,
            'ward_id'       => $branch->ward_id,
            'status'        => $branch->status,
        ];
    }

    public function includeDepartments(Branch $branch = null)
    {
        if (is_null($branch)) {
            return $this->null();
        }
        return $this->collection($branch->departments, new DepartmentTransformer);
    } 
    
    public function includeCity(Branch $branch = null)
    {
        if (is_null($branch)) {
            return $this->null();
        }
        return $this->item($branch->city, new CityTransformer);
    } 

    public function includeDistrict(Branch $branch = null)
    {
        if (is_null($branch)) {
            return $this->null();
        }
        return $this->item($branch->district, new DistrictTransformer);
    }
}
