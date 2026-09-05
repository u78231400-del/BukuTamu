<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueSchedule extends Model
{
    use HasFactory;

    protected $table = 'venue_schedules';

    protected $fillable = [
        'venue_id',
        'owner_id',
        'reservation_id',
        'judul',
        'jenis',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public static function checkConflict($venueId, $tanggalMulai, $tanggalSelesai, $waktuMulai, $waktuSelesai, $excludeId = null)
    {
        $query = self::where('venue_id', $venueId)
            ->where(function ($q) use ($tanggalMulai, $tanggalSelesai, $waktuMulai, $waktuSelesai) {
                $q->where(function ($q1) use ($tanggalMulai, $tanggalSelesai) {
                    $q1->where('tanggal_mulai', '<=', $tanggalSelesai)
                       ->where('tanggal_selesai', '>=', $tanggalMulai);
                })->where(function ($q2) use ($waktuMulai, $waktuSelesai) {
                    $q2->where('waktu_mulai', '<', $waktuSelesai)
                       ->where('waktu_selesai', '>', $waktuMulai);
                });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->first();
    }

    public static function getConflictingReservations($venueId, $tanggalMulai, $tanggalSelesai, $waktuMulai, $waktuSelesai, $excludeId = null)
    {
        $query = Reservation::where('venue_id', $venueId)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->where('tanggal_mulai', '<=', $tanggalSelesai)
                  ->where('tanggal_selesai', '>=', $tanggalMulai);
            })
            ->where(function ($q) use ($waktuMulai, $waktuSelesai) {
                $q->where('waktu_mulai', '<', $waktuSelesai)
                  ->where('waktu_selesai', '>', $waktuMulai);
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }
}
