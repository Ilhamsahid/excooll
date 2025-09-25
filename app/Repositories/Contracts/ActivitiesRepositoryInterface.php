<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ActivitiesRepositoryInterface
{
    public function getRecentActivitiesAll(): collection;
    public function getActivitiesByEkskul($ekskulId): collection;
    public function createActivity(array $data);
    public function updateActivity($id, array $data);
    public function deleteActivity($id);
}