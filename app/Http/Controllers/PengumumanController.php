<?php

namespace App\Http\Controllers;

use App\Services\PengumumanService;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function store(Request $request, PengumumanService $pengumumanService)
    {
        $pengumuman = $pengumumanService->addPengumuman($request->only([
            'ekskul_id', 'isi', 'judul', 'tanggal', 'tipe', 'lokasi'
        ]));

        return response()->json( [
            'status' => 'success',
            'data' => $pengumuman,
        ]);
    }

    public function update(Request $request, PengumumanService $pengumumanService)
    {
        $announc = $pengumumanService->updatePengumuman($request->only([
            'id', 'ekskul_id', 'judul', 'isi', 'tipe', 'tanggal', 'lokasi'
        ]));

        return response()->json([
            'status' => 'success',
            'announc' => $announc,
        ]);
    }

    public function getPengumumanJson(PengumumanService $pengumumanService)
    {
        $pengumuman = $pengumumanService->getAll();

        return response()->json($pengumuman);
    }
}
