<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAllStudentWithRelation();
    public function getAllPembina();
    public function getUserWithEkskul();
    public function getUserWithEkskulApproved();
    public function getAllUserWithEkskulApproved();
    public function cekUserStudentWithEmail($request, $id);
    public function cekUserWithEmail($request);
    public function createUser($arr);
    public function createPembina($request);
}