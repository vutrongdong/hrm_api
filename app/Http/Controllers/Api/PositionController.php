<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Positions\Position;
use App\Repositories\Positions\PositionRepository;
use App\Http\Transformers\PositionTransformer;

class PositionController extends ApiController
{
    protected $validationRules = [
        'name' => 'required|unique:positions,name',
        'status'    => 'in:',
    ];
    protected $validationMessages = [
        'name.required' => 'Tên chức vụ không được để trống',
        'name.unique'   => 'Tên chức vụ đã tồn tại trên hệ thống',
        'status.in'     => 'Trạng thái không hợp lệ',
    ];

    protected $positionStatus;
    /**
     * PositionController constructor.
     * @param PositionRepository $position
     */
    public function __construct(PositionRepository $position, Position $positionStatus)
    {
        $this->model = $position;
        $this->positionStatus = $positionStatus;
        $this->setTransformer(new PositionTransformer);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $this->authorize('position.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            $this->authorize('position.view');
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
        $this->validationRules['status'] .= $this->positionStatus->getAllStatus();
        try {
            $this->authorize('position.create');
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
        $this->validationRules['name'] .= ',' . $id;
        $this->validationRules['status'] .= $this->positionStatus->getAllStatus();
        try {
            $this->authorize('position.update');
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
            $this->authorize('position.delete');
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
