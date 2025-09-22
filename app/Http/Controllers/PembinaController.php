<?php

namespace App\Http\Controllers;

use App\Services\SchedulesService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembinaController extends Controller
{

    public function index(UserService $userService, SchedulesService $schedulesService)
    {
        $path = request()->path();
        $lastSegment = collect(explode('/', $path))->last();

        $sections = [
            "dashboard",
            "profile",
            "calendar",
            "attendance",
            "activities",
            "announcements",
            "students",
            "applications",
        ];

        if(!in_array($lastSegment, $sections)){
            abort(404);
        }

        $pembina = $userService->getUserNow(Auth::user()->id);
        $ekskulSchedules = $schedulesService->getSchedulesEkskul($pembina->ekskulDibina[0]->id);
        $siswa = $userService->getAllSiswaEkskul($pembina->ekskulDibina[0]->id);
        $getKelas = $userService->getKelas();

        return view('pembina.main', compact('pembina', 'ekskulSchedules', 'siswa', 'getKelas'));
    }

    public function store(UserService $userService, Request $request)
    {
        $pembina = $userService->createPembina($request);
        
        if(!$pembina)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'error',
            ]);
        }

        $pembina->load(['ekskulDibina', 'pembinaProfile']);

        return response()->json([
            'status' => 'success',
            'item' => $pembina,
        ]);
    }

    public function update(Request $request, UserService $userService)
    {
        $pembina = $userService->updatePembina($request->only([
            'id', 'nama', 'email', 'status', 'no_tel', 'deskripsi', 'alamat', 'jenis_kelamin'
        ]));

        $pembina->load(['ekskulDibina', 'pembinaProfile']);

        return response()->json([
            'status' => 'success',
            'item' => $pembina,
        ]);
    }

    public function destroy(Request $request, UserService $userService)
    {
        $pembina = $userService->deleteUser($request->id);

        $pembina->load(['ekskulDibina', 'pembinaProfile']);

        return response()->json([
            'status' => 'success',
            'item' => $pembina,
        ]);
    }

    public function getPembinaJson(UserService $userService)
    {
        $pembina = $userService->getAllPembina();

        return response()->json($pembina);
    }

    public function getPembinaWithoutEkskulJson(UserService $userService)
    {
        $pembina = $userService->getAllPembinaWithoutEkskul();

        return response()->json($pembina);
    }
}
