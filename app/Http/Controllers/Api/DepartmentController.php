<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Departments\DepartmentRepository;

class DepartmentController extends ApiController
{
    /**
     * DepartmentController constructor.
     * @param DepartmentRepository $department
     */
    public function __construct(DepartmentRepository $department)
    {
        $this->model = $department;
    }

    public function index()
    {
        return $this->model->getAll();
    }

    public function show($id)
    {
        return $this->model->getById($id);
    }

    public function store(Request $request)
    {
        return $this->model->store($request->all());
    }

    public function update($id, Request $request)
    {
        try{
            return $this->model->update($id, $request->all());
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

    public function getByBranch(Request $request, $cID)
    {
        return $this->model->getByBranch($cID);
    }
}
