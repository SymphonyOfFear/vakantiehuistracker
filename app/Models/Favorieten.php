<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorieten extends Model
{
    protected $table = 'favorieten'; // The name of the table

    protected $fillable = [
        'user_id',
        'vakantiehuis_id',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Vakantiehuis
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class);
    }
}
