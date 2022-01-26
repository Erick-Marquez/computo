<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ReportService
{
    public static function purchases($request)
    {
        $purchases = DB::table('purchases')
            ->join('open_closed_cashboxes', 'purchases.open_closed_cashbox_id', '=', 'open_closed_cashboxes.id')
            ->join('cashboxes', 'open_closed_cashboxes.cashbox_id', '=', 'cashboxes.id')
            ->join('providers', 'purchases.provider_id', '=', 'providers.id')
            ->join('identification_documents as id', 'providers.identification_document_id', '=', 'id.id')
            ->select('purchases.*', 'providers.name as provider_name', 'providers.document as provider_document', 'id.description as provider_document_type')
            ->whereDate('purchases.date_issue', '>=', $request['fromDate'])
            ->whereDate('purchases.date_issue', '<=', $request['untilDate']);

        $purchases = is_null($request['document_type']) ?  $purchases : $purchases->where('purchases.document_type', '=', $request['document_type']);
        $purchases = is_null($request['branch_id']) ?  $purchases : $purchases->where('cashboxes.branch_id', '=', $request['branch_id']);
        $purchases = is_null($request['provider_id']) ?  $purchases : $purchases->where('purchases.provider_id', '=', $request['provider_id']);

        $purchases = $purchases->get();

        return $purchases;
    }

    public function cashboxes($request)
    {
        $cashboxes = DB::table('open_closed_cashboxes as occ')
            ->join('cashboxes as c', 'occ.cashbox_id', '=', 'c.id')
            ->join('users as u', 'occ.user_id', '=', 'u.id')
            ->select('occ.id', 'occ.opening_date', 'occ.opening_amount', 'occ.closing_date', 'occ.closing_amount', 'c.description as cashbox_name', 'u.name as user_name')
            ->whereDate('occ.opening_date', '>=', $request['fromDate'])
            ->whereDate('occ.opening_date', '<=', $request['untilDate']);

        $cashboxes = is_null($request['cashbox_id']) ? $cashboxes : $cashboxes->where('c.id', $request['cashbox_id']);
        $cashboxes = is_null($request['branch_id']) ? $cashboxes : $cashboxes->where('c.branch_id', $request['branch_id']);

        $cashboxes = $cashboxes->get();

        return $cashboxes;
    }

    public static function sales($request)
    {
        $sales = DB::table('sales as s')
            ->join('open_closed_cashboxes as occ', 's.open_closed_cashbox_id', '=', 'occ.id')
            ->join('cashboxes as c', 'occ.cashbox_id', '=', 'c.id')
            ->join('series', 's.serie_id', '=', 'series.id')
            ->join('voucher_types as vt', 'series.voucher_type_id', '=', 'vt.id')
            ->join('customers as cust', 's.customer_id', '=', 'cust.id')
            ->join('identification_documents as id', 'cust.identification_document_id', '=', 'id.id')
            ->join('quotations as q', 's.id', '=', 'q.sale_id')
            ->select('s.*', 'series.serie', 'vt.description as voucher_type', 'cust.name as customer_name', 'cust.document as customer_document', 'id.description as customer_document_type')
            ->whereDate('s.created_at', '>=', $request['fromDate'])
            ->whereDate('s.created_at', '<=', $request['untilDate']);

        $sales = is_null($request['voucher_type_id']) ?  $sales : $sales->where('vt.id', '=', $request['voucher_type_id']);
        $sales = is_null($request['branch_id']) ?  $sales : $sales->where('c.branch_id', '=', $request['branch_id']);
        $sales = is_null($request['customer_id']) ?  $sales : $sales->where('s.customer_id', '=', $request['customer_id']);
        $sales = is_null($request['seller_id']) ?  $sales : $sales->where('q.user_id', '=', $request['seller_id']);

        $sales = $sales->get();

        return $sales;
    }

    public static function products($request)
    {
        $products = DB::table('branch_product as bp')
            ->join('products as p', 'bp.product_id', '=', 'p.id')
            ->join('brands as b', 'p.brand_id', '=', 'b.id')
            ->join('lines as l', 'p.line_id', '=', 'l.id')
            ->select('p.cod', 'p.name', 'l.description as line', 'b.description as brand', 'bp.*')
            ->where('bp.branch_id', $request['branch_id'])
            ->get();

        return $products;
    }

    public function inventory($request)
    {
        return $request;
    }

    public function details($request)
    {
        $sales = DB::table('sales as s')
            ->join('sale_details as sd', 's.id', '=', 'sd.sale_id')
            ->join('branch_product as bp', 'sd.branch_product_id', '=', 'bp.id')
            ->join('products as p', 'bp.product_id', '=', 'p.id')
            ->join('brands as b', 'p.brand_id', '=', 'b.id')
            ->join('lines as l', 'p.line_id', '=', 'l.id')
            ->join('open_closed_cashboxes as occ', 's.open_closed_cashbox_id', '=', 'occ.id')
            ->join('cashboxes as c', 'occ.cashbox_id', '=', 'c.id')
            ->join('series', 's.serie_id', '=', 'series.id')
            ->join('voucher_types as vt', 'series.voucher_type_id', '=', 'vt.id')
            ->join('customers as cust', 's.customer_id', '=', 'cust.id')
            ->join('identification_documents as id', 'cust.identification_document_id', '=', 'id.id')
            ->select(
                'vt.description as voucher_type',
                's.date_issue as date',
                'series.serie',
                's.document_number',
                's.total_exonerated',
                'cust.name',
                'p.cod',
                'p.name',
                'l.description as line',
                'b.description as brand',
                'sd.quantity',
                'sd.price',
                'sd.discount',
                'sd.total_igv',
                'sd.subtotal',
                'sd.total',
                'sd.series'
            )
            ->whereDate('s.created_at', '>=', $request['fromDate'])
            ->whereDate('s.created_at', '<=', $request['untilDate']);

        // $sales = is_null($request['voucher_type_id']) ?  $sales : $sales->where('vt.id', '=', $request['voucher_type_id']);
        $sales = is_null($request['branch_id']) ?  $sales : $sales->where('c.branch_id', '=', $request['branch_id']);
        $sales = is_null($request['customer_id']) ?  $sales : $sales->where('s.customer_id', '=', $request['customer_id']);
        $sales = is_null($request['product_id']) ?  $sales : $sales->where('bp.product_id', '=', $request['product_id']);

        $sales = $sales->get();

        return $sales;
    }

    public function utility($request)
    {
        $utility = DB::table('sales as s')
            ->join('sale_details as sd', 's.id', '=', 'sd.sale_id')
            ->join('branch_product as bp', 'sd.branch_product_id', '=', 'bp.id')
            ->join('products as p', 'bp.product_id', '=', 'p.id')
            ->join('brands as b', 'p.brand_id', '=', 'b.id')
            ->join('lines as l', 'p.line_id', '=', 'l.id')
            ->join('open_closed_cashboxes as occ', 's.open_closed_cashbox_id', '=', 'occ.id')
            ->join('cashboxes as c', 'occ.cashbox_id', '=', 'c.id')
            ->join('series', 's.serie_id', '=', 'series.id')
            ->join('voucher_types as vt', 'series.voucher_type_id', '=', 'vt.id')
            ->join('customers as cust', 's.customer_id', '=', 'cust.id')
            ->join('identification_documents as id', 'cust.identification_document_id', '=', 'id.id')
            ->select(
                'vt.description as voucher_type',
                'series.serie',
                's.document_number',
                'cust.name',
                's.date_issue',
                's.created_at',
                's.total',
                's.total_discount',
                's.state',

                DB::raw('SUM((sd.price - (bp.referential_purchase_price * 3.70) - sd.discount) * sd.quantity) as utility'),
            )
            ->whereDate('s.created_at', '>=', $request['fromDate'])
            ->whereDate('s.created_at', '<=', $request['untilDate'])
            ->groupBy(
                'voucher_type',
                'series.serie',
                's.document_number',
                'cust.name',
                's.date_issue',
                's.created_at',
                's.total',
                's.total_discount',
                's.state',
            );

        $utility = is_null($request['voucher_type_id']) ?  $utility : $utility->where('vt.id', '=', $request['voucher_type_id']);
        $utility = is_null($request['branch_id']) ?  $utility : $utility->where('c.branch_id', '=', $request['branch_id']);
        $utility = is_null($request['customer_id']) ?  $utility : $utility->where('s.customer_id', '=', $request['customer_id']);

        $utility = $utility->get();

        return $utility;
    }

    public function mostSelledProducts($filters)
    {
        $msp = DB::table('sales as s')
            ->join('sale_details as sd', 's.id', '=', 'sd.sale_id')
            ->join('branch_product as bp', 'sd.branch_product_id', '=', 'bp.id')
            ->join('products as p', 'bp.product_id', '=', 'p.id')
            ->join('brands as b', 'p.brand_id', '=', 'b.id')
            ->join('lines as l', 'p.line_id', '=', 'l.id')
            ->join('open_closed_cashboxes as occ', 's.open_closed_cashbox_id', '=', 'occ.id')
            ->join('cashboxes as c', 'occ.cashbox_id', '=', 'c.id')
            ->join('series', 's.serie_id', '=', 'series.id')
            ->join('voucher_types as vt', 'series.voucher_type_id', '=', 'vt.id')
            ->join('customers as cust', 's.customer_id', '=', 'cust.id')
            ->join('identification_documents as id', 'cust.identification_document_id', '=', 'id.id')
            ->select(
                'l.description as line',
                DB::raw('SUM(sd.quantity) as quantity')
            )
            ->whereDate('s.created_at', '>=', $filters['fromDate'])
            ->whereDate('s.created_at', '<=', $filters['untilDate']);

        $msp = is_null($filters['voucher_type_id']) ?  $msp : $msp->where('vt.id', '=', $filters['voucher_type_id']);
        $msp = is_null($filters['branch_id']) ?  $msp : $msp->where('c.branch_id', '=', $filters['branch_id']);
        $msp = is_null($filters['customer_id']) ?  $msp : $msp->where('s.customer_id', '=', $filters['customer_id']);

        $msp = $msp->groupBy('l.description')
            ->orderBy('quantity', 'desc')
            ->limit(10)
            ->get();

        return $msp;
    }
}
