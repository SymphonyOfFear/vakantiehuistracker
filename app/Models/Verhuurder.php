<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verhuurder extends Model
{
    protected $table = 'verhuurders';

    // Relation to Vakantiehuizen
    public function vakantiehuizen()
    {
        return $this->hasMany(Vakantiehuis::class, 'verhuurder_id');
    }
    use HasFactory;
}
