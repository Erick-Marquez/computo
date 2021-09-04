<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('voucher_types')->insert([
            ['active' => true, 'description' => 'FACTURA ELECTRÓNICA'],
            ['active' => true, 'description' => 'BOLETA DE VENTA ELECTRÓNICA'],
            ['active' => true, 'description' => 'NOTA DE VENTA ELECTRÓNICA'],
            ['active' => true, 'description' => 'NOTA DE CRÉDITO'],
            ['active' => true, 'description' => 'NOTA DE DÉBITO']
        ]);

        DB::table('series')->insert([
            ['active' => true, 'serie' => 'F001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 1],
            ['active' => true, 'serie' => 'B001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 2],
            ['active' => true, 'serie' => 'N001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 3],
            ['active' => true, 'serie' => 'NC01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'ND01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 5],

            ['active' => true, 'serie' => 'F021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 1],
            ['active' => true, 'serie' => 'B021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 2],
            ['active' => true, 'serie' => 'N021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 3],
            ['active' => true, 'serie' => 'NC21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'ND21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 5],

            ['active' => true, 'serie' => 'F031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 1],
            ['active' => true, 'serie' => 'B031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 2],
            ['active' => true, 'serie' => 'N031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 3],
            ['active' => true, 'serie' => 'NC31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'ND31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 5],
        ]);
    }
}
