<?php

namespace App\Http\Controllers;

use App\Services\EkskulService;
use App\Services\PengumumanService;
use App\Services\UserService;

class AdminController extends Controller
{
    public function index(EkskulService $ekskulService, UserService $userService, PengumumanService $pengumumanService)
    {
        $ekstra = $ekskulService->getEkskulAllWithRelation();
        $siswa = $userService->getAllUserWithEkskulApproved();
        $pendaftaran = $ekskulService->getAllUserWithEkskulPending();
        $kelas = $userService->getKelas();
        $pengumuman = $pengumumanService->getAll();
        $pembina = $userService->getAllPembina();

        return view('admin.main', compact('ekstra', 'siswa', 'pendaftaran', 'kelas', 'pengumuman', 'pembina'));
    }
}