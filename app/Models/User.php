<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role', 'status', 'created_at'];

    public function pembinaProfile()
    {
        return $this->hasOne(PembinaProfile::class);
    }

    public function siswaProfile()
    {
        return $this->hasOne(SiswaProfile::class);
    }

    # Relasi: User(siswa) memiliki banyak ekskul
    public function ekskuls(){
        return $this->belongsToMany(Ekskul::class, 'ekskul_user')
            ->withPivot('alasan', 'status', 'exp_before')
            ->withTimestamps();
    }

    # Relasi: User(pembina) mengelola banyak ekskul 
    # maksudnya satu pembina itu mengelola satu ekskul
    public function ekskulDibina(){
        return $this->hasMany(Ekskul::class, 'pembina_id');
    }

    # Relasi: User(siswa) memiliki banyak absensi
    public function absensis(){
        return $this->hasMany(Absensi::class);
    }

    # Relasi: User(siswa) memiliki banyak kegiatan
    public function kegiatans(){
        return $this->hasMany(Kegiatan::class, 'uploaded_by');
    }
}