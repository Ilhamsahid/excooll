<?php

namespace App\Services;

use App\Repositories\Contracts\SchedulesRepositoryInterface;
use Carbon\Carbon;

class SchedulesService
{
    protected SchedulesRepositoryInterface $repository;

    public function __construct(SchedulesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getSchedulesEkskul($id)
    {
        return $this->repository->getSchedulesEkskul($id);
    }

    public function createClubSchedules($data)
    {
        $data['hari'] = Carbon::parse($data['tanggal'])->locale('id')->translatedFormat('l');
        return $this->repository->createSchedules($data);
    }

    public function updateClubSchedule($tanggal, $data)
    {
        $data['hari'] = Carbon::parse($data['tanggal'])->locale('id')->translatedFormat('l');
        return $this->repository->updateSchedules($tanggal, $data);
    }

    public function deleteClubSchedule($id)
    {
        return $this->repository->deleteSchedules($id);
    }
}