<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    // Tabel in database veranderen naar reservering
    protected $table = 'reserveringen';
    use HasFactory;
}
