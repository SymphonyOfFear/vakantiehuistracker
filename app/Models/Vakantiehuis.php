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
        'user_id',
    ];

    // Cast 'fotos' naar array (omdat het een JSON-kolom is)
    protected $casts = [
        'fotos' => 'array',
    ];
    public function favorieten()
    {
        return $this->hasMany(Favorieten::class);
    }
    public function scopeFilter($query, $filters)
    {
        // Verwerk de locatie filter alleen als het een string is
        if (isset($filters['locatie']) && is_string($filters['locatie'])) {
            $locatie = trim($filters['locatie']);
            $query->where('locatie', 'LIKE', '%' . $locatie . '%');
        }

        // Verwerk de prijsfilters
        if (isset($filters['min_prijs'])) {
            $query->where('prijs', '>=', $filters['min_prijs']);
        }

        if (isset($filters['max_prijs'])) {
            $query->where('prijs', '<=', $filters['max_prijs']);
        }

        // Voeg filters toe voor voorzieningen
        if (isset($filters['zwembad'])) {
            $query->where('zwembad', true);
        }

        if (isset($filters['wifi'])) {
            $query->where('wifi', true);
        }

        if (isset($filters['spa'])) {
            $query->where('spa', true);
        }

        if (isset($filters['speeltuin'])) {
            $query->where('speeltuin', true);
        }

        return $query;
    }
}
