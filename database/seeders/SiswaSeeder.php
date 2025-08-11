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
        $kelasAll = $this->getkelas(
            ["X", "XI", "XII"],
            ["RPL", "BD", "MP", "AK", "LP"],
            [2, 4, 4, 3, 2]
        );
        $nisn = Nisn::all();
        $ekskuls = Ekskul::all();
        $siswaList = User::factory()->count(200)->create();

        foreach($siswaList as $index => $siswa){
            $nisnItem = $nisn[$index];
            $jumlahEks = rand(1, 3);
            $ranJenisKelamin = rand(0, 1);
            $ranKelas = rand(0, count($kelasAll) - 1);
            $ekskulRandom = $ekskuls->random($jumlahEks)->pluck('id');

            SiswaProfile::create([
                'user_id' => $siswa->id,
                'nisn' => $nisnItem->nisn,
                'jenis_kelamin' => $jenisKelamin[$ranJenisKelamin],
                'kelas' => $kelasAll[$ranKelas],
            ]);

            $siswa->ekskuls()->attach($ekskulRandom, ['status' => 'diterima']);
        }
    }

    public function getKelas($kelas, $jurusan, $jumlahKelas)
    {
        $arr = [];

        for ($i = 0; $i < count($kelas); $i++){
            for ($j = 0; $j < count($jurusan); $j++){
                for($k = 0; $k < $jumlahKelas[$j]; $k++){
                    $arr[] = $kelas[$i] . ' ' . $jurusan[$j] . ' ' . ($k + 1);
                }
            }
        }

        return $arr;
    }
}
