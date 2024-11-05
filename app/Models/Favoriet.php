<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favoriet extends Model
{
    protected $table = 'Favorieten';
    protected $fillable = [
        'user_id',
        'vakantiehuis_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class);
    }

    public function FavorietenChecker($vakantiehuisId)
    {
        return $this->where('vakantiehuis_id', $vakantiehuisId)->exists();
    }
}
