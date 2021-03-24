<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadiums extends Model
{
    protected $fillable = [
        'id',
        'rows_number',
        'seats_number'
    ];
    public $incrementing = false;
    public $timestamps = false;
}
