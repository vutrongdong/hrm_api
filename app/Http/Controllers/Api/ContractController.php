<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Contracts\Contract;
use App\Repositories\Contracts\ContractRepository;
use App\Http\Transformers\ContractTransformer;

class ContractController extends ApiController
{
    protected $validationRules = [
        'title'     => 'required|unique:contracts,title',
        'status'    => 'in:',
    ];
    protected $validationMessages = [
        'title.required' => 'Tiêu đề hợp đồng không được để trống',
        'title.unique'   => 'Tiêu đề hợp đồng đã tồn tại trên hệ thống',
        'status.in'      => 'Trạng thái không hợp lệ',
    ];

    /**
     * ContractController constructor.
     * @param ContractRepository $Contract
     */
    public function __construct(ContractRepository $Contract)
    {
        $this->model = $Contract;
        $this->setTransformer(new ContractTransformer);
        $this->validationRules['status'] .= Contract::getAllStatus();
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        // $this->authorize('contract.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            // $this->authorize('contract.view');
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
            // $this->authorize('contract.create');
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
            // $this->authorize('contract.update');
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
            // $this->authorize('contract.delete');
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
