<?php

namespace Database\Seeders;

use App\Models\Vakantiehuis;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class VakantiehuizenTableSeeder extends Seeder
{
    public function run()
    {
        // Verwijder alle bestaande vakantiehuizen en afbeeldingen
        Image::truncate();
        Vakantiehuis::truncate();

        // Maak enkele voorbeeld vakantiehuizen aan
        $vakantiehuizen = [
            [
                'verhuurder_id' => 1, // Zorg dat een verhuurder met dit ID bestaat
                'naam' => 'Vakantiehuis aan Zee',
                'prijs' => 150.00,
                'beschrijving' => 'Een prachtig vakantiehuis dicht bij het strand.',
                'slaapkamers' => 3,
                'stad' => 'Zandvoort',
                'straatnaam' => 'Strandweg',
                'postcode' => '2042KL',
                'huisnummer' => '12',
                'latitude' => 52.370216,
                'longitude' => 4.895168,
                'wifi' => true,
                'zwembad' => true,
                'parkeren' => false,
                'speeltuin' => true,
                'beschikbaarheid' => true,
            ],
            [
                'verhuurder_id' => 1, // Zorg dat een verhuurder met dit ID bestaat
                'naam' => 'Bosrijk Chalet',
                'prijs' => 90.00,
                'beschrijving' => 'Een gezellig chalet midden in de bossen.',
                'slaapkamers' => 2,
                'stad' => 'Arnhem',
                'straatnaam' => 'Bosweg',
                'postcode' => '6816DL',
                'huisnummer' => '5',
                'latitude' => 52.100216,
                'longitude' => 5.911376,
                'wifi' => false,
                'zwembad' => false,
                'parkeren' => true,
                'speeltuin' => false,
                'beschikbaarheid' => true,
            ],
        ];

        foreach ($vakantiehuizen as $huis) {
            $newVakantiehuis = Vakantiehuis::create($huis);

            // Voeg enkele voorbeeldafbeeldingen toe voor elk vakantiehuis
            $images = [
                'https://via.placeholder.com/400x300.png?text=Vakantiehuis+1',
                'https://via.placeholder.com/400x300.png?text=Vakantiehuis+2',
                'https://via.placeholder.com/400x300.png?text=Vakantiehuis+3'
            ];

            foreach ($images as $imageUrl) {
                Image::create([
                    'vakantiehuis_id' => $newVakantiehuis->id,
                    'url' => $imageUrl,
                ]);
            }
        }

        echo "Vakantiehuizen zijn succesvol aangemaakt en voorzien van afbeeldingen.\n";
    }
}
