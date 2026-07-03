<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'nama',
        'nomor_hp',
        'tujuan',
        'pesan',
        'tanggal_janji',
        'jam_janji',
        'status',
    ];
}
