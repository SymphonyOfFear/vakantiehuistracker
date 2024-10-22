<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vakantiehuis extends Model
{
    use HasFactory;

    protected $table = 'vakantiehuizen';
    protected $fillable = ['naam', 'prijs', 'beschrijving', 'slaapkamers', 'stad', 'straatnaam', 'postcode', 'huisnummer', 'latitude', 'longitude', 'wifi', 'zwembad', 'parkeren', 'speeltuin', 'beschikbaarheid', 'verhuurder_id'];


    public function FavorietenChecker($userId)
    {
        return $this->favorieten()->where('user_id', $userId)->exists();
    }
    public function Beoordeling($userId)
    {
        $recensie = $this->recensies()->where('user_id', $userId)->first();
        return $recensie ? $recensie->rating : 0;
    }
    public function verhuurder()
    {
        return $this->belongsTo(User::class, 'verhuurder_id');
    }

    // Relation with images
    public function images()
    {
        return $this->hasMany(Image::class, 'vakantiehuis_id');
    }

    // Relation with favorieten
    public function favorieten()
    {
        return $this->hasMany(Favoriet::class, 'vakantiehuis_id');
    }

    // Relation with recensies
    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'vakantiehuis_id');
    }

    // Relation with reserveringen
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'vakantiehuis_id');
    }
}
