<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleHasPermissionSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $verhuurderRole = Role::where('name', 'verhuurder')->first();
        $huurderRole = Role::where('name', 'huurder')->first();

        $permissions = Permission::all();

        if ($adminRole) {
            $adminRole->permissions()->sync($permissions->pluck('id')->toArray());
        }

        if ($verhuurderRole) {
            $verhuurderRole->permissions()->sync(
                $permissions->whereIn('name', ['create_vakantiehuis', 'edit_vakantiehuis', 'view_vakantiehuis'])->pluck('id')->toArray()
            );
        }

        if ($huurderRole) {
            $huurderRole->permissions()->sync(
                $permissions->whereIn('name', ['view_vakantiehuis'])->pluck('id')->toArray()
            );
        }
    }
}
