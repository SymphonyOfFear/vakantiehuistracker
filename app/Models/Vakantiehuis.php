<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vakantiehuis extends Model
{
    use HasFactory;

    // Zorg ervoor dat de tabelnaam correct is
    protected $table = 'vakantiehuizen';  // Verwijst naar de juiste tabel 'vakantiehuizen'

    // Vulbare velden die je massaal wilt kunnen invullen
    protected $fillable = [
        'naam',
        'locatie',
        'prijs',
        'slaapkamers',
        'wifi',
        'zwembad',
        'spa',
        'speeltuin',
        'fotos',
        'beschikbaarheid',
        'verhuurder_id',
    ];

    // Cast 'fotos' naar array (omdat het een JSON-kolom is)
    protected $casts = [
        'fotos' => 'array',
    ];
    public function favorieten()
    {
        return $this->hasMany(Favorieten::class);
    }
}
