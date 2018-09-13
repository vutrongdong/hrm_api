<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Branches\BranchRepository;
use App\Http\Transformers\BranchTransformer;

class BranchController extends ApiController
{
    protected $validationRules = [
        'name'        => 'required',
        'address'     => 'required',
        'tax_number'  => 'required|unique:branches,tax_number',
        'city_id'     => 'required|exists:branches',
        'district_id' => 'required|exists:branches',
        'type'        => 'required',
        'email'       => 'required|email|unique:branches,email',
    ];
    protected $validationMessages = [
        'name.required'        => 'Tên không được để trống',
        'address.required'     => 'Địa chỉ không được để trống',
        'city_id.required'     => 'Vui lòng chọn Thành phố',
        'city_id.exists'       => 'Thành phố không tồn tại trên hệ thống',
        'district_id.required' => 'Vui lòng chọn Quận-Huyện',
        'district_id.exists'   => 'Quận-Huyện không tồn tại trên hệ thống',
        'type.required'        => 'Loại chi nhánh không được để trống',
        'tax_number.required'  => 'Mã số thuế không được để trống',
        'tax_number.unique'    => 'Mã số thuế đã tồn tại trên hệ thống',
        'email.required'       => 'Email không được để trông',
        'email.email'          => 'Email không đúng định dạng',
        'email.unique'         => 'Email đã tồn tại trên hệ thống',
    ];

    /**
     * BranchController constructor.
     * @param BranchRepository $branch
     */
    public function __construct(BranchRepository $branch)
    {
        $this->model = $branch;
        $this->setTransformer(new BranchTransformer);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('branch.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            $this->authorize('branch.view');
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
            $this->authorize('branch.create');
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
        $this->validationRules['tax_number'] .= ',' . $id;
        try {
            $this->authorize('branch.update');
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
            $this->authorize('branch.delete');
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
