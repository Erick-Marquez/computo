<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name' => 'Olimpo']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Vendedor']);

        //Dashboard Permissions
        Permission::create(['name' => 'dashboard', 'description' => 'Ver Dashboard'])->syncRoles([$role1]);

        //Profile Permissions
        Permission::create(['name' => 'profile', 'description' => 'Ver Perfil'])->syncRoles([$role1]);

        //Sales Permissions
        Permission::create(['name' => 'sales', 'description' => 'Ver Ventas'])->syncRoles([$role1]);

        //Cash Register Permissions
        Permission::create(['name' => 'cash-register', 'description' => 'Ver Caja'])->syncRoles([$role1]);
        
        //Catalogs Permissions
        Permission::create(['name' => 'catalogs', 'description' => 'Ver Catalagos'])->syncRoles([$role1]);

        //Purchases Permissions
        Permission::create(['name' => 'purchases', 'description' => 'Ver Compras'])->syncRoles([$role1]);

        //Inventory Permissions
        Permission::create(['name' => 'inventory', 'description' => 'Ver Inventario'])->syncRoles([$role1]);

            //Branchs Permissions
            Permission::create(['name' => 'branches.index', 'description' => 'Ver Lista de Sucursales'])->syncRoles([$role1]);
            Permission::create(['name' => 'branches.create', 'description' => 'Crear Sucursal'])->syncRoles([$role1]);
            Permission::create(['name' => 'branches.edit', 'description' => 'Editar Sucursal'])->syncRoles([$role1]);
            Permission::create(['name' => 'branches.destroy', 'description' => 'Eliminar Sucursal'])->syncRoles([$role1]);
            Permission::create(['name' => 'branches.products', 'description' => 'Ver Productos de la Sucursal'])->syncRoles([$role1]);

            //Devolutions Permissions
            Permission::create(['name' => 'devolutions.index', 'description' => 'Ver Lista de Devoluciones'])->syncRoles([$role1]);
            Permission::create(['name' => 'devolutions.create', 'description' => 'Crear Devolucion'])->syncRoles([$role1]);
            Permission::create(['name' => 'devolutions.edit', 'description' => 'Editar Devolucion'])->syncRoles([$role1]);
            Permission::create(['name' => 'devolutions.destroy', 'description' => 'Eliminar Devolucion'])->syncRoles([$role1]);

        //Reports Permissions
        Permission::create(['name' => 'reports', 'description' => 'Ver Reportes'])->syncRoles([$role1]);

        //Third Parties Permissions
        Permission::create(['name' => 'third-parties', 'description' => 'Ver Terceros'])->syncRoles([$role1]);

        //Settings Permissions
        Permission::create(['name' => 'settings', 'description' => 'Ver Configuracion'])->syncRoles([$role1]);

            //User Permissions
            Permission::create(['name' => 'users.index', 'description' => 'Ver Lista de Usuarios'])->syncRoles([$role1]);
            Permission::create(['name' => 'users.create', 'description' => 'Crear Usuarios'])->syncRoles([$role1]);
            Permission::create(['name' => 'users.edit', 'description' => 'Editar Usuarios'])->syncRoles([$role1]);
            Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar Usuarios'])->syncRoles([$role1]);

            //Role Permissions
            Permission::create(['name' => 'roles.index', 'description' => 'Ver lista de Roles'])->syncRoles([$role1]);
            Permission::create(['name' => 'roles.create', 'description' => 'Crear Roles'])->syncRoles([$role1]);
            Permission::create(['name' => 'roles.edit', 'description' => 'Editar Roles'])->syncRoles([$role1]);
            Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar Roles'])->syncRoles([$role1]);

            //Serie Permissions
            Permission::create(['name' => 'series.index', 'description' => 'Ver lista de Series'])->syncRoles([$role1]);
            Permission::create(['name' => 'series.create', 'description' => 'Crear Series'])->syncRoles([$role1]);
            Permission::create(['name' => 'series.edit', 'description' => 'Editar Series'])->syncRoles([$role1]);
            Permission::create(['name' => 'series.destroy', 'description' => 'Eliminar Series'])->syncRoles([$role1]);
        
    }
}
