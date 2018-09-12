<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Departments\DepartmentRepository;
use App\Http\Transformers\DepartmentTransformer;

class DepartmentController extends ApiController
{
    protected $validationRules = [
        'name'  => 'required|unique:departments',
        'branch_id'  => 'required',
    ];
    protected $validationMessages = [
        'name.required' => 'Tên phòng ban không được để trống',
        'name.unique'   => 'Tên phòng ban đã tồn tại trên hệ thống',
        'branch_id.required' => 'Vui lòng chọn chi nhánh',
    ];
    /**
     * DepartmentController constructor.
     * @param DepartmentRepository $department
     */
    public function __construct(DepartmentRepository $department)
    {
        $this->model = $department;
        $this->setTransformer(new DepartmentTransformer);
    }

    public function index(Request $request)
    {
        // $this->authorize('branch.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            // $this->authorize('user.view');
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
            // $this->authorize('user.create');
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
         try {
            // $this->authorize('user.update');
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

    // public function getByBranch(Request $request, $cID)
    // {
    //     return $this->model->getByBranch($cID);
    // }
}
