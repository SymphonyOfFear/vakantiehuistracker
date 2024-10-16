<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favorieten()
    {
        return $this->hasMany(Favorieten::class);
    }

    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'huurder_id');
    }

    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'user_id');
    }

    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class, 'verhuurder_id');
    }

    public function verhuurder()
    {
        return $this->hasOne(Verhuurder::class);
    }

    public function huurder()
    {
        return $this->hasOne(Huurder::class);
    }
}
