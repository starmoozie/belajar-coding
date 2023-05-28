<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected $model;
    protected $request;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = $this->model->all();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil ambil data pengguna.',
            'data'    => $entries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $request = app($this->request);
        $model   = new $this->model;
        $entry   = $model->create($request->only(['name', 'email', 'password']));

        return response()->json([
            'success' => true,
            'message' => 'Berhasil simpan data pengguna.',
            'data'    => $entry
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $model = new $this->model;
            $entry = $model->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilkan data pengguna.',
                'data'    => $entry
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Data {$id} tidak ditemukan.",
                'data'    => null
            ]);
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

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengubah data pengguna.',
                'data'    => $entry
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Data {$id} tidak ditemukan.",
                'data'    => null
            ]);
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

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data pengguna.',
                'data'    => null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Data {$id} tidak ditemukan.",
                'data'    => null
            ]);
        }
    }
}
