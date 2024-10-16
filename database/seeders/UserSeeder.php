<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $huurderRole = Role::where('name', 'huurder')->first();
        $verhuurderRole = Role::where('name', 'verhuurder')->first();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Huurder User',
            'email' => 'huurder@example.com',
            'password' => bcrypt('password'),
            'role_id' => $huurderRole->id,
        ]);

        User::create([
            'name' => 'Verhuurder User',
            'email' => 'verhuurder@example.com',
            'password' => bcrypt('password'),
            'role_id' => $verhuurderRole->id,
        ]);
    }
}
