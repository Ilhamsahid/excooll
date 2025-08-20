<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    public function getPembinaJson(UserService $userService)
    {
        $pembina = $userService->getAllPembina();

        return response()->json($pembina);
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
}
