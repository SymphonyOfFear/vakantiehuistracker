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
<<<<<<< HEAD
        'fotos',
        'beschikbaarheid',
        'user_id',
=======
        'beschikbaarheid'
>>>>>>> mikey-backend
    ];

    // Relatie met de verhuurder
    public function verhuurder()
    {
        return $this->belongsTo(Verhuurder::class, 'verhuurder_id');
    }

    // Relatie met afbeeldingen (images)
    public function images()
    {
        return $this->hasMany(Image::class, 'vakantiehuis_id');
    }
}
