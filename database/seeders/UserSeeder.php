<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default user if one does not already exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Search for this email
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Replace with your desired password
            ]
        );
    }
}
