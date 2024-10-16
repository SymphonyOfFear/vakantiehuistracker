<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions for various controllers and actions
        $permissions = [
            'view admin dashboard',
            'view verhuurder dashboard',
            'view huurder dashboard',
            'manage users', // Admin
            'create huizen', // Verhuurder
            'edit huizen', // Verhuurder
            'delete huizen', // Verhuurder
            'manage reviews', // Admin & Huurder
            'create reserveringen', // Huurder
            'view reserveringen', // Huurder, Verhuurder
            'edit reserveringen', // Admin, Verhuurder
            'delete reserveringen', // Admin, Verhuurder
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
