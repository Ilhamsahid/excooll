<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nisn extends Model
{
    use HasFactory;

    protected $table = 'nisns';

    protected $fillable = ['nisn'];
}