<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function getUserWithEkskul()
    {
        return User::with('ekskuls', 'siswaProfile')->where('id', Auth::user()->id)->first() ?? '';
    }
}