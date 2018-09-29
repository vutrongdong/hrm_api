<?php

namespace App\Http\Controllers\Api;

use DB;
use Illuminate\Http\Request;
use App\Repositories\Plans\Plan;
use App\Repositories\Plans\PlanRepository;
use App\Http\Transformers\PlanTransformer;

class PlanController extends ApiController
{
    protected $validationRules = [
        'title'                     => 'required|unique:plans,title',
        'date_start'                => 'date|before:date_end',
        'date_end'                  => 'date',
        'status'                    => 'in:',
        'details'                   => 'array',
        'details.*.department_id'   => 'required|exists:departments,id',
        'details.*.position_id'     => 'required|exists:positions,id',
        'details.*.quantity'        => 'required|digits_between:1,2',
    ];
    protected $validationMessages = [
        'title.required'                        => 'Tiêu đề không được để trống',
        'title.unique'                          => 'Tiêu đề đã tồn tại trên hệ thống',
        'date_start.date_format'                => 'Ngày bắt đầu không hợp lệ',
        'date_start.before'                     => 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc',
        'date_end.date_format'                  => 'Ngày kết thúc không hợp lệ',
        'status.in'                             => 'Trạng thái không hợp lệ',

        'details.*.department_id.required'      => 'Phòng ban không được để trống',
        'details.*.department_id.exists'        => 'Phòng ban không tồn tại trên hệ thống',
        'details.*.position_id.required'        => 'Chức vụ không được để trống',
        'details.*.position_id.exists'          => 'Chức vụ không tồn tại trên hệ thống',
        'details.*.quantity.required'           => 'Số lượng tuyển không được để trống',
        'details.*.quantity.digits_between'     => 'Số lượng tuyển không hợp lệ',
    ];

    /**
     * PlanController constructor.
     * @param PlanRepository $plan
     */
    public function __construct(PlanRepository $plan)
    {
        $this->plan = $plan;
        $this->setTransformer(new PlanTransformer);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $this->authorize('plan.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->plan->getByQuery($request->all(), $pageSize));
    }

    public function show($id)
    {
        try {
            $this->authorize('plan.view');
            return $this->successResponse($this->plan->getById($id));
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
        $this->validationRules['status'] .= $this->plan->getAllStatus();
        DB::beginTransaction();
        try {
            $this->authorize('plan.create');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->plan->store($request->all());
            DB::commit();
            return $this->successResponse($data);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            DB::rollback();
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }

    public function update($id, Request $request)
    {
        $this->validationRules['title'] .= ',' . $id;
        $this->validationRules['status'] .= $this->plan->getAllStatus();
        DB::beginTransaction();
        try {
            $this->authorize('plan.update');
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->plan->update($id, $request->all());
            DB::commit();
            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            DB::rollback();
            return $this    ->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $this->authorize('plan.delete');
            $this->plan->delete($id);
            DB::commit();
            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $t) {
            DB::rollback();
            throw $t;
        }
    }
}
