<?php

namespace App\Repositories\Wards;

use App\Repositories\BaseRepository;

class WardRepository extends BaseRepository
{

    protected $model;


    public function __construct(Ward $ward)
    {
        $this->model = $ward;
    }

    public function getByDistrict(int $cID)
    {
        return $this->model->where('district_id', $cID)->get();
    }
}
