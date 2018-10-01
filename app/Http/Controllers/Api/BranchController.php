<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Branches\Branch;
use App\Repositories\Branches\BranchRepository;
use App\Http\Transformers\BranchTransformer;

class BranchController extends ApiController
{
    protected $validationRules = [
        'name'        => 'required',
        'address'     => 'required',
        'phone'       => 'digits_between:10,12',
        'tax_number'  => 'required|unique:branches,tax_number',
        'email'       => 'required|email|unique:branches,email',
        'city_id'     => 'exists:cities,id',
        'district_id' => 'exists:districts,id',
        'type'        => 'boolean',
        'status'      => 'in:',
    ];

    protected $validationMessages = [
        'name.required'        => 'Tên không được để trống',
        'address.required'     => 'Địa chỉ không được để trống',
        'phone.digits_between' => 'Số điện thoại không hợp lệ',
        'tax_number.required'  => 'Mã số thuế không được để trống',
        'tax_number.unique'    => 'Mã số thuế đã tồn tại trên hệ thống',
        'email.required'       => 'Email không được để trông',
        'email.email'          => 'Email không đúng định dạng',
        'email.unique'         => 'Email đã tồn tại trên hệ thống',
        'city_id.exists'       => 'Thành phố không tồn tại trên hệ thống',
        'district_id.exists'   => 'Quận-Huyện không tồn tại trên hệ thống',
        'type.boolean'         => 'Loại chi nhánh không hợp lệ',
        'status.in'            => 'Trạng thái không hợp lệ',
    ];

    protected $branchStatus;

    /**
     * BranchController constructor.
     * @param BranchRepository $branch
     */
    public function __construct(BranchRepository $branch)
    {
        $this->branch = $branch;
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
        return $this->successResponse($this->branch->getByQuery($request->all(), $pageSize));
    }

    public function changeStatus($id)
    {
        try {
            $model = $this->branch->changeStatus($id);

            return $this->successResponse(['data' => ['message' => 'Cập nhật trạng thái thành công']], false);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
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

    public function show($id)
    {
        try {
            $this->authorize('branch.view');
            return $this->successResponse($this->branch->getById($id));
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
        $this->validationRules['status'] .= $this->branch->getAllStatus();
        try {
            $this->authorize('branch.create');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->branch->store($request->all());

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
        $this->validationRules['email'] .= ',' . $id;
        $this->validationRules['status'] .= $this->branch->getAllStatus();
        try {
            $this->authorize('branch.update');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->branch->update($id, $request->all());

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
            $this->branch->delete($id);

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
