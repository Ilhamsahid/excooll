<?php

namespace Database\Seeders;

use App\Models\ClubSchedule;
use App\Models\Ekskul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalEkskul extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskul = Ekskul::all();
        $data = [
            ['hari' => 'senin', 'jam_mulai' => '15:00', 'jam_selesai' => '16:30', 'lokasi' => 'Gor SMK'],
            ['hari' => 'selasa', 'jam_mulai' => '15:20', 'jam_selesai' => '17:00', 'lokasi' => 'Kelas X RPL 2'],
            ['hari' => 'rabu', 'jam_mulai' => '14:00', 'jam_selesai' => '15:30', 'lokasi' => 'Kelas Biologi'],
            ['hari' => 'kamis', 'jam_mulai' => '15:00', 'jam_selesai' => '16:00', 'lokasi' => 'Ruangan Perpus'],
            ['hari' => 'jumat', 'jam_mulai' => '15:20', 'jam_selesai' => '17:00', 'lokasi' => 'Lapangan Basket'],
            ['hari' => 'sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '11:00', 'lokasi' => 'Studio Musik'],
            ['hari' => 'senin', 'jam_mulai' => '16:00', 'jam_selesai' => '17:30', 'lokasi' => 'Lab Komputer'],
            ['hari' => 'selasa', 'jam_mulai' => '14:30', 'jam_selesai' => '16:00', 'lokasi' => 'Aula Sekolah'],
            ['hari' => 'rabu', 'jam_mulai' => '15:00', 'jam_selesai' => '16:30', 'lokasi' => 'Lapangan Voli'],
            ['hari' => 'kamis', 'jam_mulai' => '13:30', 'jam_selesai' => '15:00', 'lokasi' => 'Ruangan Seni'],
            ['hari' => 'jumat', 'jam_mulai' => '14:00', 'jam_selesai' => '15:30', 'lokasi' => 'Kelas Bahasa'],
            ['hari' => 'sabtu', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'lokasi' => 'Lab Fisika'],
            ['hari' => 'senin', 'jam_mulai' => '15:30', 'jam_selesai' => '17:00', 'lokasi' => 'Ruang Meeting'],
            ['hari' => 'selasa', 'jam_mulai' => '16:00', 'jam_selesai' => '17:30', 'lokasi' => 'Lapangan Sepak Bola'],
            ['hari' => 'rabu', 'jam_mulai' => '14:00', 'jam_selesai' => '15:30', 'lokasi' => 'Kelas Kimia'],
        ];

        foreach($ekskul as $index => $eks){
            ClubSchedule::create([
                'ekskul_id' => $eks->id,
                'hari' => $data[$index]['hari'],
                'jam_mulai' => $data[$index]['jam_mulai'],
                'jam_selesai' => $data[$index]['jam_selesai'],
                'lokasi' => $data[$index]['lokasi'],
            ]);
        }
    }
}
