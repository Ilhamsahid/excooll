<?php

namespace App\Repositories;

use App\Models\PembinaProfile;
use App\Models\SiswaProfile;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAllStudentWithRelation()
    {
        return User::with(['ekskuls', 'siswaProfile'])->where('role', 'siswa')->get();
    }
    public function getAllPembina(){
        return User::with('pembinaProfile', 'ekskulDibina')->where('role', 'pembina')->orderBy('id', 'desc')->get();
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

    public function getAllUserWithEkskul()
    {
        return User::with('ekskuls', 'siswaProfile')
        ->where('role', 'siswa')
        ->orderBy('id', 'desc')
        ->get();
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
        return User::where('email', $request->email)->first();
    }

    public function createUser($arr){
        return User::create($arr);
    }

    public function updateUser($user, $arr){
        $user->update($arr);
        return $user;
    }

    public function updateSiswaProfile($id, $arr)
    {
        $siswaProfile = SiswaProfile::where('user_id', $id)->first();

        if($siswaProfile){
            $siswaProfile->update($arr);
            return $siswaProfile;
        }
        return null;
    }

    public function updatePembinaProfile($id, $arr)
    {
        $pembinaProfile = PembinaProfile::where('user_id', $id)->first();
        if($pembinaProfile){
            $pembinaProfile->update($arr);
            return $pembinaProfile;
        }
        return null;
    }

    public function createPembinaProfile($arr)
    {
        return PembinaProfile::create($arr);
    }

    public function createSiswaProfile($arr)
    {
        return SiswaProfile::create($arr);
    }

    public function findUserById($id)
    {
        return User::find($id);
    }
}