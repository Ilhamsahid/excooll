<?php

namespace Database\Seeders;

use App\Models\Nisn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NisnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 201; $i++){
            Nisn::create([
                'nisn' => str_pad($i, 10, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
