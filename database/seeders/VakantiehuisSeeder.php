<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vakantiehuis;
use App\Models\Image;

class VakantiehuisSeeder extends Seeder
{
    /**
     * Voer de seeder uit.
     *
     * @return void
     */
    public function run()
    {
        // Verwijder bestaande records van de modellen zelf
        Vakantiehuis::truncate();
        Image::truncate();

        // Maak een voorbeeld vakantiehuis aan
        $vakantiehuis = Vakantiehuis::create([
            'verhuurder_id' => 1, // Pas aan naar een bestaande gebruiker ID in jouw project
            'naam' => 'Test Vakantiehuis',
            'prijs' => 150.00,
            'beschrijving' => 'Een mooi vakantiehuis voor tests.',
            'slaapkamers' => 3,
            'stad' => 'Amsterdam',
            'straatnaam' => 'Kalverstraat',
            'postcode' => '1012NX',
            'huisnummer' => '1',
            'latitude' => 52.370216,
            'longitude' => 4.895168,
            'wifi' => true,
            'zwembad' => false,
            'parkeren' => true,
            'speeltuin' => false,
            'beschikbaarheid' => true,
        ]);

        // Maak een voorbeeldafbeelding aan die gekoppeld is aan het vakantiehuis
        $vakantiehuis->images()->create([
            'url' => '/storage/fotos/example.jpg', // Voeg een voorbeeld URL toe of een bestaande afbeelding
        ]);

        // Voorbeeld log om te zien of de gegevens correct zijn toegevoegd
        $this->command->info('Vakantiehuis en bijbehorende afbeelding succesvol toegevoegd.');
    }
}
