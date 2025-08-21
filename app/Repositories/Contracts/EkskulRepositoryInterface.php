<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface EkskulRepositoryInterface
{
    public function getAllEkskulWithRelation(): collection;
    public function getAllWithPembinaAndCount(): collection;
    public function getAllStudentWithPending();
    public function getEkskulByEkskulIdFromUser($ekskulId): collection;
    public function findEkskulById($id);
    public function createEkskul($arr);
    public function updateEkskul($ekskul, $arr);
    public function deleteEkskul($ekskul);
    public function createClubSchedule($arr);
    public function updateClubSchedule($ekskulId, $arr);
}