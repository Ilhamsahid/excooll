<?php

namespace App\Http\Controllers;

use App\Services\PengumumanService;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function addPengumuman(Request $request, PengumumanService $pengumumanService)
    {
        $pengumuman = $pengumumanService->addPengumuman($request->only([
            'ekskul_id', 'isi', 'judul', 'tanggal', 'tipe', 'lokasi'
        ]));

        return response()->json( [
            'status' => 'success',
            'data' => $pengumuman,
        ]);
    }

    public function getPengumumanJson(PengumumanService $pengumumanService)
    {
        $pengumuman = $pengumumanService->getAll();

        return response()->json($pengumuman);
    }
}
