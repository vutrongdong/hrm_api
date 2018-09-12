<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Branches\BranchRepository;

class BranchController extends ApiController
{
    /**
     * BranchController constructor.
     * @param BranchRepository $branch
     */
    public function __construct(BranchRepository $branch)
    {
        $this->model = $branch;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
}
