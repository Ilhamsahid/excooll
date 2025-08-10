<?php

namespace Database\Seeders;

use App\Models\PembinaProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PembinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_kelamin = ['laki-laki', 'perempuan'];
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $pembinas = [
            ['name' => 'Pelatih Johnson', 'email' => 'johnson@example.com'],
            ['name' => 'Ibu Anderson',    'email' => 'anderson@example.com'],
            ['name' => 'Dr. Smith',       'email' => 'smith@example.com'],
            ['name' => 'Pak Wilson',      'email' => 'wilson@example.com'],
            ['name' => 'Ibu Davis',       'email' => 'davis@example.com'],
            ['name' => 'Pak Brown',       'email' => 'brown@example.com'],
            ['name' => 'Dr. Tech',        'email' => 'tech@example.com'],
            ['name' => 'Ibu Melody',      'email' => 'melody@example.com'],
            ['name' => 'Pak Penulis',     'email' => 'penulis@example.com'],
            ['name' => 'Pelatih Bola',    'email' => 'bola@example.com'],
            ['name' => 'Ibu Green',       'email' => 'green@example.com'],
            ['name' => 'Mr. English',     'email' => 'english@example.com'],
            ['name' => 'Dr. Math',        'email' => 'math@example.com'],
            ['name' => 'Ibu Budaya',      'email' => 'budaya@example.com'],
            ['name' => 'Pak Wartawan',    'email' => 'wartawan@example.com'],
        ];

        foreach ($pembinas as $index => $pembina) {
            $p = User::create([
                'name' => $pembina['name'],
                'email' => $pembina['email'],
                'password' => Hash::make('password'),
                'role' => 'pembina',
            ]);

            PembinaProfile::create([
                'user_id' => $p->id,
                'jenis_kelamin' => $jenis_kelamin[rand(0, 1)],
                'alamat' => fake()->address,
                'no_telephone' => fake()->regexify('08[0-9]{8,10}')
            ]);
        }
    }
}
