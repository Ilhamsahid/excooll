<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubSchedule extends Model
{
    protected $fillable = [
        'club_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function club()
    {
        return $this->belongsTo(Ekskul::class);
    }
}
