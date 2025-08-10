<?php

namespace App\Http\Controllers;

use App\Services\EkskulService;
use App\Services\PengumumanService;
use App\Services\UserService;

class AdminController extends Controller
{
    public function index(EkskulService $ekskulService, UserService $userService)
    {
        $ekstra = $ekskulService->getEkskulAllWithRelation();
        $siswa = $userService->getAllStudent();
        $kelas = $userService->getKelas();

        return view('admin.main', compact('ekstra', 'siswa', 'kelas'));
    }

    public function pengumuman(PengumumanService $pengumumanService)
    {
        $pengumuman = $pengumumanService->getAll();

        return response()->json(['data' => $pengumuman]);
    }
}
