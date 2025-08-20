<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function store(Request $request, UserService $userService)
    {
        $siswa = $userService->createSiswa($request);

        return response()->json([
            'status' => 'success',
            'siswa' => $siswa,
        ]);
    }

    public function update(Request $request, UserService $userService)
    {
        $siswa = $userService->updateSiswa($request->only([
            'id', 'nama', 'email', 'kelas', 'nisn', 'no_tel', 'j_kel', 'alamat'
        ]));

        return response()->json([
            'status' => 'success',
            'data' => $siswa,
        ]);
    }

    public function getSiswaJson(UserService $userService)
    {
        $siswa = $userService->getAllUserWithEkskul();

        return response()->json($siswa);
    }
}
