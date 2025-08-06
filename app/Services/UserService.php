<?php

namespace App\Services;

use App\Models\Nisn;
use App\Models\SiswaProfile;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService 
{
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUserWithEkskul()
    {
        return $this->repository->getUserWithEkskul();
    }

    public function createUser(Request $request){
        $data = $request->only(['name', 'email', 'password']);
        $data['role'] = 'siswa';
        $data['password'] = Hash::make($data['password']);

        return $this->repository->createUser($data);
    }

    public function registerNewSiswa(Request $request){
        $cekNisn = Nisn::where('nisn', $request->nisn)->first();

        if(!$cekNisn){
            throw new \Exception('NISN ini tidak ditemukan.');
        }

        if(SiswaProfile::where('nisn', $request->nisn)->first()){
            throw new \Exception('NISN ini sudah dipakai oleh siswa tertentu.');
        }

        $user = $this->createUser($request);

        SiswaProfile::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn,
        ]);

        return $user;
    }
}