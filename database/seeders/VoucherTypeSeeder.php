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
        DB::table('company')->insert([
            ['ruc' => '20100066603', 'name' => 'Demo Computo', 'comercial_name' => 'Demo Computo',
            'address' => 'PRO. HUALLAYCO  NRO. 190', 'ubigeo' => '100101']
        ]);

        DB::table('branches')->insert([
            ['state' => true, 'description' => 'HUANUCO'],
            ['state' => true, 'description' => 'AMARILIS'],
            ['state' => true, 'description' => 'PILLCO MARCA']
        ]);

        DB::table('igv_types')->insert([
            ['id' => '10', 'description' => 'Gravado - Operación Onerosa'],
            ['id' => '11', 'description' => '[Gratuita] Gravado - Retiro por premio'],
            ['id' => '12', 'description' => '[Gratuita] Gravado - Retiro por donación'],
            ['id' => '13', 'description' => '[Gratuita] Gravado - Retiro'],
            ['id' => '14', 'description' => '[Gratuita] Gravado - Retiro por publicidad'],
            ['id' => '15', 'description' => '[Gratuita] Gravado - Bonificaciones'],
            ['id' => '16', 'description' => '[Gratuita] Gravado - Retiro por entrega a trabajadores'],
            ['id' => '20', 'description' => 'Exonerado - Operación Onerosa'],
            ['id' => '30', 'description' => 'Inafecto - Operación Onerosa'],
            ['id' => '31', 'description' => '[Gratuita] Inafecto - Retiro por Bonificación'],
            ['id' => '32', 'description' => '[Gratuita] Inafecto - Retiro'],
            ['id' => '33', 'description' => '[Gratuita] Inafecto - Retiro por Muestras Medicas'],
            ['id' => '34', 'description' => '[Gratuita] Inafecto - Retiro por Convenio Colectivo'],
            ['id' => '35', 'description' => '[Gratuita] Inafecto - Retiro por Premio'],
            ['id' => '36', 'description' => '[Gratuita] Inafecto - Retiro por Publicidad'],
            ['id' => '40', 'description' => 'Exportación'],
        ]);

        DB::table('credit_note_types')->insert([
            ['id' => '01', 'description' => 'Anulación de la operación'],
            ['id' => '02', 'description' => 'Anulación por error en el RUC'],
            ['id' => '03', 'description' => 'Corrección por error en la descripción'],
            ['id' => '04', 'description' => 'Descuento global'],
            ['id' => '05', 'description' => 'Descuento por ítem'],
            ['id' => '06', 'description' => 'Devolución total'],
            ['id' => '07', 'description' => 'Devolución por ítem'],
            ['id' => '08', 'description' => 'Bonificación'],
            ['id' => '09', 'description' => 'Disminución en el valor'],
            ['id' => '10', 'description' => 'Otros Conceptos'],
            ['id' => '11', 'description' => 'Ajustes de operaciones de exportación'],
            ['id' => '12', 'description' => 'Ajustes afectos al IVAP']
        ]);

        DB::table('debit_note_types')->insert([
            ['id' => '01', 'description' => 'Intereses por mora'],
            ['id' => '02', 'description' => 'Aumento en el valor'],
            ['id' => '03', 'description' => 'Penalidades/ otros conceptos'],
            ['id' => '10', 'description' => 'Ajustes de operaciones de exportación'],
            ['id' => '11', 'description' => 'Ajustes afectos al IVAP']
        ]);

        DB::table('voucher_types')->insert([
            ['id' => '01', 'description' => 'FACTURA'],
            ['id' => '03', 'description' => 'BOLETA DE VENTA'],
            ['id' => 'NV', 'description' => 'NOTA DE VENTA'],
            ['id' => '07', 'description' => 'NOTA DE CRÉDITO'],
            ['id' => '08', 'description' => 'NOTA DE DÉBITO'],
            ['id' => 'CT', 'description' => 'COTIZACIÓN'],
        ]);

        DB::table('identification_documents')->insert([
            ['id' => '1','description' => 'DNI'],
            ['id' => '6','description' => 'RUC']
        ]);

        DB::table('series')->insert([
            ['active' => true, 'serie' => 'F001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => '01'],
            ['active' => true, 'serie' => 'B001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => '03'],
            ['active' => true, 'serie' => 'N001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 'NV'],
            ['active' => true, 'serie' => 'FC01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => '07'],
            ['active' => true, 'serie' => 'BC01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => '07'],
            ['active' => true, 'serie' => 'FD01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => '08'],
            ['active' => true, 'serie' => 'BD01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => '08'],
            ['active' => true, 'serie' => 'C001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 'CT'],

            ['active' => true, 'serie' => 'F021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => '01'],
            ['active' => true, 'serie' => 'B021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => '03'],
            ['active' => true, 'serie' => 'N021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 'NV'],
            ['active' => true, 'serie' => 'FC21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => '07'],
            ['active' => true, 'serie' => 'BC21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => '07'],
            ['active' => true, 'serie' => 'FD21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => '08'],
            ['active' => true, 'serie' => 'BD21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => '08'],
            ['active' => true, 'serie' => 'C021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 'CT'],

            ['active' => true, 'serie' => 'F031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => '01'],
            ['active' => true, 'serie' => 'B031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => '03'],
            ['active' => true, 'serie' => 'N031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 'NV'],
            ['active' => true, 'serie' => 'FC31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => '07'],
            ['active' => true, 'serie' => 'BC31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => '07'],
            ['active' => true, 'serie' => 'FD31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => '08'],
            ['active' => true, 'serie' => 'BD31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => '08'],
            ['active' => true, 'serie' => 'C031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 'CT'],
        ]);

        DB::table('families')->insert([
            ['active' => true, 'description' => 'Hardware'],
            ['active' => true, 'description' => 'Software'],
            ['active' => true, 'description' => 'Periféricos de Entrada'],
            ['active' => true, 'description' => 'Redes']
        ]);

        DB::table('lines')->insert([
            ['active' => true, 'family_id' => 1, 'description' => 'Tarjeta de Video'],
            ['active' => true, 'family_id' => 1, 'description' => 'Case'],
            ['active' => true, 'family_id' => 1, 'description' => 'Procesador'],
            ['active' => true, 'family_id' => 1, 'description' => 'Placa Base'],
            ['active' => true, 'family_id' => 1, 'description' => 'Disco Duro'],
            ['active' => true, 'family_id' => 1, 'description' => 'Memoria RAM']
        ]);

        DB::table('brands')->insert([
            ['active' => true, 'description' => 'Nvidia'],
            ['active' => true, 'description' => 'AMD'],
            ['active' => true, 'description' => 'Antrix'],
            ['active' => true, 'description' => 'Intel'],
            ['active' => true, 'description' => 'Kingston'],
            ['active' => true, 'description' => 'Gigabyte'],
            ['active' => true, 'description' => 'Western Digital']
        ]);

        DB::table('brand_line')->insert([
            ['line_id' => 1, 'brand_id' => 1],
            ['line_id' => 1, 'brand_id' => 2],
            ['line_id' => 2, 'brand_id' => 3],
            ['line_id' => 3, 'brand_id' => 2],
            ['line_id' => 3, 'brand_id' => 4],
            ['line_id' => 4, 'brand_id' => 6],
            ['line_id' => 5, 'brand_id' => 7],
            ['line_id' => 6, 'brand_id' => 5]
        ]);
    }
}
