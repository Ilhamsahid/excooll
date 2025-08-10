<?php

namespace Database\Seeders;

use App\Models\Ekskul;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;

class EkskulSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua pembina dari UserSeeder
        /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\User */
        $pembinas = User::where('role', 'pembina')->get()->keyBy('name');

        $activities = [
            [
                'nama' => 'Klub Basket',
                'deskripsi' => 'Bergabunglah dengan tim basket kompetitif kami dan tingkatkan keterampilan sambil bersenang-senang dengan rekan satu tim. Cocok untuk semua tingkat keterampilan!',
                'pembina' => 'Pelatih Johnson',
                'kategori' => 'olahraga'
            ],
            [
                'nama' => 'Komunitas Drama',
                'deskripsi' => 'Ekspresikan diri melalui akting, penyutradaraan, dan produksi panggung dalam komunitas drama yang dinamis. Lepaskan kreativitas Anda!',
                'pembina' => 'Ibu Anderson',
                'kategori' => 'seni'
            ],
            [
                'nama' => 'Olimpiade Sains',
                'deskripsi' => 'Berkompetisi dalam berbagai kompetisi sains dan jelajahi keajaiban penemuan ilmiah dengan sesama penggemar sains.',
                'pembina' => 'Dr. Smith',
                'kategori' => 'akademik'
            ],
            [
                'nama' => 'Klub Fotografi',
                'deskripsi' => 'Abadikan momen dan pelajari teknik fotografi profesional dengan sesama penggemar. Dari dasar hingga teknik lanjutan!',
                'pembina' => 'Pak Wilson',
                'kategori' => 'teknologi'
            ],
            [
                'nama' => 'Tim Debat',
                'deskripsi' => 'Kembangkan pemikiran kritis dan keterampilan berbicara di depan umum melalui debat kompetitif. Bangun kepercayaan diri dan artikulasikan ide Anda!',
                'pembina' => 'Ibu Davis',
                'kategori' => 'akademik'
            ],
            [
                'nama' => 'Band Musik',
                'deskripsi' => 'Ciptakan musik indah bersama dan tampil di acara sekolah dan kompetisi. Semua instrumen dan tingkat keterampilan diterima!',
                'pembina' => 'Pak Brown',
                'kategori' => 'seni'
            ],
            [
                'nama' => 'Klub Robotika',
                'deskripsi' => 'Bangun dan program robot untuk kompetisi nasional. Pelajari teknologi terdepan dan keterampilan engineering yang akan berguna di masa depan!',
                'pembina' => 'Dr. Tech',
                'kategori' => 'teknologi'
            ],
            [
                'nama' => 'Paduan Suara',
                'deskripsi' => 'Harmonisasi suara dalam berbagai genre musik. Dari klasik hingga kontemporer, temukan passion Anda dalam bernyanyi bersama!',
                'pembina' => 'Ibu Melody',
                'kategori' => 'seni'
            ],
            [
                'nama' => 'Klub Sastra',
                'deskripsi' => 'Eksplorasi dunia literatur melalui diskusi buku, penulisan kreatif, dan kompetisi puisi. Asah kemampuan berbahasa dan berpikir kritis!',
                'pembina' => 'Pak Penulis',
                'kategori' => 'seni'
            ],
            [
                'nama' => 'Tim Futsal',
                'deskripsi' => 'Olahraga tim yang menantang dengan strategi cepat dan keterampilan teknis tinggi. Bergabunglah dengan tim futsal terbaik sekolah!',
                'pembina' => 'Pelatih Bola',
                'kategori' => 'olahraga'
            ],
            [
                'nama' => 'Klub Lingkungan',
                'deskripsi' => 'Peduli lingkungan melalui aksi nyata! Kampanye go green, penanaman pohon, dan edukasi lingkungan untuk masa depan yang berkelanjutan.',
                'pembina' => 'Ibu Green',
                'kategori' => 'sosial'
            ],
            [
                'nama' => 'Klub Bahasa Inggris',
                'deskripsi' => 'Tingkatkan kemampuan bahasa Inggris melalui conversation club, drama, dan kompetisi speech. Gateway to global opportunities!',
                'pembina' => 'Mr. English',
                'kategori' => 'sosial'
            ],
            [
                'nama' => 'Klub Matematika',
                'deskripsi' => 'Jelajahi keindahan matematika melalui olimpiade, problem solving, dan aplikasi matematika dalam kehidupan sehari-hari.',
                'pembina' => 'Dr. Math',
                'kategori' => 'akademik'
            ],
            [
                'nama' => 'Klub Tari Tradisional',
                'deskripsi' => 'Lestarikan budaya Indonesia melalui tarian tradisional dari berbagai daerah. Tampil di berbagai acara budaya dan kompetisi!',
                'pembina' => 'Ibu Budaya',
                'kategori' => 'seni'
            ],
            [
                'nama' => 'Klub Jurnalistik',
                'deskripsi' => 'Liputi berita sekolah, wawancara tokoh, dan tulis artikel menarik untuk majalah sekolah. Asah kemampuan menulis dan komunikasi!',
                'pembina' => 'Pak Wartawan',
                'kategori' => 'sosial'
            ],
        ];

        foreach ($activities as $activity) {
            Ekskul::create([
                'nama' => $activity['nama'],
                'deskripsi' => $activity['deskripsi'],
                'pembina_id' => $pembinas[$activity['pembina']]->id,
                'kategori' => $activity['kategori'],
            ]);
        }
    }
}
