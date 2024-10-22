<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the redirect route name based on the user's role.
     */
    public function getRedirectRouteName(): string
    {
        // Check the user's role and return corresponding route
        if ($this->hasRole('admin')) {
            return 'admin.dashboard';
        } elseif ($this->hasRole('verhuurder')) {
            return 'verhuurder.dashboard';
        } elseif ($this->hasRole('huurder')) {
            return 'huurder.dashboard';
        }

        // Default fallback
        return 'home';
    }

    // Relationships

    public function favorieten()
    {
        return $this->hasMany(Favoriet::class);
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
}
