<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubSchedule extends Model
{
    protected $fillable = [
        'ekskul_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
    ];

    public function club()
    {
        return $this->belongsTo(Ekskul::class);
    }
}
