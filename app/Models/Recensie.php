<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recensie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vakantiehuis_id', 'beoordeling', 'opmerking'];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation with Vakantiehuis
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }
}
