<?php

namespace App\Repositories;

use App\Models\ClubSchedule;
use App\Repositories\Contracts\SchedulesRepositoryInterface;

class SchedulesRepository implements SchedulesRepositoryInterface
{
    public function getSchedulesEkskul($id)
    {
        return ClubSchedule::where('ekskul_id', $id)->get();
    }

    public function createSchedules($arr)
    {
        return ClubSchedule::create($arr);
    }
}