<?php

namespace Database\Factories;

use App\Models\Vakantiehuis;
use Illuminate\Database\Eloquent\Factories\Factory;

class VakantiehuisFactory extends Factory
{
    protected $model = Vakantiehuis::class;

    public function definition()
    {
        return [
            'verhuurder_id' => 1, // Replace this with a dynamic value or reference
            'naam' => $this->faker->company,
            'prijs' => $this->faker->numberBetween(50, 1000),
            'beschrijving' => $this->faker->text,
            'slaapkamers' => $this->faker->numberBetween(1, 5),
            'stad' => $this->faker->city,
            'straatnaam' => $this->faker->streetName,
            'postcode' => $this->faker->postcode,
            'huisnummer' => $this->faker->buildingNumber,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'wifi' => $this->faker->boolean,
            'zwembad' => $this->faker->boolean,
            'parkeren' => $this->faker->boolean,
            'speeltuin' => $this->faker->boolean,
            'beschikbaarheid' => $this->faker->boolean,
        ];
    }
}
