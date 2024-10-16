<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verhuurder extends Model
{
    use HasFactory;

    protected $table = 'verhuurders';
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class, 'verhuurder_id');
    }
}
