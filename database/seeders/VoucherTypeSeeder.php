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
            'address' => 'PRO. HUALLAYCO  NRO. 190   HUáNUCO -  HUáNUCO -  HUANUCO', 'ubigeo' => '100101']
        ]);

        DB::table('branches')->insert([
            ['state' => true, 'description' => 'HUANUCO'],
            ['state' => true, 'description' => 'AMARILIS'],
            ['state' => true, 'description' => 'PILLCO MARCA']
        ]);

        DB::table('igv_types')->insert([
            ['cod' => '10', 'description' => 'Gravado - Operación Onerosa'],
            ['cod' => '11', 'description' => '[Gratuita] Gravado - Retiro por premio'],
            ['cod' => '12', 'description' => '[Gratuita] Gravado - Retiro por donación'],
            ['cod' => '13', 'description' => '[Gratuita] Gravado - Retiro'],
            ['cod' => '14', 'description' => '[Gratuita] Gravado - Retiro por publicidad'],
            ['cod' => '15', 'description' => '[Gratuita] Gravado - Bonificaciones'],
            ['cod' => '16', 'description' => '[Gratuita] Gravado - Retiro por entrega a trabajadores'],
            ['cod' => '20', 'description' => 'Exonerado - Operación Onerosa'],
            ['cod' => '30', 'description' => 'Inafecto - Operación Onerosa'],
            ['cod' => '31', 'description' => '[Gratuita] Inafecto - Retiro por Bonificación'],
            ['cod' => '32', 'description' => '[Gratuita] Inafecto - Retiro'],
            ['cod' => '33', 'description' => '[Gratuita] Inafecto - Retiro por Muestras Medicas'],
            ['cod' => '34', 'description' => '[Gratuita] Inafecto - Retiro por Convenio Colectivo'],
            ['cod' => '35', 'description' => '[Gratuita] Inafecto - Retiro por Premio'],
            ['cod' => '36', 'description' => '[Gratuita] Inafecto - Retiro por Publicidad'],
            ['cod' => '40', 'description' => 'Exportación'],
        ]);

        DB::table('credit_note_types')->insert([
            ['cod' => '01', 'description' => 'Anulación de la operación'],
            ['cod' => '02', 'description' => 'Anulación por error en el RUC'],
            ['cod' => '03', 'description' => 'Corrección por error en la descripción'],
            ['cod' => '04', 'description' => 'Descuento global'],
            ['cod' => '05', 'description' => 'Descuento por ítem'],
            ['cod' => '06', 'description' => 'Devolución total'],
            ['cod' => '07', 'description' => 'Devolución por ítem'],
            ['cod' => '08', 'description' => 'Bonificación'],
            ['cod' => '09', 'description' => 'Disminución en el valor'],
            ['cod' => '10', 'description' => 'Otros Conceptos'],
            ['cod' => '11', 'description' => 'Ajustes de operaciones de exportación'],
            ['cod' => '12', 'description' => 'Ajustes afectos al IVAP']
        ]);

        DB::table('debit_note_types')->insert([
            ['cod' => '01', 'description' => 'Intereses por mora'],
            ['cod' => '02', 'description' => 'Aumento en el valor'],
            ['cod' => '03', 'description' => 'Penalidades/ otros conceptos'],
            ['cod' => '10', 'description' => 'Ajustes de operaciones de exportación'],
            ['cod' => '11', 'description' => 'Ajustes afectos al IVAP']
        ]);

        DB::table('voucher_types')->insert([
            ['active' => true, 'cod' => '01', 'description' => 'FACTURA'],
            ['active' => true, 'cod' => '03', 'description' => 'BOLETA DE VENTA'],
            ['active' => true, 'cod' => 'NV', 'description' => 'NOTA DE VENTA'],
            ['active' => true, 'cod' => '07', 'description' => 'NOTA DE CRÉDITO'],
            ['active' => true, 'cod' => '08', 'description' => 'NOTA DE DÉBITO']
        ]);

        DB::table('identification_documents')->insert([
            ['cod' => '1','description' => 'DNI'],
            ['cod' => '6','description' => 'RUC'],
            ['cod' => '7','description' => 'PASAPORTE'],
            ['cod' => '4','description' => 'CARNET DE EXTRANJERIA']
        ]);

        DB::table('series')->insert([
            ['active' => true, 'serie' => 'F001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 1],
            ['active' => true, 'serie' => 'B001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 2],
            ['active' => true, 'serie' => 'N001', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 3],
            ['active' => true, 'serie' => 'FC01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'BC01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'FD01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 5],
            ['active' => true, 'serie' => 'BD01', 'current_number' => 0, 'branch_id' => 1, 'voucher_type_id' => 5],

            ['active' => true, 'serie' => 'F021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 1],
            ['active' => true, 'serie' => 'B021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 2],
            ['active' => true, 'serie' => 'N021', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 3],
            ['active' => true, 'serie' => 'FC21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'BC21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'FD21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 5],
            ['active' => true, 'serie' => 'BD21', 'current_number' => 0, 'branch_id' => 2, 'voucher_type_id' => 5],

            ['active' => true, 'serie' => 'F031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 1],
            ['active' => true, 'serie' => 'B031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 2],
            ['active' => true, 'serie' => 'N031', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 3],
            ['active' => true, 'serie' => 'FC31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'BC31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 4],
            ['active' => true, 'serie' => 'FD31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 5],
            ['active' => true, 'serie' => 'BD31', 'current_number' => 0, 'branch_id' => 3, 'voucher_type_id' => 5],
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
