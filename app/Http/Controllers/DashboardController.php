<?php

namespace App\Http\Controllers;

use App\Models\BranchProduct;
use App\Models\Product;
use App\Models\Purchase;
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
                ->where('voucher_types.cod', '01')
                ->where('sales.date_issue', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.date_issue')
                ->get(); // OBJETO {X: , Y: }

            $boletas = DB::table('sales')
                ->join('series', 'sales.serie_id', '=', 'series.id')
                ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
                ->select('sales.date_issue as x', DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.cod', '03')
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

    public function widgets()
    {
        $branch_id = auth()->user()->branch_id;

        // *ToDo: Agregar el opcc_id del user para que sea global o especifico
        $purchases = Purchase::getPurchasesToday();
        $sales = Sale::getSalesToday();

        $products = BranchProduct::getNumberProductsBranch($branch_id);

        return response()->json([
            'purchases' => $purchases,
            'sales' => $sales,
            'products' => $products
        ]);
    }
}
