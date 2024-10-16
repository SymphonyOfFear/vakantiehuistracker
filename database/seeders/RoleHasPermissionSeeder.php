<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch roles by their name
        $admin = Role::where('name', 'admin')->first();
        $verhuurder = Role::where('name', 'verhuurder')->first();
        $huurder = Role::where('name', 'huurder')->first();

        // Define permissions for each role
        $adminPermissions = Permission::all(); // Admin gets all permissions
        $verhuurderPermissions = Permission::whereIn('name', [
            'create huizen',
            'edit huizen',
            'delete huizen',
            'view reserveringen',
            'edit reserveringen',
            'delete reserveringen'
        ])->get();
        $huurderPermissions = Permission::whereIn('name', [
            'manage reviews',
            'create reserveringen',
            'view reserveringen'
        ])->get();

        // Sync permissions to the roles
        $admin->syncPermissions($adminPermissions);
        $verhuurder->syncPermissions($verhuurderPermissions);
        $huurder->syncPermissions($huurderPermissions);
    }
}
