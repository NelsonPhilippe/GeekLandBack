<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'newsletters',
        'rank',
        'remember_token',
        'url_image_profile',
        'name',
        'last_name',
        'postal_adress',
        'postal_code',
        'city',
        'country',
        'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
