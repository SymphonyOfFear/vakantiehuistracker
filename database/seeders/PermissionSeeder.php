<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view admin dashboard',
            'view verhuurder dashboard',
            'view huizen',
            'create huis',
            'edit huis',
            'delete huis',
            'view huurder dashboard',
            'view reserveringen',
            'create reserveringen',
            'edit reserveringen',
            'delete reserveringen',
            'create recensies',
            'edit recensies',
            'delete recensies',
            'manage users',
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            // Check if the permission already exists before creating it
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
