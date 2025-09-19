<?php

namespace App\Services;

use App\Repositories\Contracts\SchedulesRepositoryInterface;

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
}