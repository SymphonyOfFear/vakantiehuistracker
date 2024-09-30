<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'url',
        'vakantiehuis_id',
    ];

    // Relatie met Vakantiehuis
    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'vakantiehuis_id');
    }
}
