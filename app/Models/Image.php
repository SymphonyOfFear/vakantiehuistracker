<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['vakantiehuis_id', 'url'];

    // Relation with Vakantiehuis
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class);
    }
}
