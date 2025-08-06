<?php

namespace App\Http\Controllers;

use App\Models\Nisn;
use App\Models\SiswaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
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
            'message' => 'Logout berhasil'
        ]);
    }

    public function register(Request $request, UserService $userService)
    {
        $cekNisn = Nisn::where('nisn', $request->nisn)->first();

        if(!$cekNisn){
            return response()->json([
                'status' => 'nisnError',
                'message' => 'NISN ini tidak ditemukan.',
            ]);
        }

        if(SiswaProfile::where('nisn', $request->nisn)->first()){
            return response()->json([
                'status' => 'nisnError',
                'message' => 'Nisn ini sudah dipakai oleh siswa tertentu',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'siswa',
            'password' => Hash::make($request->password),
        ]);

        SiswaProfile::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn,
        ]);

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil',
            'user' => $userService->getUserWithEkskul(),
        ]);
    }
}