<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['active' => true, 'brand_line_id' => 1, 'price' => 1500.000, 'name' => 'GTX 1050ti', 'description' => 'Tarjeta de video barata'],
            ['active' => true, 'brand_line_id' => 2, 'price' => 1500.000, 'name' => 'GTX 1050ti', 'description' => 'Tarjeta de video barata'],
            ['active' => true, 'brand_line_id' => 1, 'price' => 850.000, 'name' => 'GTX 750ti', 'description' => 'Tarjeta de video barata'],
            ['active' => true, 'brand_line_id' => 2, 'price' => 850.000, 'name' => 'GTX 750ti', 'description' => 'Tarjeta de video barata'],
            ['active' => true, 'brand_line_id' => 3, 'price' => 300.000, 'name' => 'Case Grande', 'description' => 'Espacioso para guardar los componentes'],
            ['active' => true, 'brand_line_id' => 4, 'price' => 800.000, 'name' => 'AMD Ryzen 3', 'description' => 'Procesador de 4 nucleos'],
            ['active' => true, 'brand_line_id' => 4, 'price' => 1200.000, 'name' => 'AMD Ryzen 5', 'description' => 'Procesador de 6 nucleos'],
            ['active' => true, 'brand_line_id' => 5, 'price' => 750.000, 'name' => 'Intel i3 10ma generacion', 'description' => 'Procesador de 4 nucleos'],
            ['active' => true, 'brand_line_id' => 5, 'price' => 1400.000, 'name' => 'Intel i5 10ma generacion', 'description' => 'Procesador de 6 nucleos'],
            ['active' => true, 'brand_line_id' => 5, 'price' => 1900.000, 'name' => 'Intel i7 10ma generacion', 'description' => 'Procesador de 8 nucleos'],
            ['active' => true, 'brand_line_id' => 7, 'price' => 200.000, 'name' => 'Disco Duro 1tb', 'description' => 'Disco duro con capacidad de 1tb'],
            ['active' => true, 'brand_line_id' => 8, 'price' => 200.000, 'name' => 'RAM 8GB', 'description' => 'Memoria RAM'],
            ['active' => true, 'brand_line_id' => 6, 'price' => 200.000, 'name' => 'MotherBoard MB10X', 'description' => 'Soporta hasta 32gb de RAM']
        ]);

        DB::table('branch_product')->insert([
            ['product_id' => 1, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1500.000],
            ['product_id' => 2, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1500.000],
            ['product_id' => 3, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 850.000],
            // ['product_id' => 4, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 850.000],
            // ['product_id' => 5, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 300.000],
            // ['product_id' => 6, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 800.000],
            // ['product_id' => 7, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1200.000],
            // ['product_id' => 8, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 750.000],
            // ['product_id' => 9, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1400.000],
            // ['product_id' => 10, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1900.000],

            ['product_id' => 1, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1500.000],
            ['product_id' => 2, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1500.000],
            ['product_id' => 3, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 850.000],
            ['product_id' => 4, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 850.000],
            ['product_id' => 5, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 300.000],
            // ['product_id' => 6, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 800.000],
            // ['product_id' => 7, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1200.000],
            // ['product_id' => 8, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 750.000],
            // ['product_id' => 9, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1400.000],
            // ['product_id' => 10, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1900.000],

            ['product_id' => 1, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1500.000],
            ['product_id' => 2, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1500.000],
            ['product_id' => 3, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 850.000],
            ['product_id' => 4, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 850.000],
            ['product_id' => 5, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 300.000],
            ['product_id' => 6, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 800.000],
            ['product_id' => 7, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1200.000],
            ['product_id' => 8, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 750.000],
            ['product_id' => 9, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1400.000],
            ['product_id' => 10, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'price' => 1900.000]
        ]);

        DB::table('assemblies')->insert([
            ['active' => true, 'discount' => 0, 'price' => 2000.000, 'name' => 'PC Galactica', 'description' => 'Para que puedas jugar maincra'],
            ['active' => true, 'discount' => 0, 'price' => 3000.000, 'name' => 'PC Ultra', 'description' => 'Para que puedas jugar fortin'],
        ]);

        DB::table('assembly_product')->insert([
            ['assembly_id' => 1, 'product_id' => 3, 'quantity' => 1],
            ['assembly_id' => 1, 'product_id' => 6, 'quantity' => 1],
            ['assembly_id' => 1, 'product_id' => 5, 'quantity' => 1],
            ['assembly_id' => 1, 'product_id' => 11, 'quantity' => 1],
            ['assembly_id' => 1, 'product_id' => 12, 'quantity' => 1],
            ['assembly_id' => 1, 'product_id' => 13, 'quantity' => 1],

            ['assembly_id' => 2, 'product_id' => 1, 'quantity' => 1],
            ['assembly_id' => 2, 'product_id' => 9, 'quantity' => 1],
            ['assembly_id' => 2, 'product_id' => 5, 'quantity' => 1],
            ['assembly_id' => 2, 'product_id' => 11, 'quantity' => 1],
            ['assembly_id' => 2, 'product_id' => 12, 'quantity' => 2],
            ['assembly_id' => 2, 'product_id' => 13, 'quantity' => 1],
        ]);
    }
}
