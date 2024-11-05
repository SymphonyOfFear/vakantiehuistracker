<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url',
        'vakantiehuis_id'
    ];

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class);
    }
}
