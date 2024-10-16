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
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);



        $verhuurder = User::create([
            'name' => 'Verhuurder User',
            'email' => 'verhuurder@example.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'verhuurder')->first()->id,
        ]);





        $huurder = User::create([
            'name' => 'Huurder User',
            'email' => 'huurder@example.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'huurder')->first()->id,
        ]);
    }
}
