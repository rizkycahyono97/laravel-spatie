<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $staffRole = Role::create(['name' => 'staff']);

        // permission
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'create finance data']);
        Permission::create(['name' => 'edit finance data']);
        Permission::create(['name' => 'delete finance data']);
        Permission::create(['name' => 'approve finance data']);

        // assigment
        $adminRole->givePermissionTo([
            'view reports',
            'create finance data',
            'edit finance data',
            'delete finance data',
            'approve finance data'
        ]);

        $managerRole->givePermissionTo([
            'view reports'
        ]);

        $staffRole->givePermissionTo([
            'view reports',
            'create finance data',
            'edit finance data',
            'delete finance data'
        ]);
    }
}
