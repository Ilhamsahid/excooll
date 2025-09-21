<?php

namespace App\Repositories\Contracts;

interface SchedulesRepositoryInterface
{
    function getSchedulesEkskul($id);
    function createSchedules($arr);
    function updateSchedules($id, $arr);
    function deleteSchedules($id);
}