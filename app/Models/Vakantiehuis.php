<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vakantiehuis extends Model
{
    use HasFactory;
    protected $table = 'vakantiehuizen';
    protected $fillable = [
        'verhuurder_id',
        'naam',
        'prijs',
        'beschrijving',
        'slaapkamers',
        'stad',
        'straatnaam',
        'postcode',
        'huisnummer',
        'latitude',
        'longitude',
        'wifi',
        'zwembad',
        'parkeren',
        'speeltuin',
        'beschikbaarheid'
    ];

    // Relatie met Verhuurder
    public function verhuurder()
    {
        return $this->belongsTo(Verhuurder::class, 'verhuurder_id');
    }

    // Relatie met Images
    public function images()
    {
        return $this->hasMany(Image::class, 'vakantiehuis_id');
    }

    // Relatie met Recensies
    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'vakantiehuis_id');
    }
}
