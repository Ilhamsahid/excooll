<?php

namespace App\Repositories;

use App\Models\ClubSchedule;
use App\Models\Ekskul;
use App\Repositories\Contracts\EkskulRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EkskulRepository implements EkskulRepositoryInterface
{
    public function getAllWithPembinaAndCount(): collection{
        return Ekskul::with('pembina')->withCount('siswa')->get();
    }

    public function getEkskulByEkskulIdFromUser($ekskulId): collection{
        return Ekskul::with([
            'siswa' => function ($q) {
                $q->where('users.id', Auth::user()->id);
        }, 'pembina'])->withCount('siswa')->whereIn('id', $ekskulId)->get();
    }

    public function getAllStudentWithPending()
    {
        return Ekskul::with([
            'siswa' => function ($q) {
                $q->with('siswaProfile'); // nested eager loading di dalam sini
            }
        ])
        ->get();
    }

    public function getAllEkskulWithRelation(): collection
    {
        return Ekskul::with(['pembina', 'schedules'])->withCount(['siswa', 'achievements'])->orderBy('id', 'desc')->get();
    }

    public function createEkskul($request)
    {
        $ekskul = Ekskul::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'pembina_id' => $request->pembina,
            'status' => 'aktif',
        ])->fresh();

        ClubSchedule::create([
            'ekskul_id' => $ekskul->getKey(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'lokasi' => $request->lokasi
        ]);

        return $ekskul;
    }
}