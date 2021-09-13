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
            ['active' => true, 'brand_line_id' => 1, 'referential_sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'name' => 'GTX 1050ti', 'description' => 'Tarjeta de video barata', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 2, 'referential_sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'name' => 'GTX 1050ti', 'description' => 'Tarjeta de video barata', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 1, 'referential_sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'name' => 'GTX 750ti', 'description' => 'Tarjeta de video barata', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 2, 'referential_sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'name' => 'GTX 750ti', 'description' => 'Tarjeta de video barata', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 3, 'referential_sale_price' => 300.000, 'referential_sale_price_one' => 400.000,'referential_sale_price_two' => 500.000, 'name' => 'Case Grande', 'description' => 'Espacioso para guardar los componentes', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 4, 'referential_sale_price' => 800.000, 'referential_sale_price_one' => 800.000,'referential_sale_price_two' => 900.000, 'name' => 'AMD Ryzen 3', 'description' => 'Procesador de 4 nucleos', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 4, 'referential_sale_price' => 1200.000, 'referential_sale_price_one' => 1300.000,'referential_sale_price_two' => 1400.000, 'name' => 'AMD Ryzen 5', 'description' => 'Procesador de 6 nucleos', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 5, 'referential_sale_price' => 750.000, 'referential_sale_price_one' => 850.000,'referential_sale_price_two' => 950.000, 'name' => 'Intel i3 10ma generacion', 'description' => 'Procesador de 4 nucleos', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 5, 'referential_sale_price' => 1400.000, 'referential_sale_price_one' => 1500.000,'referential_sale_price_two' => 1600.000, 'name' => 'Intel i5 10ma generacion', 'description' => 'Procesador de 6 nucleos', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 5, 'referential_sale_price' => 1900.000, 'referential_sale_price_one' => 2000.000,'referential_sale_price_two' => 2100.000, 'name' => 'Intel i7 10ma generacion', 'description' => 'Procesador de 8 nucleos', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 7, 'referential_sale_price' => 200.000, 'referential_sale_price_one' => 300.000,'referential_sale_price_two' => 400.000, 'name' => 'Disco Duro 1tb', 'description' => 'Disco duro con capacidad de 1tb', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 8, 'referential_sale_price' => 200.000, 'referential_sale_price_one' => 300.000,'referential_sale_price_two' => 400.000, 'name' => 'RAM 8GB', 'description' => 'Memoria RAM', 'igv_type_id' => 8],
            ['active' => true, 'brand_line_id' => 6, 'referential_sale_price' => 200.000, 'referential_sale_price_one' => 300.000,'referential_sale_price_two' => 400.000, 'name' => 'MotherBoard MB10X', 'description' => 'Soporta hasta 32gb de RAM', 'igv_type_id' => 8]
        ]);

        DB::table('branch_product')->insert([
            ['product_id' => 1, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'igv_type_id' => 8],
            ['product_id' => 2, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'igv_type_id' => 8],
            ['product_id' => 3, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'igv_type_id' => 8],
            ['product_id' => 4, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'igv_type_id' => 8],
            ['product_id' => 5, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 300.000, 'referential_sale_price_one' => 400.000,'referential_sale_price_two' => 500.000, 'igv_type_id' => 8],
            ['product_id' => 6, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 800.000, 'referential_sale_price_one' => 800.000,'referential_sale_price_two' => 900.000, 'igv_type_id' => 8],
            ['product_id' => 7, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1200.000, 'referential_sale_price_one' => 1300.000,'referential_sale_price_two' => 1400.000, 'igv_type_id' => 8],
            ['product_id' => 8, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 750.000, 'referential_sale_price_one' => 850.000,'referential_sale_price_two' => 950.000, 'igv_type_id' => 8],
            ['product_id' => 9, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1400.000, 'referential_sale_price_one' => 1500.000,'referential_sale_price_two' => 1600.000, 'igv_type_id' => 8],
            ['product_id' => 10, 'branch_id' => 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1900.000, 'referential_sale_price_one' => 2000.000,'referential_sale_price_two' => 2100.000, 'igv_type_id' => 8],

            ['product_id' => 1, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'igv_type_id' => 8],
            ['product_id' => 2, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'igv_type_id' => 8],
            ['product_id' => 3, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'igv_type_id' => 8],
            ['product_id' => 4, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'igv_type_id' => 8],
            ['product_id' => 5, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 300.000, 'referential_sale_price_one' => 400.000,'referential_sale_price_two' => 500.000, 'igv_type_id' => 8],
            // ['product_id' => 6, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 800.000, 'referential_sale_price_one' => 800.000,'referential_sale_price_two' => 900.000, 'igv_type_id' => 8],
            // ['product_id' => 7, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1200.000, 'referential_sale_price_one' => 1300.000,'referential_sale_price_two' => 1400.000, 'igv_type_id' => 8],
            // ['product_id' => 8, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 750.000, 'referential_sale_price_one' => 850.000,'referential_sale_price_two' => 950.000, 'igv_type_id' => 8],
            // ['product_id' => 9, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1400.000, 'referential_sale_price_one' => 1500.000,'referential_sale_price_two' => 1600.000, 'igv_type_id' => 8],
            // ['product_id' => 10, 'branch_id' => 2, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1900.000, 'referential_sale_price_one' => 2000.000,'referential_sale_price_two' => 2100.000, 'igv_type_id' => 8],

            ['product_id' => 1, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'igv_type_id' => 8],
            ['product_id' => 2, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1500.000, 'referential_sale_price_one' => 1600.000,'referential_sale_price_two' => 1700.000, 'igv_type_id' => 8],
            ['product_id' => 3, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'igv_type_id' => 8],
            // ['product_id' => 4, 'branch_id' 3> 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 850.000, 'referential_sale_price_one' => 950.000,'referential_sale_price_two' => 1050.000, 'igv_type_id' => 8],
            // ['product_id' => 5, 'branch_id' 3> 1, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 300.000, 'referential_sale_price_one' => 400.000,'referential_sale_price_two' => 500.000, 'igv_type_id' => 8],
            // ['product_id' => 6, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 800.000, 'referential_sale_price_one' => 800.000,'referential_sale_price_two' => 900.000, 'igv_type_id' => 8],
            // ['product_id' => 7, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1200.000, 'referential_sale_price_one' => 1300.000,'referential_sale_price_two' => 1400.000, 'igv_type_id' => 8],
            // ['product_id' => 8, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 750.000, 'referential_sale_price_one' => 850.000,'referential_sale_price_two' => 950.000, 'igv_type_id' => 8],
            // ['product_id' => 9, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1400.000, 'referential_sale_price_one' => 1500.000,'referential_sale_price_two' => 1600.000, 'igv_type_id' => 8],
            // ['product_id' => 10, 'branch_id' => 3, 'manager_series' => true, 'active' => true, 'stock' => 10, 'sale_price' => 1900.000, 'referential_sale_price_one' => 2000.000,'referential_sale_price_two' => 2100.000, 'igv_type_id' => 8]
        ]);

        DB::table('branch_product_series')->insert([
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX00N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX01N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX02N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX03N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX04N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX05N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX06N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX07N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX08N'],
            ['branch_product_id' => 1, 'sold' => false, 'active' => true, 'serie' => 'SDX09N'],

            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX10N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX11N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX12N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX13N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX14N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX15N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX16N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX17N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX18N'],
            ['branch_product_id' => 2, 'sold' => false, 'active' => true, 'serie' => 'SDX19N'],

            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX20N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX21N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX22N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX23N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX24N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX25N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX26N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX27N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX28N'],
            ['branch_product_id' => 3, 'sold' => false, 'active' => true, 'serie' => 'SDX29N'],

            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX30N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX31N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX32N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX33N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX34N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX35N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX36N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX37N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX38N'],
            ['branch_product_id' => 4, 'sold' => false, 'active' => true, 'serie' => 'SDX39N'],

            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX40N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX41N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX42N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX43N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX44N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX45N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX46N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX47N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX48N'],
            ['branch_product_id' => 5, 'sold' => false, 'active' => true, 'serie' => 'SDX49N'],

            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX50N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX51N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX52N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX53N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX54N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX55N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX56N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX57N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX58N'],
            ['branch_product_id' => 6, 'sold' => false, 'active' => true, 'serie' => 'SDX59N'],
            
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX60N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX61N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX62N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX63N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX64N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX65N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX66N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX67N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX68N'],
            ['branch_product_id' => 7, 'sold' => false, 'active' => true, 'serie' => 'SDX69N'],

            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX70N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX71N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX72N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX73N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX74N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX75N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX76N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX77N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX78N'],
            ['branch_product_id' => 8, 'sold' => false, 'active' => true, 'serie' => 'SDX79N'],

            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX80N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX81N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX82N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX83N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX84N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX85N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX86N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX87N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX88N'],
            ['branch_product_id' => 9, 'sold' => false, 'active' => true, 'serie' => 'SDX89N'],

            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX90N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX91N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX92N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX93N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX94N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX95N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX96N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX97N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX98N'],
            ['branch_product_id' => 10, 'sold' => false, 'active' => true, 'serie' => 'SDX99N'],
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
