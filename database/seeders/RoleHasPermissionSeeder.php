<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Assign permissions to admin
        $admin = Role::where('name', 'admin')->first();
        $admin->permissions()->attach(Permission::all());

        // Assign permissions to verhuurder
        $verhuurder = Role::where('name', 'verhuurder')->first();
        $verhuurder->permissions()->attach(
            Permission::whereIn('name', [
                'view verhuurder dashboard',
                'view huizen',
                'create huis',
                'edit huis',
                'delete huis',
            ])->get()
        );

        // Assign permissions to huurder
        $huurder = Role::where('name', 'huurder')->first();
        $huurder->permissions()->attach(
            Permission::whereIn('name', [
                'view huurder dashboard',
                'view huizen',
                'create reserveringen',
                'view reserveringen',
                'create recensies',
                'edit recensies',
                'delete recensies',
            ])->get()
        );
    }
}
