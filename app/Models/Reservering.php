<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    protected $table = 'reserveringen';
    protected $fillable = [
        'vakantiehuis_id',
        'huurder_id',
        'start_datum',
        'eind_datum',
        'status',
    ];
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
