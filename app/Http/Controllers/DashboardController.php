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
                ->select(DB::raw('DATE(sales.created_at) as x'), DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.cod', '01')
                ->where('sales.created_at', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.created_at')
                ->get(); // OBJETO {X: , Y: }

            $boletas = DB::table('sales')
                ->join('series', 'sales.serie_id', '=', 'series.id')
                ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
                ->select(DB::raw('DATE(sales.created_at) as x'), DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.cod', '03')
                ->where('sales.created_at', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.created_at')
                ->get(); // OBJETO {X: , Y: }

            $notas_venta = DB::table('sales')
                ->join('series', 'sales.serie_id', '=', 'series.id')
                ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
                ->select(DB::raw('DATE(sales.created_at) as x'), DB::raw('COUNT(sales.id) as y'))
                ->where('series.branch_id', $user_id,)
                ->where('voucher_types.id', 3)
                ->where('sales.created_at', '>', $mes_anterior)
                ->groupBy('voucher_types.description')
                ->groupBy('sales.created_at')
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

    public function amountTypePayment()
    {
        $mes_anterior = date('y-m-d', strtotime('-30 day'));
        $query = DB::table('sales')
        ->join('payment_type_sale', 'sales.id', '=', 'payment_type_sale.sale_id')
        ->join('payment_types', 'payment_type_sale.payment_type_id', '=', 'payment_types.id')
        ->select('payment_types.description', DB::raw('SUM(payment_type_sale.amount) as amount'))

        ->groupBy('payment_types.description')
        ->where('sales.created_at', '>=', $mes_anterior)
        ->get(); // OBJETO {X: , Y: }

        return response()->json($query);

    }
}
