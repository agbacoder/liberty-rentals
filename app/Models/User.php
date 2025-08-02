<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\Contracts\OAuthenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements OAuthenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token',
        'is_admin'
    ];


    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}