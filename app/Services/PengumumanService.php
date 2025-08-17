<?php

namespace App\Services;

use App\Repositories\Contracts\PengumumanRepositoryInterface;

class PengumumanService
{
    protected PengumumanRepositoryInterface $repository;

    public function __construct(PengumumanRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAllWithEkskul();
    }

    public function addPengumuman($data)
    {
        $announcement =  $this->repository->createAnnouncement([
            'ekskul_id' => $data['ekskul_id'],
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'tipe' => $data['tipe'],
            'tanggal_pengumuman' => $data['tanggal'],
        ]);

        return $announcement;
    }
}