<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $entry = User::create($request->only(['name', 'email', 'password']));

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
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilkan data pengguna.',
                'data'    => User::findOrFail($id)
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
    public function update(UserRequest $request, string $id)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengubah data pengguna.',
                'data'    => User::findOrFail($id)->update($request->only(['name', 'email', 'password']))
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
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data pengguna.',
                'data'    => User::findOrFail($id)->delete()
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
