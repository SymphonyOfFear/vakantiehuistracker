<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['vakantiehuis_id', 'user_id', 'rating', 'opmerking'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vakantiehuis()
    {
        // return $this->belongsTo(Vakantiehuis::class)
    }
}
