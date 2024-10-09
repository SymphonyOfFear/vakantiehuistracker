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
        'beschikbaarheid',
    ];

    public function verhuurder()
    {
        return $this->belongsTo(Verhuurder::class, 'verhuurder_id');
    }
    public function FavorietChecker($userId)
    {
        return $this->favorieten()->where('user_id', $userId)->exists();
    }
    public function Beoordeling($userId)
    {
        $recensie = $this->recensies()->where('user_id', $userId)->first();
        return $recensie ? $recensie->rating : 0;
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'vakantiehuis_id');
    }

    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'vakantiehuis_id');
    }

    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'vakantiehuis_id');
    }

    public function favorieten()
    {
        return $this->hasMany(Favorieten::class, 'vakantiehuis_id');
    }
}
