<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $clienteRole = Role::create(['cliente' => 'cliente']);
        $supervisorRole = Role::create(['supervisor' => 'supervisor']);
        $gerenteRole = Role::create(['gerente' => 'gerente']);

        $editPermission = Permission::create(['name' => 'edit']);
        $deletePermission = Permission::create(['name' => 'delete']);
        $createPermission = Permission::create(['name' => 'create']);
        $viewPermission = Permission::create(['name' => 'view']);

        $adminRole->givePermissionTo($editPermission, $deletePermission, $createPermission, $viewPermission);
        $clienteRole->givePermissionTo($viewPermission);
        $supervisorRole->givePermissionTo($viewPermission,$editPermission, $createPermission);
        $gerenteRole->givePermissionTo($editPermission, $deletePermission, $createPermission, $viewPermission);

    }
}
