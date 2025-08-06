<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaProfile extends Model
{
    use HasFactory;
    protected $table = 'siswa_profiles';

    protected $fillable = ['user_id', 'nisn', 'kelas', 'alamat', 'no_telephone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
