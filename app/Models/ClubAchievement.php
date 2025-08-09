<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubAchievement extends Model
{
    protected $fillable = [
        'club_id',
        'deskripsi',
        'tahun',
    ];

    public function club()
    {
        return $this->belongsTo(Ekskul::class);
    }
}