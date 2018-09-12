<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Cities\CityRepository;

class CityController extends ApiController
{
    /**
     * CityController constructor.
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
    {
        $this->model = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->getAll();
    }
}
