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
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $request = app($this->request);
        $model   = new $this->model;

        $entry   = $model->create($request->validated());

        $this->syncMenu($entry, $request->menu);

        return $this->successMessage(new $this->resource($entry));
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
            $entry->update($request->only(['name']));

            $this->syncMenu($entry, $request->menu);

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
            $entry = $model->findOrFail($id);

            // Handle if role already used by user
            if ($entry->user->count()) {
                $current_page = request()->segment(2);

                return $this->failsMessage(__('message.already_used', ['attribute' => "{$current_page} {$entry->name}"]));
            }

            $entry->delete();

            return $this->successMessage(null);
        } catch (\Throwable $th) {
            return $this->failsMessage();
        }
    }

    /**
     * Handle sync many to many ( menu )
     */
    public function syncMenu($entry, $menu): void
    {
        $entry->menu()->sync(array_column($menu, 'id'));
    }
}
