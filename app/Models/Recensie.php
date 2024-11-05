<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recensie extends Model
{
    protected $fillable = [
        'user_id',
        'vakantiehuis_id',
        'beoordeling',
        'opmerking'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class);
    }
}
