<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Candidates\Candidate;
use App\Repositories\Candidates\CandidateRepository;
use App\Http\Transformers\CandidateTransformer;

class CandidateController extends ApiController
{
    protected $validationRules = [
        'name'             => 'required',
        'email'            => 'email|unique:candidates,email',
        'status'           => 'in:',
        'interview_by'     => 'array',
        'interview_by'     => 'exists:users,id',
    ];
    protected $validationMessages = [
        'name.required'             => 'Tên ứng viên không được để trống',
        'email.email'               => 'Email không đúng định dạng',
        'email.unique'              => 'Email đã tồn tại trên hệ thống',
        'status.in'                 => 'Trạng thái không hợp lệ',
        'interview_by.array'        => 'Người phỏng vấn không hợp lệ',
        'interview_by.exists'       => 'Người phỏng vấn không tồn tại trên hệ thống',
    ];

    /**
     * PlanController constructor.
     * @param PlanRepository $plan
     */
    public function __construct(CandidateRepository $plan)
    {
        $this->model = $plan;
        $this->setTransformer(new CandidateTransformer);
        $this->validationRules['status'] .= Candidate::getAllStatus();
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $this->authorize('candidate.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            $this->authorize('candidate.view');
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
            $this->authorize('candidate.create');
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
        $this->validationRules['email'] .= ',' . $id;
        try {
            $this->authorize('candidate.update');
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
            $this->authorize('candidate.delete');
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
