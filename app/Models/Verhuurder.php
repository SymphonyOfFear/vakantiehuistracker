<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verhuurder extends Model
{
    protected $table = 'verhuurders';
    protected $fillable = 'user_id';

    // Relation to Vakantiehuizen
    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class, 'verhuurder_id');
    }


    use HasFactory;
}
