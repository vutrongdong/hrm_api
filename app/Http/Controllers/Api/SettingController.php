<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Settings\SettingRepository;

class SettingController extends ApiController
{
    /**
     * SettingController constructor.
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->model = $setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
