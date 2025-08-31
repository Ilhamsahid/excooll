<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
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

        return response()->json([
            'status' => 'success',
            'pembina' => $pembina,
        ]);
    }

    public function update(Request $request, UserService $userService)
    {
        $pembina = $userService->updatePembina($request->only([
            'id', 'nama', 'email', 'status', 'no_tel', 'deskripsi', 'alamat'
        ]));

        return response()->json([
            'status' => 'success',
            'pembina' => $pembina,
        ]);
    }

    public function destroy(Request $request, UserService $userService)
    {
        $pembina = $userService->deleteUser($request->id);

        return response()->json([
            'status' => 'success',
            'request' => $pembina,
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
