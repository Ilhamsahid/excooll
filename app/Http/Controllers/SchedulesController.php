<?php

namespace App\Http\Controllers;

use App\Services\SchedulesService;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function store(Request $request, SchedulesService $schedulesService)
    {
        $schedule = $schedulesService->createClubSchedules($request->only([
            'ekskul_id', 'judul', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi'
        ]));

        return response()->json([
            'status' => 'success',
            'item' => $schedule,
        ]);
    }
}
