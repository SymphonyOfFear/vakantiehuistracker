<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recensie extends Model
{
    use HasFactory;

    protected $table = 'recensies';
    protected $fillable = [
        'vakantiehuis_id',
        'user_id',
        'rating',
        'comment'
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
