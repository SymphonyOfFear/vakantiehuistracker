<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoriet extends Model
{
    use HasFactory;
    protected $table = 'favorieten';

    protected $fillable = ['user_id', 'vakantiehuis_id'];


    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
