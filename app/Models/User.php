<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Define a many-to-many relationship with the Role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
public function getRedirectRouteName($destination){
  
    $user = User::find(Auth::id());
    if($user->hasRole('admin')){
        $destination->redirect('admin/dashboard');
    } elseif ($user->hasRole('verhuurder')) {
        $destination->redirect('verhuurder/dashboard');
    } else{
        $destination->redirect('huurder/dashboard');
    }
}
    /**
     * Check if the user has a specific role.
     *
     * @param  string  $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Define a one-to-many relationship with the Vakantiehuis model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class);
    }

    /**
     * Define a one-to-many relationship with the Favoriet model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorieten()
    {
        return $this->hasMany(Favoriet::class);
    }

    /**
     * Get a specific beoordeling (review) for a vakantiehuis.
     *
     * @param  int  $vakantiehuisId
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beoordeling($vakantiehuisId)
    {
        return $this->hasOne(Recensie::class)->where('vakantiehuis_id', $vakantiehuisId);
    }
}
