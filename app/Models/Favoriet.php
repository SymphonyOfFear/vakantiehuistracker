<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favoriet extends Model
{
    protected $table = 'favorieten';
    protected $fillable = [
        'vakantiehuis_id',
        'user_id'
    ];

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
