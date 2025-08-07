<?php

namespace App\Http\Controllers;

use App\Models\Nisn;
use App\Models\SiswaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Services\EkskulService;
use App\Services\UserService;

class AuthController extends Controller
{
    public function login(Request $request, UserService $userService)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'user' => $userService->getUserWithEkskul()
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email atau password salah'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil',
        ]);
    }

    public function register(Request $request, UserService $userService)
    {
        try{
            $user = $userService->registerNewSiswa($request);

            Auth::login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Registrasi berhasil',
                'user' => $userService->getUserWithEkskul(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'nisnError',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}