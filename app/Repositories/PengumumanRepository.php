<?php

namespace App\Repositories;

use App\Models\Pengumuman;
use App\Repositories\Contracts\PengumumanRepositoryInterface;
use Illuminate\Support\Collection;

class PengumumanRepository implements PengumumanRepositoryInterface
{
    public function getAllWithEkskul(): Collection{
        return Pengumuman::with('ekskul')->orderBy('id', 'desc')->get();
    }

    public function createAnnouncement($arr)
    {
        return Pengumuman::create($arr);
    }
}