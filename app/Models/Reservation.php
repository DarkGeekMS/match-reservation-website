<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'ticket_number',
        'match_id',
        'fan_id',
        'seat_number',
        'row_number'
    ];

    public $incrementing = false;
    public $timestamps = false;
}
