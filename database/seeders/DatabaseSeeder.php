<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Provider;
use App\Models\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Type\VoidType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // suscursales
        Storage::deleteDirectory('public/assemblies');
        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/assemblies');
        Storage::makeDirectory('public/products');

        //Direcrotios Facturacion
        Storage::deleteDirectory('Facturacion/Baja/Cdr');
        Storage::deleteDirectory('Facturacion/Baja/Xml');
        Storage::deleteDirectory('Facturacion/Baja/ZipXml');

        Storage::deleteDirectory('Facturacion/Boleta/Cdr');
        Storage::deleteDirectory('Facturacion/Boleta/Xml');
        Storage::deleteDirectory('Facturacion/Boleta/ZipXml');

        Storage::deleteDirectory('Facturacion/Factura/Cdr');
        Storage::deleteDirectory('Facturacion/Factura/Xml');
        Storage::deleteDirectory('Facturacion/Factura/ZipXml');

        Storage::deleteDirectory('Facturacion/NotaCredito/Cdr');
        Storage::deleteDirectory('Facturacion/NotaCredito/Xml');
        Storage::deleteDirectory('Facturacion/NotaCredito/ZipXml');

        Storage::deleteDirectory('Facturacion/NotaDebito/Cdr');
        Storage::deleteDirectory('Facturacion/NotaDebito/Xml');
        Storage::deleteDirectory('Facturacion/NotaDebito/ZipXml');



        Storage::makeDirectory('Facturacion/Baja/Cdr');
        Storage::makeDirectory('Facturacion/Baja/Xml');
        Storage::makeDirectory('Facturacion/Baja/ZipXml');

        Storage::makeDirectory('Facturacion/Boleta/Cdr');
        Storage::makeDirectory('Facturacion/Boleta/Xml');
        Storage::makeDirectory('Facturacion/Boleta/ZipXml');

        Storage::makeDirectory('Facturacion/Factura/Cdr');
        Storage::makeDirectory('Facturacion/Factura/Xml');
        Storage::makeDirectory('Facturacion/Factura/ZipXml');

        Storage::makeDirectory('Facturacion/NotaCredito/Cdr');
        Storage::makeDirectory('Facturacion/NotaCredito/Xml');
        Storage::makeDirectory('Facturacion/NotaCredito/ZipXml');

        Storage::makeDirectory('Facturacion/NotaDebito/Cdr');
        Storage::makeDirectory('Facturacion/NotaDebito/Xml');
        Storage::makeDirectory('Facturacion/NotaDebito/ZipXml');

        $this->call(RoleSeeder::class);
        $this->call(VoucherTypeSeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(UbigeeSeeder::class);

        // Provider::factory(10)->create();

        // Customer::factory(50)->customerWithDni()->create();
        // Customer::factory(50)->customerWithRuc()->create();

        $this->call(UserSeeder::class);
        $this->call(CurrencyExchangeSeeder::class);

        //Sale::factory(1000)->create();

        //\App\Models\Product::factory(3000)->create();
        //\App\Models\BranchProduct::factory(9000)->create();
    }
}
