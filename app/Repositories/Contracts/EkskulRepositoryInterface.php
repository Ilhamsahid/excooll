<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface EkskulRepositoryInterface
{
    public function getAllEkskulWithRelation(): collection;
    public function getAllWithPembinaAndCount(): collection;
    public function getAllStudentWithPending();
    public function getEkskulByEkskulIdFromUser($ekskulId): collection;
}