<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsTo(User::class, 'verhuurder_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'vakantiehuis_id');
    }

    public function recensies()
    {
        return $this->hasMany(Recensie::class, 'vakantiehuis_id');
    }

    public function isFavoritedBy($userId)
    {
        return $this->favorieten()->where('user_id', $userId)->exists();
    }

    public function favorieten()
    {
        return $this->hasMany(Favorieten::class, 'vakantiehuis_id');
    }
    public function userRating($userId)
    {
        $recensie = $this->recensies()->where('user_id', $userId)->first();
        return $recensie ? $recensie->rating : 0;  // Als er geen rating is, return 0
    }
}
