<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PengumumanRepositoryInterface
{
    public function getAllWithEkskul(): collection;
    public function createAnnouncement($arr);
}