<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
        'ekskul_id',
        'judul',
        'isi',
        'tipe',
        'tanggal_pengumuman',
        'lokasi',
    ];

    # Relasi: Pengumuman dimiliki oleh suatu ekskul
    public function ekskul(){
        return $this->belongsTo(Ekskul::class);
    }
}
