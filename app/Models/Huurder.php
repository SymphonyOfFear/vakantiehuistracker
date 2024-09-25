<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Huurder extends Model
{
    protected $table = 'huurders';

    // Reserveringen relationship
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'huurder_id');
    }
}
