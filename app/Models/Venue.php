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

    /**
     * Relasi ke tabel reservations
     * Sebuah venue bisa memiliki banyak reservasi
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}