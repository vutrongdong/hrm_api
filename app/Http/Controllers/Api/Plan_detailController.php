<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Plan_details\Plan_detail;
use App\Repositories\Plan_details\Plan_detailRepository;
use App\Http\Transformers\Plan_detailTransformer;

class Plan_detailController extends ApiController
{
    protected $validationRules = [
        // 'title'     => 'required|unique:plan_details,title',
        // 'status'    => 'in:',
    ];
    protected $validationMessages = [
        // 'title.required' => 'Tiêu đề không được để trống',
        // 'title.unique'   => 'Tiêu đề đã tồn tại trên hệ thống',
        // 'status.in'      => 'Trạng thái không hợp lệ',
    ];

    /**
     * Plan_detailController constructor.
     * @param Plan_detailRepository $plan_detail
     */
    public function __construct(Plan_detailRepository $plan_detail)
    {
        $this->model = $plan_detail;
        $this->setTransformer(new Plan_detailTransformer);
        // $this->validationRules['status'] .= Plan_detail::getAllStatus();
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        // $this->authorize('plan_detail.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            // $this->authorize('plan_detail.view');
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
            // $this->authorize('plan_detail.create');
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
        // $this->validationRules['title'] .= ',' . $id;
        try {
            // $this->authorize('plan_detail.update');
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
            // $this->authorize('plan_detail.delete');
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
