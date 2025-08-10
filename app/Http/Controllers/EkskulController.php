<?php

namespace App\Http\Controllers;

use App\Services\EkskulService;
use App\Services\UserService;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function joinEkskul(Request $request, UserService $userService)
    {
        $user = $userService->getUserWithEkskul();
        $cekUserOrEmail = $userService->cekUserStudentWithEmail($request, $user->id);

        if($cekUserOrEmail){
            return response()->json([
                'status'=> 'error',
                'title' => 'Data sudah digunakan',
                'message' => 'Email atau nama yang Anda masukkan sudah digunakan oleh pengguna lain. Silakan gunakan email atau nama yang berbeda.',
            ]);
        }

        if ($user->ekskuls->count() >= 3){
            return response()->json([
                'status'=> 'error',
                'title' => 'Batas Maksimal Ekskul',
                'message' => 'Anda tidak bisa bergabung dengan ekskul ini, dikarenakan anda sudah bergabung ke 3 ekskul',
            ]);
        }

        $user->ekskuls()->attach($request->ekskulId, ['alasan' => $request->whyJoin]);

        $userService->addSiswaProfile($request, $user);

        $user->load(['ekskuls', 'siswaProfile']);

        return response()->json(['status' => 'success', 'user' => $user]);
    }
}