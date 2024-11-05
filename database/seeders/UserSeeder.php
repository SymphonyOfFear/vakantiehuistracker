<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $verhuurder = User::create([
            'name' => 'Verhuurder User',
            'email' => 'verhuurder@example.com',
            'password' => bcrypt('password'),
        ]);
        $huurder = User::create([
            'name' => 'Huurder User',
            'email' => 'huurder@example.com',
            'password' => bcrypt('password'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $verhuurderRole = Role::where('name', 'verhuurder')->first();
        $huurderRole = Role::where('name', 'huurder')->first();

        $admin->roles()->attach($adminRole);
        $verhuurder->roles()->attach($verhuurderRole);
        $huurder->roles()->attach($huurderRole);
    }
}
