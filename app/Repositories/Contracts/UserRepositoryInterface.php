<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAllStudentWithRelation();
    public function getAllPembina();
    public function getUserWithEkskul();
    public function getUserWithEkskulApproved();
    public function getAllUserWithEkskul();
    public function cekUserStudentWithEmail($request, $id);
    public function cekUserWithEmail($request);
    public function createUser($arr);
    public function createPembinaProfile($arr);
    public function createSiswaProfile($arr);
    public function updateUser($user, $arr);
    public function updateSiswaProfile($id, $arr);
    public function updatePembinaProfile($id, $arr);
    public function findUserById($id);
}