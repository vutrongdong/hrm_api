<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Wards\WardRepository;

class WardController extends ApiController
{
    public function __construct(WardRepository $ward)
    {
        $this->model = $ward;
    }

    public function getByDistrict(Request $request, $cID)
    {
        return $this->model->getByDistrict($cID);
    }
}
