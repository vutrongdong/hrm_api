<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Plans\Plan;
use App\Repositories\Plans\PlanRepository;
use App\Http\Transformers\PlanTransformer;

class PlanController extends ApiController
{
    protected $validationRules = [
        'title'     => 'required|unique:plans,title',
        'status'    => 'in:',
    ];
    protected $validationMessages = [
        'title.required' => 'Tiêu đề không được để trống',
        'title.unique'   => 'Tiêu đề đã tồn tại trên hệ thống',
        'status.in'      => 'Trạng thái không hợp lệ',
    ];

    /**
     * PlanController constructor.
     * @param PlanRepository $plan
     */
    public function __construct(PlanRepository $plan)
    {
        $this->model = $plan;
        $this->setTransformer(new PlanTransformer);
        $this->validationRules['status'] .= Plan::getAllStatus();
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        // $this->authorize('plan.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            // $this->authorize('plan.view');
            return $this->successResponse($this->model->getById($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function store(Request $request)
    {
        try {
            // $this->authorize('plan.create');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->model->store($request->all());

            return $this->successResponse($data);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function update($id, Request $request)
    {
        $this->validationRules['title'] .= ',' . $id;
        try {
            // $this->authorize('plan.update');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->model->update($id, $request->all());
            
            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this    ->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function destroy($id)
    {
        try{
            // $this->authorize('plan.delete');
            $this->model->delete($id);

            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
}
