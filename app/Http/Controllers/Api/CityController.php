<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Cities\CityRepository;
use App\Http\Transformers\CityTransformer;

class CityController extends ApiController
{
    /**
     * CityController constructor.
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
    {
        $this->model = $city;
        $this->setTransformer(new CityTransformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('branch.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }
}
