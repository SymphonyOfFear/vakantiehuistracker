<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    use HasFactory;

    protected $table = 'reserveringen';
    protected $fillable = [
        'vakantiehuis_id',
        'huurder_id',
        'reserveringsnummer',
        'begindatum',
        'einddatum',
        'status',
    ];

    public function huurder()
    {
        return $this->belongsTo(Huurder::class, 'huurder_id');
    }

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }
}
