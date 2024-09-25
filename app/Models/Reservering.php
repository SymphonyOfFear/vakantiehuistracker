<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    protected $table = 'reserveringen';

    // Vakantiehuis Relationship
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }

    // Huurder Relationship
    public function huurder()
    {
        return $this->belongsTo(Huurder::class, 'huurder_id');
    }
}
