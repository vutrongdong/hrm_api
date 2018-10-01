<?php

namespace App\Http\Controllers\Api;

use DB;
use Illuminate\Http\Request;
use App\Repositories\Users\UserRepository;
use App\Repositories\Contracts\ContractRepository;
use App\Http\Transformers\UserTransformer;
use App\Rules\DateExpirationRule;

class UserController extends ApiController
{
    protected $validationRules = [
        'name'                          => 'required',
        'email'                         => 'required|email|unique:users,email',
        'phone'                         => 'nullable|digits_between:10,12',
        'date_of_birth'                 => 'nullable|date',
        'password'                      => 'required|min:6|confirmed',
        'gender'                        => 'in:',
        'status'                        => 'in:',

        'departments'                   => 'array',
        'departments.*.department_id'   => 'required|exists:departments,id',
        'departments.*.position_id'     => 'required|exists:positions,id',
        'departments.*.status'          => 'in:',

        // 'contracts.title'             => 'required',
        // 'contracts.type'              => 'in:',
        // 'contracts.date_sign'         => 'required|date',
        // 'contracts.date_effective'    => 'required|date',
        // 'contracts.status'            => 'in:',
    ];
    protected $validationMessages = [
        'name.required'                         => 'Tên không được để trông',
        'email.required'                        => 'Email không được để trông',
        'email.email'                           => 'Email không đúng định dạng',
        'email.unique'                          => 'Email đã tồn tại trên hệ thống',
        'phone.digits_between'                  => 'Số điện thoại không hợp lệ',
        'date_of_birth.date'                    => 'Ngày sinh không hợp lệ',
        'password.required'                     => 'Mật khẩu không được để trống',
        'password.min'                          => 'Mật khẩu phải có ít nhât :min ký tự',
        'password.confirmed'                    => 'Nhập lại mật khẩu không đúng',
        'gender.in'                             => 'Giới tính không hợp lệ',
        'status.in'                             => 'Trạng thái không hợp lệ',

        'departments.array'                     => 'Phòng ban không hợp lệ',
        'departments.*.department_id.required'  => 'Phòng ban không được để trông',
        'departments.*.department_id.exists'    => 'Phòng ban không tồn tại trên hệ thống',
        'departments.*.position_id.required'    => 'Chức vụ không được để trông',
        'departments.*.position_id.exists'      => 'Chức vụ không tồn tại trên hệ thống',
        'departments.*.status.in'               => 'Trạng thái không hợp lệ',

        // 'contracts.title.required'            => 'Tiêu đề hợp đồng không được để trống',
        // 'contracts.type.in'                   => 'Loại hợp đồng không hợp lệ',
        // 'contracts.date_sign.required'        => 'Ngày ký không được để trống',
        // 'contracts.date_sign.date'            => 'Ngày ký không hợp lệ',
        // 'contracts.date_effective.required'   => 'Ngày có hiệu lực không được để trống',
        // 'contracts.date_effective.date'       => 'Ngày có hiệu lực không hợp lệ',
        // 'contracts.status.in'                 => 'Trạng thái không hợp lệ',
    ];

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->setTransformer(new UserTransformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('user.view');
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->user->getByQuery($request->all(), $pageSize));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $this->authorize('user.view');
            return $this->successResponse($this->user->getById($id));
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
        $this->validationRules['gender'] .= $this->user->getAllGender();
        $this->validationRules['status'] .= $this->user->getAllStatus();
        $this->validationRules['departments.*.status'] .= $this->user->getAllStatus();
        // $this->validationRules['contracts.type'] .= app()->make(ContractRepository::class)->getAllType();
        // $this->validationRules['contracts.status'] .= app()->make(ContractRepository::class)->getAllStatus();
        DB::beginTransaction();
        try {
            $this->authorize('user.create');
            // $this->validate($request, [
            //     'contracts.date_expiration' => new DateExpirationRule($request->contract['date_sign'], $request->contract['date_effective'])
            // ]);
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->user->store($request->all());
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

    public function update(Request $request, $id)
    {
        $this->validationRules['email'] .= ',' . $id;
        $this->validationRules['gender'] .= $this->user->getAllGender();
        $this->validationRules['status'] .= $this->user->getAllStatus();
        $this->validationRules['departments.*.status'] .= $this->user->getAllStatus();
        // $this->validationRules['contracts.type'] .= app()->make(ContractRepository::class)->getAllType();
        // $this->validationRules['contracts.status'] .= app()->make(ContractRepository::class)->getAllStatus();
        unset($this->validationRules['password']);
        DB::beginTransaction();
        try {
            $this->authorize('user.update');
            // $this->validate($request, [
            //     'contracts.date_expiration' => new DateExpirationRule($request->contract['date_sign'], $request->contract['date_effective'])
            // ]);
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->user->update($id, $request->all());
            DB::commit();
            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
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
        try {
            $this->authorize('user.delete');
            $this->user->delete($id);
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
