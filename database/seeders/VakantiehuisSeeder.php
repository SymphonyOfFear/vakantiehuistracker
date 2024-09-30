<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Vakantiehuis;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VakantiehuisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vakantiehuis::factory()->count(10)->create()->each(function ($vakantiehuis) {
            Image::factory()->count(3)->create([
                'vakantiehuis_id' => $vakantiehuis->id,
                'url' => 'https://via.placeholder.com/400x300.png?text=Vakantiehuis+' . $vakantiehuis->id
            ]);
        });
    }
}
