<?php

namespace Database\Seeders;

use App\Models\Ekskul;
use App\Models\Nisn;
use App\Models\SiswaProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisKelamin = ['laki-laki', 'perempuan'];
        $nisn = Nisn::all();
        $ekskuls = Ekskul::all();
        $siswaList = User::factory()->count(200)->create();

        foreach($siswaList as $index => $siswa){
            $nisnItem = $nisn[$index];
            $jumlahEks = rand(1, 3);
            $ranJenisKelamin = rand(0, 1);
            $ekskulRandom = $ekskuls->random($jumlahEks)->pluck('id');

            SiswaProfile::create([
                'user_id' => $siswa->id,
                'nisn' => $nisnItem->nisn,
                'jenis_kelamin' => $jenisKelamin[$ranJenisKelamin]
            ]);

            $siswa->ekskuls()->attach($ekskulRandom);
        }
    }
}
