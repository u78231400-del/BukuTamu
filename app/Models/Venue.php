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
        'fasilitas',
        'owner_id',
        'status',
    ];

    protected $casts = [
        'fasilitas' => 'array',
    ];

    /**
     * Relasi ke tabel reservations
     * Sebuah venue bisa memiliki banyak reservasi
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Relasi ke tabel favorites
     * Sebuah venue bisa menjadi favorit banyak user
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Relasi ke owner/user
     * Sebuah venue dimiliki oleh satu owner
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function schedules()
    {
        return $this->hasMany(VenueSchedule::class);
    }
}