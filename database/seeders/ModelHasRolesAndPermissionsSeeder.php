<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class ModelHasRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign permissions to admin role
        $admin = Role::where('name', 'admin')->first();
        $adminPermissions = Permission::all(); // Admin gets all permissions
        $admin->syncPermissions($adminPermissions);

        // Assign permissions to verhuurder role
        $verhuurder = Role::where('name', 'verhuurder')->first();
        $verhuurderPermissions = Permission::whereIn('name', [
            'create huizen',
            'edit huizen',
            'delete huizen',
            'view reserveringen',
            'edit reserveringen',
            'delete reserveringen'
        ])->get();
        $verhuurder->syncPermissions($verhuurderPermissions);

        // Assign permissions to huurder role
        $huurder = Role::where('name', 'huurder')->first();
        $huurderPermissions = Permission::whereIn('name', [
            'manage reviews',
            'create reserveringen',
            'view reserveringen'
        ])->get();
        $huurder->syncPermissions($huurderPermissions);

        // Assign roles to example users (optional)
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $verhuurderUser = User::where('email', 'verhuurder@example.com')->first();
        if ($verhuurderUser) {
            $verhuurderUser->assignRole('verhuurder');
        }

        $huurderUser = User::where('email', 'huurder@example.com')->first();
        if ($huurderUser) {
            $huurderUser->assignRole('huurder');
        }
    }
}
