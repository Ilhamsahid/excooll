<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'deskripsi', 'pembina_id'];

    # Relasi: ekskul dimiliki oleh pembina dari user
    public function pembina(){
        return $this->belongsTo(User::class, 'pembina_id');
    }

    # Relasi: ekskul dimiliki banyak siswa dari user
    public function siswa(){
        return $this->belongsToMany(User::class, 'ekskul_user');
    }

    # Relasi: ekskul memiliki banyak kegiatan
    public function kegiatans(){
        return $this->hasMany(Kegiatan::class);
    }

    # Relasi: ekskul memiliki banyak pengumuman
    public function pengumumans(){
        return $this->hasMany(Pengumuman::class);
    }

    # Relasi: ekskul memiliki banyak absensi
    public function absensis(){
        return $this->hasMany(Absensi::class);
    }
}
