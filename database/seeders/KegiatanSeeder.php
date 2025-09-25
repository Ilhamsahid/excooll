<?php

namespace Database\Seeders;

use App\Models\Ekskul;
use App\Models\Kegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskuls = Ekskul::orderBy('id')->get();

        $kegiatanList = [
                        [
                'judul' => 'Latihan Rutin Basket',
                'deskripsi' => 'Latihan fisik dan strategi untuk persiapan turnamen antar sekolah.',
                'tanggal' => '2025-08-01',
            ],
            [
                'judul' => 'Pertunjukan Drama Sekolah',
                'deskripsi' => 'Pagelaran drama tahunan dengan tema sosial budaya.',
                'tanggal' => '2025-08-05',
            ],
            [
                'judul' => 'Kompetisi Olimpiade Sains',
                'deskripsi' => 'Seleksi siswa untuk lomba Olimpiade Sains tingkat kota.',
                'tanggal' => '2025-08-10',
            ],
            [
                'judul' => 'Workshop Fotografi',
                'deskripsi' => 'Pelatihan teknik fotografi outdoor bersama fotografer profesional.',
                'tanggal' => '2025-08-12',
            ],
            [
                'judul' => 'Debat Persiapan Kompetisi',
                'deskripsi' => 'Latihan debat formal dengan simulasi lomba.',
                'tanggal' => '2025-08-15',
            ],
            [
                'judul' => 'Konser Mini Band Musik',
                'deskripsi' => 'Penampilan band sekolah di acara peringatan kemerdekaan.',
                'tanggal' => '2025-08-17',
            ],
            [
                'judul' => 'Lomba Robotika Nasional',
                'deskripsi' => 'Persiapan dan seleksi untuk lomba robotika tingkat nasional.',
                'tanggal' => '2025-08-20',
            ],
            [
                'judul' => 'Pentas Paduan Suara',
                'deskripsi' => 'Penampilan paduan suara sekolah di acara musik tahunan.',
                'tanggal' => '2025-08-22',
            ],
            [
                'judul' => 'Diskusi Buku Sastra',
                'deskripsi' => 'Diskusi buku puisi dan novel terbaru dengan anggota klub sastra.',
                'tanggal' => '2025-08-25',
            ],
            [
                'judul' => 'Pertandingan Futsal Antar Sekolah',
                'deskripsi' => 'Turnamen futsal antar sekolah di kota.',
                'tanggal' => '2025-08-27',
            ],
            [
                'judul' => 'Kegiatan Go Green',
                'deskripsi' => 'Kampanye menanam pohon dan peduli lingkungan di sekolah.',
                'tanggal' => '2025-08-30',
            ],
            [
                'judul' => 'Lomba Speech Bahasa Inggris',
                'deskripsi' => 'Kompetisi public speaking untuk meningkatkan kemampuan bahasa Inggris.',
                'tanggal' => '2025-09-01',
            ],
            [
                'judul' => 'Kompetisi Olimpiade Matematika',
                'deskripsi' => 'Seleksi siswa untuk kompetisi matematika tingkat kota.',
                'tanggal' => '2025-09-03',
            ],
            [
                'judul' => 'Pentas Tari Tradisional',
                'deskripsi' => 'Tampil di acara budaya dengan tarian tradisional daerah.',
                'tanggal' => '2025-09-05',
            ],
            [
                'judul' => 'Workshop Jurnalistik',
                'deskripsi' => 'Pelatihan menulis artikel dan wawancara untuk majalah sekolah.',
                'tanggal' => '2025-09-07',
            ],
        ];

        foreach($kegiatanList as $index => $kegiatan){
            $ekskul = $ekskuls[$index];
            Kegiatan::create([
                'ekskul_id' => $ekskul->id,
                'judul' => $kegiatan['judul'],
                'deskripsi' => $kegiatan['deskripsi'],
                'tanggal' => $kegiatan['tanggal'],
            ]);
        }
    }
}
