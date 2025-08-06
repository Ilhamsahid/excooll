<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

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
}