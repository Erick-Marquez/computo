<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Serie;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function vouchers()
    {
        $mes_anterior = date('y-m-d', strtotime('-30 day'));
        $user_id = auth()->user()->id;

        $fechas = [];

        for ($i = 0; $i < 30; $i++) {
            $fechas[$i] = date('Y-m-d', strtotime("-$i day"));
        }

        $fechas = collect($fechas);

        try {
            $facturas = DB::table('sales')
                ->join('series', 'sales.serie_id', '=', 'series.id')
                ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
                ->select('sales.date_issue as x', DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.id', 1)
                ->where('sales.date_issue', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.date_issue')
                ->get(); // OBJETO {X: , Y: }

            $boletas = DB::table('sales')
                ->join('series', 'sales.serie_id', '=', 'series.id')
                ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
                ->select('sales.date_issue as x', DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.id', 2)
                ->where('sales.date_issue', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.date_issue')
                ->get(); // OBJETO {X: , Y: }

            $notas_venta = DB::table('sales')
                ->join('series', 'sales.serie_id', '=', 'series.id')
                ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
                ->select('sales.date_issue as x', DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.id', 3)
                ->where('sales.date_issue', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.date_issue')
                ->get(); // OBJETO {X: , Y: }

            return response()->json(['facturas' => $facturas, 'boletas' => $boletas, 'notas_venta' => $notas_venta, 'fechas' => $fechas]);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
