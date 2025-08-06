<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface EkskulRepositoryInterface
{
    public function getAllWithPembinaAndCount(): collection;
    public function getEkskulByEkskulIdFromUser($ekskulId): collection;
}