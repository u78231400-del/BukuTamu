<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_venue',
        'slug',
        'deskripsi',
        'kapasitas',
        'lokasi',
        'foto',
        'status',
    ];
}
