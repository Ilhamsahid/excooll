<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryFile extends Model
{
    protected $fillable = [
        'gallery_id',
        'file_name',
        'file_path',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
