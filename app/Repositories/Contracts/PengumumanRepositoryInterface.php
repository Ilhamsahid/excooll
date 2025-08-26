<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PengumumanRepositoryInterface
{
    public function getAllWithEkskul(): collection;
    public function createAnnouncement($arr);
    public function updateAnnouncement($announc, $arr);
    public function deleteAnnouncement($announc);
    public function findAnnouncById($id);
}