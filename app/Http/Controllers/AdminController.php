<?php

namespace App\Http\Controllers;

use App\Services\EkskulService;
use App\Services\PengumumanService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(EkskulService $ekskulService, UserService $userService, PengumumanService $pengumumanService)
    {
        $ekstra = $ekskulService->getEkskulAllWithRelation();
        $siswa = $userService->getAllUserWithEkskul();
        $pendaftaran = $ekskulService->getAllUserWithEkskulPending();
        $kelas = $userService->getKelas();
        $pengumuman = $pengumumanService->getAll();
        $pembina = $userService->getAllPembina();
        $pengguna = $userService->getAllUser();

        return view('admin.main', compact('ekstra', 'siswa', 'pendaftaran', 'kelas', 'pengumuman', 'pembina', 'pengguna'));
    }
}