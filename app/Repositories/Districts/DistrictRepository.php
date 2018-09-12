<?php

namespace App\Repositories\Districts;

use App\Repositories\BaseRepository;

class DistrictRepository extends BaseRepository
{
    /**
     * District model.
     * @var Model
     */
    protected $model;

    /**
     * DistrictRepository constructor.
     * @param District $district
     */
    public function __construct(District $district)
    {
        $this->model = $district;
    }

    /**
     * Listing district by city
     * @param  int    $cID
     * @return array
     */
    public function getByCity(int $cID)
    {
        return $this->model->where('city_id', $cID)->get();
    }
}
