<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    use \App\Traits\ResponseMessage;

    protected $model;
    protected $request;
    protected $resource;
    protected $collection;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model   = new $this->model;
        $entries = $model->all();

        return $this->successMessage(new $this->collection($entries));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $request = app($this->request);
        $model   = new $this->model;

        $entry   = $model->create($request->only(['name', 'email', 'password']));

        return $this->successMessage(new $this->resource($entry));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $model = new $this->model;
            $entry = $model->findOrFail($id);

            return $this->successMessage(new $this->resource($entry));
        } catch (\Throwable $th) {
            return $this->failsMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        try {
            $request = app($this->request);
            $model   = new $this->model;

            $entry   = $model->findOrFail($id);
            $entry->update($request->only(['name', 'email', 'password', 'role_id']));

            return $this->successMessage(new $this->resource($entry));
        } catch (\Throwable $th) {
            $is_empty_message = empty($th->getMessage());

            // Handle error validation message
            if ($is_empty_message) {
                return $th->getResponse()->original;
            }

            return $this->failsMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = new $this->model;
            $entry = $model->findOrFail($id)->delete();

            return $this->successMessage(null);
        } catch (\Throwable $th) {
            return $this->failsMessage();
        }
    }
}
