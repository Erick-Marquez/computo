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

            //Vouchers Permissions
            Permission::create(['name' => 'vouchers.index', 'description' => 'Ver Lista de Ventas'])->syncRoles([$role1]);
            Permission::create(['name' => 'vouchers.create', 'description' => 'Crear Venta'])->syncRoles([$role1]);
            Permission::create(['name' => 'vouchers.edit', 'description' => 'Editar Venta'])->syncRoles([$role1]);
            Permission::create(['name' => 'vouchers.destroy', 'description' => 'Eliminar Venta'])->syncRoles([$role1]);

            //Quotations Permissions
            Permission::create(['name' => 'quotations.index', 'description' => 'Ver Lista de Cotizaciones'])->syncRoles([$role1]);
            Permission::create(['name' => 'quotations.create', 'description' => 'Crear Cotización'])->syncRoles([$role1]);
            Permission::create(['name' => 'quotations.edit', 'description' => 'Editar Cotización'])->syncRoles([$role1]);
            Permission::create(['name' => 'quotations.destroy', 'description' => 'Eliminar Cotización'])->syncRoles([$role1]);

        //Cash Register Permissions
        Permission::create(['name' => 'cash-register', 'description' => 'Ver Caja'])->syncRoles([$role1]);
        
        //Catalogs Permissions
        Permission::create(['name' => 'catalogs', 'description' => 'Ver Catalagos'])->syncRoles([$role1]);

            //Families Permissions
            Permission::create(['name' => 'families.index', 'description' => 'Ver Lista de Familias'])->syncRoles([$role1]);
            Permission::create(['name' => 'families.create', 'description' => 'Crear Familia'])->syncRoles([$role1]);
            Permission::create(['name' => 'families.edit', 'description' => 'Editar Familia'])->syncRoles([$role1]);
            Permission::create(['name' => 'families.destroy', 'description' => 'Eliminar Familia'])->syncRoles([$role1]);

            //Lines Permissions
            Permission::create(['name' => 'lines.index', 'description' => 'Ver Lista de Lineas'])->syncRoles([$role1]);
            Permission::create(['name' => 'lines.create', 'description' => 'Crear Linea'])->syncRoles([$role1]);
            Permission::create(['name' => 'lines.edit', 'description' => 'Editar Linea'])->syncRoles([$role1]);
            Permission::create(['name' => 'lines.destroy', 'description' => 'Eliminar Linea'])->syncRoles([$role1]);

            //Brands Permissions
            Permission::create(['name' => 'brands.index', 'description' => 'Ver Lista de Marcas'])->syncRoles([$role1]);
            Permission::create(['name' => 'brands.create', 'description' => 'Crear Marca'])->syncRoles([$role1]);
            Permission::create(['name' => 'brands.edit', 'description' => 'Editar Marca'])->syncRoles([$role1]);
            Permission::create(['name' => 'brands.destroy', 'description' => 'Eliminar Marca'])->syncRoles([$role1]);

            //Products Permissions
            Permission::create(['name' => 'products.index', 'description' => 'Ver Lista de Productos'])->syncRoles([$role1]);
            Permission::create(['name' => 'products.create', 'description' => 'Crear Producto'])->syncRoles([$role1]);
            Permission::create(['name' => 'products.edit', 'description' => 'Editar Producto'])->syncRoles([$role1]);
            Permission::create(['name' => 'products.destroy', 'description' => 'Eliminar Producto'])->syncRoles([$role1]);

            //Product Series Permissions
            Permission::create(['name' => 'product-series.index', 'description' => 'Ver Lista de Series de Productos'])->syncRoles([$role1]);
            Permission::create(['name' => 'product-series.create', 'description' => 'Crear Serie de Producto'])->syncRoles([$role1]);
            Permission::create(['name' => 'product-series.edit', 'description' => 'Editar Serie de Producto'])->syncRoles([$role1]);
            Permission::create(['name' => 'product-series.destroy', 'description' => 'Eliminar Serie de Producto'])->syncRoles([$role1]);

            //Assemblies Permissions
            Permission::create(['name' => 'assemblies.index', 'description' => 'Ver Lista de Configuraciones de PC'])->syncRoles([$role1]);
            Permission::create(['name' => 'assemblies.create', 'description' => 'Crear Configuracion de PC'])->syncRoles([$role1]);
            Permission::create(['name' => 'assemblies.edit', 'description' => 'Editar Configuracion de PC'])->syncRoles([$role1]);
            Permission::create(['name' => 'assemblies.destroy', 'description' => 'Eliminar Configuracion de PC'])->syncRoles([$role1]);

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
            //Customers Permissions
            Permission::create(['name' => 'customers.index', 'description' => 'Ver Lista de Clientes'])->syncRoles([$role1]);
            Permission::create(['name' => 'customers.create', 'description' => 'Crear Cliente'])->syncRoles([$role1]);
            Permission::create(['name' => 'customers.edit', 'description' => 'Editar Cliente'])->syncRoles([$role1]);
            Permission::create(['name' => 'customers.destroy', 'description' => 'Eliminar Cliente'])->syncRoles([$role1]);

            //Providers Permissions
            Permission::create(['name' => 'providers.index', 'description' => 'Ver Lista de Proveedores'])->syncRoles([$role1]);
            Permission::create(['name' => 'providers.create', 'description' => 'Crear Proveedor'])->syncRoles([$role1]);
            Permission::create(['name' => 'providers.edit', 'description' => 'Editar Proveedor'])->syncRoles([$role1]);
            Permission::create(['name' => 'providers.destroy', 'description' => 'Eliminar Proveedor'])->syncRoles([$role1]);

        //Settings Permissions
        Permission::create(['name' => 'settings', 'description' => 'Ver Configuracion'])->syncRoles([$role1]);

            //User Permissions
            Permission::create(['name' => 'users.index', 'description' => 'Ver Lista de Usuarios'])->syncRoles([$role1]);
            Permission::create(['name' => 'users.create', 'description' => 'Crear Usuario'])->syncRoles([$role1]);
            Permission::create(['name' => 'users.edit', 'description' => 'Editar Usuario'])->syncRoles([$role1]);
            Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar Usuario'])->syncRoles([$role1]);

            //Role Permissions
            Permission::create(['name' => 'roles.index', 'description' => 'Ver lista de Roles'])->syncRoles([$role1]);
            Permission::create(['name' => 'roles.create', 'description' => 'Crear Role'])->syncRoles([$role1]);
            Permission::create(['name' => 'roles.edit', 'description' => 'Editar Role'])->syncRoles([$role1]);
            Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar Role'])->syncRoles([$role1]);

            //Serie Permissions
            Permission::create(['name' => 'series.index', 'description' => 'Ver lista de Series'])->syncRoles([$role1]);
            Permission::create(['name' => 'series.create', 'description' => 'Crear Serie'])->syncRoles([$role1]);
            Permission::create(['name' => 'series.edit', 'description' => 'Editar Serie'])->syncRoles([$role1]);
            Permission::create(['name' => 'series.destroy', 'description' => 'Eliminar Serie'])->syncRoles([$role1]);

            //Currency Exchanges Permissions
            Permission::create(['name' => 'currency-exchanges.index', 'description' => 'Ver lista de Camnio de Divisas'])->syncRoles([$role1]);
            Permission::create(['name' => 'currency-exchanges.create', 'description' => 'Crear Cambio de Divisa'])->syncRoles([$role1]);
            Permission::create(['name' => 'currency-exchanges.edit', 'description' => 'Editar Cambio de Divisa'])->syncRoles([$role1]);
            Permission::create(['name' => 'currency-exchanges.destroy', 'description' => 'Eliminar Cambio de Divisa'])->syncRoles([$role1]);
        
    }
}
