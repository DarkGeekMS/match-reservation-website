<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'id',
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'gender',
        'city',
        'address',
        'birthdate',
        'role'
    ];
    public $timestamps = false;
    public $incrementing = false;
    
}
