<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function addSiswa(Request $request, UserService $userService)
    {
        $siswa = $userService->createSiswa($request);

        return response()->json([
            'status' => 'success',
            'siswa' => $siswa,
        ]);
    }

    public function getSiswaJson(UserService $userService)
    {
        $siswa = $userService->getAllUserWithEkskul();

        return response()->json($siswa);
    }
}
