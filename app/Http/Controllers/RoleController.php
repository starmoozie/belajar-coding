<?php

namespace App\Http\Controllers;

use App\Models\Role as Model;
use App\Http\Requests\RoleRequest as Request;
use App\Http\Resources\Role\Resources;
use App\Http\Resources\Role\Collections;

class RoleController extends BaseController
{
    protected $model      = Model::class;
    protected $request    = Request::class;
    protected $resource   = Resources::class;
    protected $collection = Collections::class;

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        try {
            $request = app($this->request);

            $model   = new $this->model;

            $entry   = $model->findOrFail($id);
            $entry->update($request->only(['name']));

            // Sync relationship
            $entry->menu()->sync(array_column($request->menu, 'id'));

            return $this->successMessage(new $this->resource($entry));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $is_empty_message = empty($th->getMessage());

            // Handle error validation message
            if ($is_empty_message) {
                return $th->getResponse()->original;
            }

            return $this->failsMessage();
        }
    }
}
