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

    public function update(Request $request, SchedulesService $schedulesService)
    {
        $schedule = $schedulesService->updateClubSchedule($request->only('id'), $request->only([
            'id', 'ekskul_id', 'judul', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi'
        ]));

        return response()->json($schedule);
    }

    public function destroy(Request $request, SchedulesService $schedulesService)
    {
        $schedule = $schedulesService->deleteClubSchedule($request->only('id'));
        return response()->json([
            'status' => 'success',
        ]);
    }
}
