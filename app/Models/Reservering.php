<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    use HasFactory;

    protected $fillable = ['vakantiehuis_id', 'huurder_id', 'reserveringsnummer', 'begindatum', 'einddatum', 'status'];

    // Relation with Vakantiehuis
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }

    // Relation with Huurder (User model)
    public function huurder()
    {
        return $this->belongsTo(User::class, 'huurder_id');
    }
}
