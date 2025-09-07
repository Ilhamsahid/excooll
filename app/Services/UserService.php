<?php

namespace App\Services;

use App\Models\Nisn;
use App\Models\PembinaProfile;
use App\Models\SiswaProfile;
use Illuminate\Support\Facades\Log;
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

    public function getUserWithEkskulApproved()
    {
        return $this->repository->getUserWithEkskulApproved();
    }

    public function getAllUserWithEkskulApproved()
    {
        return $this->repository->getUserWithEkskul();
    }

    public function getAllUserWithEkskul()
    {
        return $this->repository->getAllUserWithEkskul();
    }

    public function getAllPembina()
    {
        return $this->repository->getAllPembina();
    }

    public function getAllPembinaWithoutEkskul()
    {
        return $this->repository->getAllPembinaWithoutEkskul();
    }

    public function getAllUser()
    {
        return $this->repository->getAllUser();
    }

    public function createUser(Request $request){
        $data = $request->only(['name', 'email', 'password']);
        $data['role'] = 'siswa';
        $data['password'] = Hash::make($data['password']);

        return $this->repository->createUser($data);
    }

    public function updateUser($data)
    {
        $user = $this->repository->findUserById($data['id']);

        $this->repository->updateUser($user, [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
            'status' => $data['status'],
        ]);

        $user = $this->repository->findUserById($data['id']);

        if($user->role === 'siswa'){
            if(!$this->repository->findSiswaProfileByIdUser($user->id)){
                $this->repository->createSiswaProfile([
                    'user_id' => $user->id,
                    'nisn' => $data['nisn'],
                ]);
            }
            $this->repository->updateSiswaProfile($user->id, [
                'nisn' => $data['nisn'],
                'jenis_kelamin' => $user->pembinaProfile?->jenis_kelamin ?? null,
                'no_telephone' => $user->pembinaProfile?->no_telephone ?? null,
                'alamat' => $user->pembinaProfile?->alamat ?? null,
            ]);
        }

        if($user->role === 'pembina'){
            if($user->ekskuls()){
                $user->ekskuls()->detach();
            }

            if(!$this->repository->findPembinaProfileByIdUser($user->id)){
                $this->repository->createPembinaProfile([
                    'user_id' => $user->id,
                ]);
            }

            $this->repository->updatePembinaProfile($user->id, [
                'jenis_kelamin' => $user->siswaProfile?->jenis_kelamin ?? null,
                'no_telephone' => $user->siswaProfile?->no_telephone ?? null,
                'alamat' => $user->siswaProfile?->alamat ?? null,
            ]);
        }

        return $user;
    }

    public function createNewUser($data)
    {
        $user = $this->repository->createUser([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'status' => $data['status'],
        ]);

        if($user->role == 'siswa'){
            SiswaProfile::create([
                'user_id' => $user->id,
                'nisn' => $data['nisn']
            ]);
        }

        if($user->role == 'pembina'){
            $this->repository->createPembinaProfile([
                'user_id' => $user->id
            ]);
        }

        return $user;
    }

    public function createPembina(Request $request)
    {
        $pembina = $this->repository->createUser([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => 'pembina',
            'status' => $request->status,
        ]);

        $this->repository->createPembinaProfile([
            'user_id' => $pembina->id,
            'deskripsi' => $request->deskripsi,
            'no_telephone' => $request->no_tel,
            'alamat' => $request->alamat,
        ]);

        return $pembina;
    }

    public function createSiswa(Request $request)
    {
        $siswa = $this->repository->createUser([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'status' => 'aktif',
        ]);

        $this->repository->createSiswaProfile([
            'user_id' => $siswa->id,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->j_kel,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_tel,
        ]);

        return $siswa;
    }

    public function updateSiswa($data)
    {
        $siswa = $this->repository->findUserById($data['id']);

        $this->repository->updateUser($siswa, [
            'name' => $data['nama'],
            'email' => $data['email'],
        ]);

        $this->repository->updateSiswaProfile($siswa->id, [
            'nisn' => $data['nisn'],
            'jenis_kelamin' => $data['j_kel'],
            'kelas' => $data['kelas'],
            'no_telephone' => $data['no_tel'],
            'alamat' => $data['alamat'],
        ]);

        return $siswa;
    }

    public function updatePembina($data)
    {
        $siswa = $this->repository->findUserById($data['id']);

        $this->repository->updateUser($siswa, [
            'name' => $data['nama'],
            'email' => $data['email'],
            'status' => $data['status'],
        ]);

        $this->repository->updatePembinaProfile($siswa->id,[
            'no_telephone' => $data['no_tel'],
            'deskripsi' => $data['deskripsi'],
            'alamat' => $data['alamat'],
        ]);

        return $siswa;
    }

    public function deleteUser($id)
    {
        $user = $this->repository->findUserById($id);
        $user->delete();

        return $user;
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

    public function getAllStudent()
    {
        return $this->repository->getAllStudentWithRelation();
    }

    public function getKelas(){
        $kelas = ['X', 'XI', 'XII'];
        $jurusan = ['RPL', 'BD', 'MP', 'LP', 'AK'];
        $jumlahKelas = [2, 4, 4, 2, 3];

        $kelasList = [];
        for ($i = 0; $i < count($kelas); $i++) {
            for ($j = 0; $j < count($jurusan); $j++) {
                for ($k = 0; $k < $jumlahKelas[$j]; $k++) {
                    $kelasList[] = "{$kelas[$i]} {$jurusan[$j]} " . ($k + 1);
                }
            }
        }

        return $kelasList;
    }
}