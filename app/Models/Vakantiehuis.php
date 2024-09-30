<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vakantiehuis extends Model
{
    use HasFactory;

    // De tabel die bij dit model hoort
    protected $table = 'vakantiehuizen';

    // Toegestane velden voor mass assignment
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
        'beschikbaarheid',
    ];

    // Definieer de relatie met het 'Verhuurder' model
    public function verhuurder()
    {
        return $this->belongsTo(User::class, 'verhuurder_id');
    }

    // Definieer de relatie met het 'Image' model
    public function images()
    {
        return $this->hasMany(Image::class, 'vakantiehuis_id');
    }
}
