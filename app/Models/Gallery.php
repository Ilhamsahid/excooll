<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'kegiatan_id',
        'uploaded_by',
        'judul',
        'deskripsi',
        'tanggal',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function galleryFiles()
    {
        return $this->hasMany(GalleryFile::class);
    }
}
