<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Contracts\Contract;
use App\Repositories\Contracts\ContractRepository;
use App\Http\Transformers\ContractTransformer;
use App\Rules\DateExpirationRule;


class ContractController extends ApiController
{
    protected $validationRules = [
        'title'             => 'required',
        'type'              => 'in:',
        'user_id'           => 'required|exists:users,id',
        'date_sign'         => 'required|date',
        'date_effective'    => 'required|date',
        'status'            => 'in:',
    ];
    protected $validationMessages = [
        'title.required'            => 'Tiêu đề hợp đồng không được để trống',
        'type.in'                   => 'Loại hợp đồng không hợp lệ',
        'user_id.required'          => 'Tên nhân viên không được để trống',
        'user_id.exists'            => 'Nhân viên không tồn tại trên hệ thống',
        'date_sign.required'        => 'Ngày ký không được để trống',
        'date_sign.date'            => 'Ngày ký không hợp lệ',
        'date_effective.required'   => 'Ngày có hiệu lực không được để trống',
        'date_effective.date'       => 'Ngày có hiệu lực không hợp lệ',
        'status.in'                 => 'Trạng thái không hợp lệ',
    ];

    /**
     * ContractController constructor.
     * @param ContractRepository $Contract
     */
    public function __construct(ContractRepository $contract)
    {
        $this->contract = $contract;
        $this->setTransformer(new ContractTransformer);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $this->authorize('contract.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->contract->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            $this->authorize('contract.view');
            return $this->successResponse($this->contract->getById($id));
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
        $this->validationRules['status'] .= $this->contract->getAllStatus();
        $this->validationRules['type'] .= $this->contract->getAllType();
        try {
            $this->authorize('contract.create');
            $this->validate($request, [
                'date_expiration' => new DateExpirationRule($request->date_sign, $request->date_effective)
            ]);
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->contract->store($request->all());

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
        $this->validationRules['status'] .= $this->contract->getAllStatus();
        $this->validationRules['type'] .= $this->contract->getAllType();
        try {
            $this->authorize('contract.update');
            $this->validate($request, [
                'date_expiration' => new DateExpirationRule($request->date_sign, $request->date_effective)
            ]);
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->contract->update($id, $request->all());
            
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
            $this->authorize('contract.delete');
            $this->contract->delete($id);

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
