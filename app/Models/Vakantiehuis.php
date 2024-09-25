<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vakantiehuis extends Model
{
    protected $table = 'vakantiehuizen';

    // Verhuurder Relationship
    public function verhuurder()
    {
        return $this->belongsTo(Verhuurder::class, 'verhuurder_id');
    }

    // Reservering Relationship
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'vakantiehuis_id');
    }

    // Favorieten Relationship (users who marked this house as favorite)
    public function favorieten()
    {
        return $this->hasMany(Favorieten::class, 'vakantiehuis_id');
    }

    // Recensies Relationship (reviews)
    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'vakantiehuis_id');
    }
}
