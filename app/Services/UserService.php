<?php

namespace App\Services;

use App\Models\Nisn;
use App\Models\SiswaProfile;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $cekEmail = $this->repository->cekUserWithEmail($request);

        if(!$cekNisn){
            throw new \Exception('NISN ini tidak ditemukan.');
        }

        if($cekEmail){
            throw new \Exception('Email Sudah Digunakan');
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

    public function addSiswaProfile(Request $request, $user){
        $user->update([
            'name' => $request->studentName,
            'email' => $request->studentEmail,
        ]);

        $user->save();

        $siswaProfile = SiswaProfile::where('user_id', $user->id)->first();

        $siswaProfile->update([
            'kelas' => $request->studentClass,
            'alamat' => $request->studentAddress,
            'jenis_kelamin' => $request->studentGender,
            'no_telephone'=> $request->studentTelephone
        ]);

        $siswaProfile->save();
    }

    public function cekUserStudentWithEmail(Request $request, $id)
    {
        return $this->repository->cekUserStudentWithEmail($request, $id);
    }
}