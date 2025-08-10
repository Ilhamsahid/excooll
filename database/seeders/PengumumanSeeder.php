<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'ekskul_id' => 1, // Klub Basket
                'judul' => "Pendaftaran Turnamen Basket Dibuka",
                'isi' => "Pendaftaran untuk turnamen basket antar sekolah tahunan sekarang dibuka. Ini adalah kesempatan bagus untuk menunjukkan keterampilan dan mewakili sekolah kita. Daftar sebelum 15 Maret!",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-01",
            ],
            [
                'ekskul_id' => 2, // Komunitas Drama
                'judul' => "Pertunjukan Musim Semi Komunitas Drama",
                'isi' => "Bergabunglah dengan kami untuk pertunjukan musim semi yang spektakuler 'Romeo dan Juliet' pada 20 April di auditorium sekolah. Tiket tersedia di kantor utama.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-05",
            ],
            [
                'ekskul_id' => 3, // Olimpiade Sains
                'judul' => "Workshop Persiapan Pameran Sains",
                'isi' => "Workshop wajib untuk semua anggota Olimpiade Sains pada 12 Maret untuk mempersiapkan pameran sains regional yang akan datang. Bawa ide proyek Anda!",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-08",
            ],
            [
                'ekskul_id' => 4, // Klub Fotografi
                'judul' => "Pameran Fotografi",
                'isi' => "Kirimkan foto terbaik Anda untuk pameran fotografi tahunan kami. Tema: 'Kehidupan di Sekolah'. Batas waktu pengiriman: 25 Maret.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-10",
            ],
            [
                'ekskul_id' => 7, // Klub Robotika
                'judul' => "Kompetisi Robotika Nasional",
                'isi' => "Tim robotika sekolah akan mengikuti kompetisi nasional bulan depan. Dukungan dan doa dari seluruh warga sekolah sangat diharapkan!",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-12",
            ],
            [
                'ekskul_id' => 6, // Band Musik
                'judul' => "Konser Paduan Suara",
                'isi' => "Paduan suara akan mengadakan konser amal untuk membantu korban bencana alam. Tiket dapat dibeli di sekretariat sekolah mulai hari ini.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-14",
            ],
            [
                'ekskul_id' => 9, // Klub Seni
                'judul' => "Lomba Puisi Tingkat Provinsi",
                'isi' => "Anggota klub sastra terpilih akan mewakili sekolah dalam lomba puisi tingkat provinsi. Persiapan intensif dimulai minggu depan.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-16",
            ],
            [
                'ekskul_id' => 10, // Tim Futsal
                'judul' => "Turnamen Futsal Antar Kelas",
                'isi' => "Turnamen futsal antar kelas akan dimulai bulan depan. Setiap kelas dapat mendaftarkan satu tim. Hadiah menarik menanti pemenang!",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-18",
            ],
            [
                'ekskul_id' => 11, // Klub Lingkungan
                'judul' => "Aksi Penanaman Pohon",
                'isi' => "Klub lingkungan mengajak seluruh warga sekolah untuk berpartisipasi dalam aksi penanaman 1000 pohon di area sekolah dan sekitarnya.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-20",
            ],
            [
                'ekskul_id' => 12, // Klub Bahasa Inggris
                'judul' => "English Speech Contest",
                'isi' => "Kompetisi pidato bahasa Inggris tingkat sekolah akan diadakan bulan depan. Pendaftaran dibuka untuk semua siswa yang berminat.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-22",
            ],
            [
                'ekskul_id' => 13, // Klub Matematika
                'judul' => "Olimpiade Matematika Regional",
                'isi' => "Tim olimpiade matematika berhasil lolos ke tingkat regional. Persiapan intensif dan bimbingan khusus akan diberikan kepada peserta.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-24",
            ],
            [
                'ekskul_id' => 14, // Klub Tari Tradisional
                'judul' => "Festival Tari Nusantara",
                'isi' => "Klub tari tradisional akan tampil dalam Festival Tari Nusantara tingkat kota. Latihan tambahan akan diadakan setiap hari Sabtu.",
                'tipe' => 'wajib',
                'tanggal_pengumuman' => "2024-03-26",
            ],
        ];

        foreach($announcements as $announcement){
            Pengumuman::create([
                'ekskul_id' => $announcement['ekskul_id'],
                'judul' => $announcement['judul'],
                'isi' => $announcement['isi'],
                'tipe' => $announcement['tipe'],
                'tanggal_pengumuman' => $announcement['tanggal_pengumuman']
            ]);
        }
    }
}
