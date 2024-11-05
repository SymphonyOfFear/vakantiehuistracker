<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'create_vakantiehuis'],
            ['name' => 'edit_vakantiehuis'],
            ['name' => 'delete_vakantiehuis'],
            ['name' => 'view_vakantiehuis'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
