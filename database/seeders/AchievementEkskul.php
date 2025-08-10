<?php

namespace Database\Seeders;

use App\Models\ClubAchievement;
use App\Models\Ekskul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementEkskul extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskuls = Ekskul::all();

        for($i = 0; $i < 30; $i++){
            $ekskulrandom = $ekskuls->random();

            ClubAchievement::create([
                'ekskul_id' => $ekskulrandom->id,
                'deskripsi' => 'ini dummy',
                'tahun' => '2020'
            ]);
        }
    }
}
