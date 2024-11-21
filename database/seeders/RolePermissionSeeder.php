<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'create data']);
        Permission::create(['name' => 'read data']);
        Permission::create(['name' => 'update data']);
        Permission::create(['name' => 'delete data']);

        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'read role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'read permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Operator']);
        Role::create(['name' => 'User']);
        // Administrator
        $roleAdmin = Role::findByName('Administrator');
        $roleAdmin->givePermissionTo('create user');
        $roleAdmin->givePermissionTo('read user');
        $roleAdmin->givePermissionTo('update user');
        $roleAdmin->givePermissionTo('delete user');
        $roleAdmin->givePermissionTo('create data');
        $roleAdmin->givePermissionTo('read data');
        $roleAdmin->givePermissionTo('update data');
        $roleAdmin->givePermissionTo('delete data');
        $roleAdmin->givePermissionTo('create role');
        $roleAdmin->givePermissionTo('read role');
        $roleAdmin->givePermissionTo('update role');
        $roleAdmin->givePermissionTo('delete role');
        $roleAdmin->givePermissionTo('create permission');
        $roleAdmin->givePermissionTo('read permission');
        $roleAdmin->givePermissionTo('update permission');
        $roleAdmin->givePermissionTo('delete permission');
        // Operator
        $roleOperator = Role::findByName('Operator');
        $roleOperator->givePermissionTo('read data');
        $roleOperator->givePermissionTo('create data');
        $roleOperator->givePermissionTo('update data');
        $roleOperator->givePermissionTo('delete data');
    }
}
