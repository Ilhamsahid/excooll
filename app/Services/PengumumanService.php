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

    public function getAnnouncEkskul($id)
    {
        return $this->repository->getAnnouncEkskul($id);
    }

    public function addPengumuman($data)
    {
        $announcement =  $this->repository->createAnnouncement([
            'ekskul_id' => $data['ekskul_id'],
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'tipe' => $data['tipe'],
            'lokasi' => $data['lokasi'],
            'tanggal_pengumuman' => $data['tanggal'],
        ]);

        return $announcement;
    }

    public function updatePengumuman($data)
    {
        $announc = $this->repository->findAnnouncById($data['id']);

        $this->repository->updateAnnouncement($announc, [
            'ekskul_id' => $data['ekskul_id'],
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'tipe' => $data['tipe'],
            'tanggal_pengumuman' => $data['tanggal'],
            'lokasi' => $data['lokasi'],
        ]);

        return $announc;
    }

    public function deleteAnnounc($id)
    {
        $announc = $this->repository->findAnnouncById($id);

        $this->repository->deleteAnnouncement($announc);

        return $announc;
    }
}