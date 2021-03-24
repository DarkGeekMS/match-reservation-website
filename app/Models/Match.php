<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Stadiums;

class Match extends Model
{
    protected $fillable = [
        'id',
        'home_team',
        'away_team',
        'match_venu',
        'main_referee',
        'first_linesman',
        'second_linesman'
    ];

    public $incrementing = false;
    /**
    * Get the Staduim of the match.
    */
    public function stadium()
    {
        return $this->hasOne(Stadiums::class, 'id', 'match_venu');
    }

    /**
    * Get the reservations for the match.
    */
    public function reservations()
    {
        return $this->hasMany(Reservation::class)->select(['seat_number', 'row_number']);
    }
}
