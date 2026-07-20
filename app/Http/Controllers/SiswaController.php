<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json([
            'Daftar' => SiswaResource::collection($siswa)
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaRequest $request)
    {
        $data = $request->validated();
        $siswa = Siswa::create($data);

        return response()->json([
            "message" => "berhasil Absen",
            "data" => new SiswaResource($siswa),
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $siswa = Siswa::find($id);

        if(!$siswa) {
            return response()->json([
                "error" => "data tidak ditemukan"
            ], 404);
        }

        return response()->json([
                "data" => new SiswaResource($siswa)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, string $id)
    {
        $siswa = Siswa::find($id);
        if(!$siswa) {
            return response()->json([
                "error" => "siswa tidak ditemukan!",
            ],404);
        }

        $data = $request->validated();
        $siswa->update($data);

        return response()->json([
            "message" => "berhasil ubah data siswa",
            "data" => new SiswaResource($siswa),
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
        if(!$siswa) {
            return response()->json([
                "error" => "siswa tidak ditemukan!",
            ],404);
        }

        $siswa->delete();

         return response()->json([
            "message" => "berhasil hapus data siswa",
        ],200);
    }
}
