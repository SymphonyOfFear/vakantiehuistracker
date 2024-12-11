<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user_verhuurder_huurder_admin');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
