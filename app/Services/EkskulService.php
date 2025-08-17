<?php

namespace App\Services;

use App\Repositories\Contracts\EkskulRepositoryInterface;
use Illuminate\Http\Request;

class EkskulService
{
    protected EkskulRepositoryInterface $repository;

    public function __construct(EkskulRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function getAllWithCount()
    {
        return $this->repository->getAllWithPembinaAndCount();
    }

    public function getAllUserWithEkskulPending()
    {
        return $this->repository->getAllStudentWithPending();
    }

    public function getEkskulByEkskulUser($ekskulId)
    {
        return $this->repository->getEkskulByEkskulIdFromUser($ekskulId);
    }

    public function getEkskulAllWithRelation()
    {
        return $this->repository->getAllEkskulWithRelation();
    }

    public function createEkskul(Request $request)
    {
        $ekskul = $this->repository->createEkskul([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'pembina_id' => $request->pembina,
            'status' => 'aktif',
        ])->fresh();

        $this->repository->createClubSchedule([
            'ekskul_id' => $ekskul->getKey(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'lokasi' => $request->lokasi
        ]);

        return $ekskul;
    }
}