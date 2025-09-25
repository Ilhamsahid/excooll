<?php

namespace App\Repositories;

use App\Models\Kegiatan;
use App\Repositories\Contracts\ActivitiesRepositoryInterface;
use Illuminate\Support\Collection;

class ActivitiesRepository implements ActivitiesRepositoryInterface
{
    public function getRecentActivitiesAll(): Collection
    {
        return Kegiatan::with(['ekskul'])->get();
    }

    public function getActivitiesByEkskul($ekskulId): Collection
    {
        return Kegiatan::where('ekskul_id', $ekskulId)
            ->orderBy('id', 'desc')->get();
    }

    public function createActivity($data)
    {
        return Kegiatan::create($data);
    }

    public function updateActivity($id, array $data)
    {
        $activity = Kegiatan::find($id);

        if($activity){
            $activity->update($data);
            return $activity;
        }

        return null;
    }

    public function deleteActivity($id)
    {
        $activity = Kegiatan::find($id);

        if($activity){
            return $activity->delete();
        }

        return false;
    }   
}