<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huurder extends Model
{
    use HasFactory;

    protected $table = 'huurders';
    protected $fillable = [
        'user_id',
        'vakantiehuis_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'huurder_id');
    }
}
