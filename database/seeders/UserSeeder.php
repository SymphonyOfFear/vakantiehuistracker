<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $verhuurder = User::create([
            'name' => 'Verhuurder User',
            'email' => 'verhuurder@example.com',
            'password' => Hash::make('password'),
        ]);

        $huurder = User::create([
            'name' => 'Huurder User',
            'email' => 'huurder@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign roles
        $admin->roles()->attach(Role::where('name', 'admin')->first()->id);
        $verhuurder->roles()->attach(Role::where('name', 'verhuurder')->first()->id);
        $huurder->roles()->attach(Role::where('name', 'huurder')->first()->id);
    }
}
