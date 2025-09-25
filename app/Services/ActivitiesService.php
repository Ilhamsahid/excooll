<?php

namespace App\Services;

use App\Repositories\Contracts\ActivitiesRepositoryInterface;

class ActivitiesService
{
    protected ActivitiesRepositoryInterface $repository;

    public function __construct(ActivitiesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getRecentActivitiesAll();
    }

    public function getActivitiesByEkskul($ekskulId)
    {
        return $this->repository->getActivitiesByEkskul($ekskulId);
    }

    public function createActivity(array $data)
    {
        return $this->repository->createActivity($data);
    }

    public function updateActivity($id, array $data)
    {
        return $this->repository->updateActivity($id, $data);
    }

    public function deleteActivity($id)
    {
        return $this->repository->deleteActivity($id);
    }
}