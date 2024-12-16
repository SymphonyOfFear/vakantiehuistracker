<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vakantiehuis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vakantiehuizen';
    protected $fillable = [
        'user_id',
        'naam',
        'prijs',
        'beschrijving',
        'slaapkamers',
        'wifi',
        'zwembad',
        'speeltuin',
        'stad',
        'straatnaam',
        'postcode',
        'huisnummer',
        'latitude',
        'longitude'
    ];

    public function FavorietenChecker($userId)
    {
        return $this->favorieten()->where('user_id', $userId)->exists();
    }

    public function verhuurder()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkVerhuurder($userId)
    {
        return $this->verhuurder()->where('id', $userId)->exists();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function recensies()
    {
        return $this->hasMany(Recensie::class);
    }
    public function favorieten()
    {
        return $this->hasMany(Favoriet::class);
    }
    public function reserveringen()
    {
        return $this->hasOne(Reservering::class);
    }
    public function beoordeling($userId)
    {
        return $this->recensies()->where('user_id', $userId)->first()?->rating;
    }
}