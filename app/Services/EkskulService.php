<?php

namespace App\Services;

use App\Repositories\Contracts\EkskulRepositoryInterface;

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
}