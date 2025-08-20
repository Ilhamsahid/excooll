<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaProfile extends Model
{
    use HasFactory;
    protected $table = 'pembina_profiles';
    protected $fillable = ['id', 'user_id', 'jenis_kelamin', 'alamat', 'no_telephone', 'deskripsi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
