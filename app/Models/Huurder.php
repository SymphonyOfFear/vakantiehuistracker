<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Huurder extends Model
{
    protected $table = 'huurders';
    protected $fillable = [
        'user_id',
        'naam',
        'email',
        'telefoonnummer',
    ];
    // Reserveringen relationship
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'huurder_id');
    }
}
