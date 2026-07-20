<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
// use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(AdminRequest $request): JsonResponse
    {
        $data = $request->validated();
        $admin = Admin::where('username', $data['username'])->first();

        if (!$admin) {
            return response()->json([
                "error" => [
                    "message" => ["Username Salah"]
                ]
            ], 404);
        }

        if(!Hash::check($data['password'],  $admin->password)){
            return response()->json([
                "error" => [
                    "message" => ["Password Salah"]
                ]
            ], 404);
        }

        DB::table('login_admin')->insert([
            'nama_admin' => $data['nama_admin'],
            'login_at' => now(),
        ]);

        // authentication successful
        return response()->json([
            'data' => [
                "message" => "login sukses",
            ],
            'message' => 'Login successful'
        ], 200);
    }
}
