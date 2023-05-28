<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    use \App\Traits\ResponseMessage;

    protected $model;
    protected $request;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model   = new $this->model;
        $entries = $model->all();

        return $this->successMessage(
            'Berhasil ambil data pengguna.',
            $entries
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $request = app($this->request);
        $model   = new $this->model;

        $entry   = $model->create($request->only(['name', 'email', 'password']));

        return $this->successMessage(
            'Berhasil simpan data pengguna.',
            $entry
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $model = new $this->model;
            $entry = $model->findOrFail($id);

            return $this->successMessage(
                'Berhasil menampilkan data pengguna.',
                $entry
            );
        } catch (\Throwable $th) {
            return $this->failsMessage("Data {$id} tidak ditemukan.");
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

            $entry   = $model->findOrFail($id)
                ->update($request->only(['name', 'email', 'password']));

            return $this->successMessage(
                'Berhasil mengubah data pengguna.',
                $entry
            );
        } catch (\Throwable $th) {
            $is_empty_message = empty($th->getMessage());

            // Handle error validation message
            if ($is_empty_message) {
                return $th->getResponse()->original;
            }

            return $this->failsMessage("Data {$id} tidak ditemukan.");
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

            return $this->successMessage(
                'Berhasil menghapus data pengguna.',
                $entry
            );
        } catch (\Throwable $th) {
            return $this->failsMessage("Data {$id} tidak ditemukan.");
        }
    }
}
