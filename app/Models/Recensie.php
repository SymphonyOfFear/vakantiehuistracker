<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recensie extends Model
{
    protected $table = 'recensies';
    protected $fillable = [
        'huurder_id',
        'vakantiehuis_id',
        'recensie',
    ];
    // Vakantiehuis Relationship
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }

    // User Relationship (who left the review)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
