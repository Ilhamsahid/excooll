<?php

namespace App\Http\Controllers;

use App\Services\ActivitiesService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function store(Request $request, ActivitiesService $activitiesService)
    {
        $data = $activitiesService->createActivity($request->only([
            'ekskul_id', 'judul', 'deskripsi', 'jam_mulai', 'jam_selesai', 'tanggal', 'lokasi', 'status'
        ]));

        return response()->json([
            'status' => 'success',
            'item' => $data,
        ]);
    }

    public function update(Request $request, ActivitiesService $activitiesService)
    {
        $data = $activitiesService->updateActivity($request->id, $request->only([
            'ekskul_id', 'judul', 'deskripsi', 'jam_mulai', 'jam_selesai', 'tanggal', 'lokasi', 'status'
        ]));

        return response()->json([
            'status' => 'success',
            'item' => $data,
        ]);
    }

    public function destroy(Request $request, ActivitiesService $activitiesService)
    {
        $data = $activitiesService->deleteActivity($request->id);

        return response()->json([
            'status' => 'success',
            'item' => $data,
        ]);
    }
}