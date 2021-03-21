<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $fillable = [
        'id',
        'home_team',
        'away_team',
        'match_venu',
        'main_referee',
        'first_lineman',
        'second_lineman'
    ];

    public $incrementing = false;
}
