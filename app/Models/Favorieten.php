<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorieten extends Model
{
    protected $table = 'favorieten';
    protected $fillable = [
        'vakantiehuis_id',
        'huurder_id',
        'user_id'
    ];
    public static function isFavoritedBy($vakantiehuisId, $userId)
    {
        return self::where('user_id', $userId)
            ->where('vakantiehuis_id', $vakantiehuisId)
            ->exists();
    }
    // Vakantiehuis Relationship
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }

    // User Relationship (who marked it as favorite)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
