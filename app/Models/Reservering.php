<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    protected $table = 'reserveringen';
    protected $fillable = [
        'user_id',
        'vakantiehuis_id',
        'begindatum',
        'einddatum',    
        'huurder_id',
        'reserveringsnummer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class);
    }
}
