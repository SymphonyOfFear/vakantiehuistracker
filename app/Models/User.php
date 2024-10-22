<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    // Relation with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Check if user has a specific role
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    // Relation with favorieten
    public function favorieten()
    {
        return $this->hasMany(Favoriet::class);
    }

    // Relation with reserveringen
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'huurder_id');
    }

    // Relation with recensies
    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'user_id');
    }

    // Relation with vakantiehuizen (as a verhuurder)
    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class);
    }

    // Redirect route method based on role
    public function getRedirectRouteName()
    {
        if ($this->hasRole('admin')) {
            return 'admin.dashboard';
        } elseif ($this->hasRole('verhuurder')) {
            return 'verhuurder.dashboard';
        } elseif ($this->hasRole('huurder')) {
            return 'huurder.dashboard';
        }

        return 'home';
    }
}
