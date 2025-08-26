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

        return response()->json([
            'status' => 'success',
            'request' => $user,
        ]);
    }

    public function update(Request $request, UserService $userService) 
    {
        $user = $userService->updateUser($request->only([
            'id', 'name', 'email', 'password', 'role', 'status', 'nisn'
        ]));

        return response()->json([
            'status' => 'success',
            'request' => $user
        ]);
    }

    public function destroy(Request $request, UserService $userService)
    {
        $user = $userService->deleteUser($request->id);

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    public function getUserJson(UserService $userService)
    {
        $user = $userService->getAllUser();

        return response()->json($user);
    }
}
