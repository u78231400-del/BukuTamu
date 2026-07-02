<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $fillable = ['nama', 'kontak', 'instansi', 'pesan'];
}