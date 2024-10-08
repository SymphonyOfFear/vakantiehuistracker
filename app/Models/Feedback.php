<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = ['huisje_id', 'naam', 'email', 'feedback'];

    public function vakantiehuis()
    {
        return $this->belongsTo(Vakantiehuis::class, 'huisje_id');
    }
}
