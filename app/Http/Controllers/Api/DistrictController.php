<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Districts\DistrictRepository;

class DistrictController extends ApiController
{
    /**
     * DistrictController constructor.
     * @param DistrictRepository $district
     */
    public function __construct(DistrictRepository $district)
    {
        $this->model = $district;
    }

    /**
     * Listing district by city
     *
     * @return \Illuminate\Http\Response
     */
    public function getByCity(Request $request, $cID)
    {
        return $this->model->getByCity($cID);
    }
}
