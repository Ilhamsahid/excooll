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

    public function getAllPembinaWithoutEkskul(){
        $pembinaAll = User::with(['pembinaProfile', 'ekskulDibina' ])->where('role', 'pembina')->orderBy('id', 'desc')->get();
        $pembinaP = [];

        foreach($pembinaAll as $pembina){
            if(!$pembina->ekskulDibina->count()){
                $pembinaP[] = $pembina;
            }
        }

        return $pembinaP;
    }

    public function getAllUser()
    {
        return User::with('siswaProfile')->orderBy('id', 'desc')->get();
    }

    public function getUserWithEkskul()
    {
        return User::with('ekskuls', 'siswaProfile', 'ekskulDibina')->where('id', Auth::user()->id)->first() ?? '';
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

    public function getUserNow($id)
    {
        return User::with(['ekskuLDibina', 'pembinaProfile', 'siswaProfile', 'ekskuls'])->where('id', $id)->first();
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
        if(empty($arr['password'])){
            unset($arr['password']);
        }else{
            $arr['password'] = Hash::make($arr['password']);
        }
        $user->update($arr);
        return $user;
    }

    public function updateSiswaProfile($id, $arr)
    {
        $siswaProfile = $this->findSiswaProfileByIdUser($id);

        if($siswaProfile){
            $siswaProfile->update($arr);
            return $siswaProfile;
        }
        return null;
    }

    public function findSiswaProfileByIdUser($id)
    {
        return SiswaProfile::where('user_id', $id)->first();
    }

    public function updatePembinaProfile($id, $arr)
    {
        $pembinaProfile = $this->findPembinaProfileByIdUser($id);
        if($pembinaProfile){
            $pembinaProfile->update($arr);
            return $pembinaProfile;
        }
        return null;
    }

    public function findPembinaProfileByIdUser($id)
    {
        return PembinaProfile::where('user_id', $id)->first();
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

    public function deleteUser($user)
    {
        return $user->delete();
    }
}