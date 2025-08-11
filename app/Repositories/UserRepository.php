<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function getAllStudentWithRelation()
    {
        return User::with(['ekskuls', 'siswaProfile'])->where('role', 'siswa')->get();
    }
    public function getAllPembina(){
        return User::with('pembinaProfile', 'ekskulDibina')->where('role', 'pembina')->get();
    }

    public function getUserWithEkskul()
    {
        return User::with('ekskuls', 'siswaProfile')->where('id', Auth::user()->id)->first() ?? '';
    }

    public function getUserWithEkskulApproved()
    {
        return User::with([
            'ekskuls' => function ($q) {
                $q->wherePivot('status', 'diterima');
        }, 'siswaProfile'])
        ->where('id', Auth::user()->id)
        ->first() ?? '';
    }

    public function createUser($arr){
        return User::create($arr);
    }

    public function cekUserStudentWithEmail($request, $id)
    {
        return User::where(function ($query) use ($request) {
                    $query->where('name', $request->studentName)
                        ->orWhere('email', $request->studentEmail);
                })
                ->where('id', '!=', $id) // ID user yang sedang diedit, dikecualikan
                ->first();
    }

    public function cekUserWithEmail($request)
    {
        return User::where('email', $request->email);
    }
}