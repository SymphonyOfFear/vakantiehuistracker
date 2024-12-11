<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user_verhuurder_huurder_admin');
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
    
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class);
    }


    public function favorieten()
    {
        return $this->hasMany(Favoriet::class);
    }


   
}
