<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request, UserService $userService)
    {
        $user = $userService->createNewUser($request->only([
            'name', 'email', 'password', 'role', 'status', 'nisn'
        ]));

        $user->load(['pembinaProfile', 'siswaProfile', 'ekskulDibina', 'ekskuls']);

        return response()->json([
            'status' => 'success',
            'item' => $user,
        ]);
    }

    public function update(Request $request, UserService $userService) 
    {
        try{
            $user = $userService->updateUser($request->only([
                'id', 'name', 'email', 'password', 'role', 'status', 'nisn'
            ]));

            $user->load(['pembinaProfile', 'ekskuls', 'siswaProfile', 'ekskulDibina']);

            return response()->json([
                'status' => 'success',
                'item' => $user
            ]);
        }catch(\Throwable $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request, UserService $userService)
    {
        $user = $userService->deleteUser($request->id);

        $user->load(['pembinaProfile', 'siswaProfile', 'ekskulDibina', 'ekskuls']);

        return response()->json([
            'status' => 'success',
            'item' => $user,
        ]);
    }

    public function getUserJson(UserService $userService)
    {
        $user = $userService->getAllUser();

        return response()->json($user);
    }
}
