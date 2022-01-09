<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Exports\PurchaseExport;
use App\Http\Requests\ReportRequest;
use App\Models\Purchase;
use Facade\FlareClient\Report;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Barryvdh\DomPDF\PDF;
use App\Services\ReportService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;

class ReportController extends Controller
{
    public $reportService;

    public function __construct()
    {
        $this->reportService = new ReportService();
    }

    public function purchases(ReportRequest $request)
    {
        $purchases = ReportService::purchases($request->all());
        return response()->json($purchases, 200);
    }

    public function cashboxes(ReportRequest $request)
    {
        $cashboxes = $this->reportService->cashboxes($request->all());
        return response()->json($cashboxes, 200);
    }

    public function sales(ReportRequest $request)
    {
        $sales = ReportService::sales($request->all());
        return response()->json($sales, 200);
    }

    public function products(ReportRequest $request)
    {
        $products = ReportService::products($request->all());
        return response()->json($products, 200);
    }

    public function inventory(ReportRequest $request)
    {
        return response()->json($request, 200);
    }

    public function details(ReportRequest $request)
    {
        $sales = $this->reportService->details($request->all());
        return response()->json($sales, 200);
    }

    public function utility(ReportRequest $request)
    {
        $utility = $this->reportService->utility($request->all());
        $products = $this->reportService->mostSelledProducts($request->all());

        return response()->json(['utility' => $utility, 'msp' => $products], 200);
    }

    public function printReportSalesDetails($fromDate, $untilDate, $branch_id = null, $customer_id = null, $product_id = null)
    {
        $filters['fromDate'] = $fromDate;
        $filters['untilDate'] = $untilDate;
        $filters['branch_id'] = $branch_id == 'null' ? null : $branch_id;
        $filters['customer_id'] = $customer_id == 'null' ? null : $customer_id;
        $filters['product_id'] = $product_id == 'null' ? null : $product_id;

        $sales = $this->reportService->details($filters);
        $pdf = \PDF::loadView('templates.pdf.reports.details', compact('filters', 'sales'))->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function ReportSales($type, $fromDate, $untilDate, $branch_id = null, $customer_id = null, $voucher_type_id = null)
    {

        $filters['fromDate'] = $fromDate;
        $filters['untilDate'] = $untilDate;
        $filters['branch_id'] = $branch_id == 'null' ? null : $branch_id;
        $filters['customer_id'] = $customer_id == 'null' ? null : $customer_id;
        $filters['voucher_type_id'] = $voucher_type_id == 'null' ? null : $voucher_type_id;


        if ($type == 'excel') {
            return Excel::download(new SalesExport($filters), 'sales.xlsx');
        } else {
            $sales = ReportService::sales($filters);
            $pdf = \PDF::loadView('templates.pdf.reports.sales', compact('filters', 'sales'))->setPaper('A4', 'landscape');
            return $pdf->stream();
        }
    }

    public function reportProducts($type, $branch_id = null)
    {
        $filters['branch_id'] = $branch_id == 'null' ? null : $branch_id;

        if ($type == 'excel') {
            return Excel::download(new ProductExport($filters), 'product.xlsx');
        } else {
            $products = ReportService::products($filters);
            $pdf = \PDF::loadView('templates.pdf.reports.products', compact('filters', 'products'))->setPaper('A4', 'landscape');
            return $pdf->stream();
        }
    }


    public function reportPurchases($type, $fromDate, $untilDate, $branch_id = null, $provider_id = null, $document_type = null)
    {
        $filters['fromDate'] = $fromDate;
        $filters['untilDate'] = $untilDate;
        $filters['branch_id'] = $branch_id == 'null' ? null : $branch_id;
        $filters['provider_id'] = $provider_id == 'null' ? null : $provider_id;
        $filters['document_type'] = $document_type == 'null' ? null : $document_type;

        if ($type == 'excel') {
            return Excel::download(new PurchaseExport($filters), 'purchases.xlsx');
        } else {
            $purchases = ReportService::purchases($filters);
            $pdf = \PDF::loadView('templates.pdf.reports.purchases', compact('filters', 'purchases'))->setPaper('A4', 'landscape');
            return $pdf->stream();
        }
    }
}
