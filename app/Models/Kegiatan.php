<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatans';
    protected $fillable = [
        'ekskul_id',
        'uploaded_by',
        'tanggal',
        'judul',
        'deskripsi',
        'lokasi',
        'jam_mulai',
        'jam_selesai',
        'status',
        'bukti',
    ];

    # Relasi: kegiatan milik ekskul
    public function ekskul(){
        return $this->belongsTo(Ekskul::class);
    }
}