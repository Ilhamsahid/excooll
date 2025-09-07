<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function store(Request $request, UserService $userService)
    {
        $siswa = $userService->createSiswa($request);

        $siswa->load(['ekskuls', 'siswaProfile']);

        return response()->json([
            'status' => 'success',
            'item' => $siswa,
        ]);
    }

    public function update(Request $request, UserService $userService)
    {
        $siswa = $userService->updateSiswa($request->only([
            'id', 'nama', 'email', 'kelas', 'nisn', 'no_tel', 'j_kel', 'alamat'
        ]));

        $siswa->load(['ekskuls', 'siswaProfile']);

        return response()->json([
            'status' => 'success',
            'item' => $siswa,
        ]);
    }

    public function destroy(Request $request, UserService $userService)
    {
        $siswa = $userService->deleteUser($request->id);

        return response()->json([
            'status' => 'success',
            'item' => $siswa,
        ]);
    }

    public function getSiswaJson(UserService $userService)
    {
        $siswa = $userService->getAllUserWithEkskul();

        return response()->json($siswa);
    }
}
