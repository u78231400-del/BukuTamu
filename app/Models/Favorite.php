<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'venue_id',
    ];

    /**
     * Favorite dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Favorite dimiliki oleh satu venue.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}