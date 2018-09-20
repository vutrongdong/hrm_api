<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use App\User;
use App\Http\Transformers\UserTransformer;

class UserController extends ApiController
{
    protected $validationRules = [
        'name'                          => 'required',
        'email'                         => 'required|email|unique:users,email',
        'password'                      => 'required|min:6|confirmed',
        'gender'                        => 'in:',
        'status'                        => 'in:',
        'departments'                   => 'array',
        'departments.*.department_id'   => 'exists:departments,id',
        'departments.*.position_id'     => 'exists:positions,id',
        'departments.*.status'          => 'in:',
    ];
    protected $validationMessages = [
        'name.required'                         => 'Tên không được để trông',
        'email.required'                        => 'Email không được để trông',
        'email.email'                           => 'Email không đúng định dạng',
        'email.unique'                          => 'Email đã tồn tại trên hệ thống',
        'password.required'                     => 'Mật khẩu không được để trống',
        'password.min'                          => 'Mật khẩu phải có ít nhât :min ký tự',
        'password.confirmed'                    => 'Nhập lại mật khẩu không đúng',
        'gender.in'                             => 'Giới tính không hợp lệ',
        'status.in'                             => 'Trạng thái không hợp lệ',
        'departments.array'                     => 'Phòng ban không hợp lệ',
        'departments.*.department_id.exists'    => 'Phòng ban không tồn tại trên hệ thống',
        'departments.*.position_id.exists'      => 'Chức vụ không tồn tại trên hệ thống',
        'departments.*.status.in'               => 'Trạng thái không hợp lệ',
    ];

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->model = $user;
        $this->setTransformer(new UserTransformer);
        $this->validationRules['gender'] .= User::getAllGender();
        $this->validationRules['status'] .= User::getAllStatus();
        $this->validationRules['departments.*.status'] .= User::getAllStatus();
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
        return $this->successResponse($this->model->getByQuery($request->all(), $pageSize));
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
            $this->authorize('user.create');
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

    public function update(Request $request, $id)
    {
        $this->validationRules['email'] .= ',' . $id;
        unset($this->validationRules['password']);
        
        try {
            $this->authorize('user.update');
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
        try {
            $this->authorize('user.delete');
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
