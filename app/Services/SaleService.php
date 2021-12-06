<?php

namespace App\Services;

use App\Models\BranchProduct;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Serie;
use App\Models\Warranty;
use App\Models\WarrantyDetail;
use Carbon\Carbon;

class SaleService
{
    public function storeSale($request)
    {
        if (is_null($request->customer['id'])) {

            $customer = Customer::create([
                'name' => $request->customer['name'],
                'document' => $request->customer['document'],
                'phone' => $request->customer['phone'],
                'address' => $request->customer['address'],
                'identification_document_id' => $request->customer['identification_document_id'],
            ]);

            $dataCustomer = $request->customer;
            $dataCustomer['id'] = $customer->id;

            $request->merge(['customer' => $dataCustomer]);

        }

        
        $serie = Serie::find($request->voucher['serie_id']);
        $serie->current_number = $serie->current_number + 1;
        $serie->save();

        $sale = Sale::create([
            'document_number' => $serie->current_number,
            'date_issue' => $request->voucher['date_issue'],
            'date_due' => $request->voucher['date_due'],

            'observation' => $request->voucher['observation'],
            'discount' => $request->voucher['discount'],
            

            'have_warranty' => $request->voucher['warranty'], 

            'serie_id' => $request->voucher['serie_id'],
            'customer_id' => $request->customer['id'],
            'open_closed_cashbox_id' => $request->open_closed_cashbox_id,
            'user_id' => $request->user_id
        ]);

        // Garantia
        if ($request->voucher['warranty']) {
            $serieWarranty = Serie::find($request->voucher['warranty_serie_id']);
            $serieWarranty ->current_number = $serieWarranty->current_number + 1;
            $serieWarranty ->save();

            $warranty = Warranty::create([
                'document_number' => $serieWarranty->current_number,
                'date_issue' => Carbon::now(),
    
                'discount' => $request->voucher['discount'],
    
                'serie_id' => $request->voucher['warranty_serie_id'],
                'sale_id' => $sale->id,
                'customer_id' => $request->customer['id'],
                'user_id' => $request->user_id
            ]);
        }

        $totalWarranty = 0;
        $dateDueWarranty = Carbon::now();
        // Variables para los totales de la venta
        $subtotalSale = 0;
        $totalIgvSale = 0;
        $totalExoneratedSale = 0;
        $totalUnaffectedSale = 0;
        $totalFreeSale = 0;
        $totalTaxedSale = 0;
        $totalSale = 0;

        $igv = 0.18;
        // Crear los detalles de la cotizacion
        foreach ($request->detail as $key => $detail) {

            $subtotal = 0;
            $totalIgv = 0;
            $total = 0;

            // ! EL PRECIO UNITARIO SE HALLA DIVIDIENDO EL TOTAL ENTRE LA CANTIDAD

            switch ($detail['igv_type_id']) {
                case 10:
                    // hallar el precio sin igv
                    $priceWithoutIgv = $detail['sale_price'] / (1 + $igv);

                    $detail['sale_price'] = $priceWithoutIgv;
        
                    // hallar el subtotal = (precio sin igv * cantidad) - descuento
                    $subtotal = ($priceWithoutIgv * $detail['quantity']) - $detail['discount'];
        
                    // hallar el total = (subtotal * 1.18)
                    $total = $subtotal * (1 + $igv);
                    
                    // hallar el igv = (total - subtotal)
                    $totalIgv = $total - $subtotal;
        
                    // Actualizar totales globales
                    $subtotalSale += $subtotal;
                    $totalIgvSale += $totalIgv;
                    $totalTaxedSale += $subtotal;
                    $totalSale += $total;
                    break;
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                case 16:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalSale += $subtotal;
                    $totalFreeSale += $total;
                    break;
                case 20:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalSale += $subtotal;
                    $totalExoneratedSale += $subtotal;
                    $totalSale += $total;
                    break;
                case 30:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalSale += $subtotal;
                    $totalUnaffectedSale += $subtotal;
                    $totalSale += $total;
                    break;
                case 31:
                case 32:
                case 33:
                case 34:
                case 35:
                case 36:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalSale += $subtotal;
                    $totalFreeSale += $total;
                    break;
                case 40:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalSale += $subtotal;
                    $totalUnaffectedSale += $subtotal;
                    $totalSale += $total;
                    break;
                default:
                    # code...
                    break;
            }

            // TODO AÑADIR SOLO SI EL PRODUCTO MANEJA SERIE

            $branchProduct = BranchProduct::where('id', $detail['product_id'])->with('product')->firstOrFail();

            $productSeries = [];

            if ($branchProduct->product->manager_series) {

                for ($j=0; $j < count($detail['series']) ; $j++) {
                    array_push($productSeries, $detail['series'][$j]['serie']);
                }

            }
            

            SaleDetail::create([

                'discount' => $detail['discount'],
                'price' => $detail['sale_price'],
                'quantity' => $detail['quantity'],

                'total_igv' => $totalIgv,
                'subtotal' => $subtotal,
                'total' => $total,

                'series' => $productSeries,

                'igv_type_id' => $detail['igv_type_id'],
                'sale_id' => $sale->id,
                'branch_product_id' => $detail['product_id']

            ]);

            if ($request->voucher['warranty'] && $branchProduct->product->have_warranty) {

                switch ($branchProduct->product->type_of_time_for_warranty) {
                    case 'days':
                        $dateDueWarrantyDetail = Carbon::now()->addDays($branchProduct->product->time_of_warranty);
                        break;
                    case 'weeks':
                        $dateDueWarrantyDetail = Carbon::now()->addWeeks($branchProduct->product->time_of_warranty);
                        break;
                    case 'months':
                        $dateDueWarrantyDetail = Carbon::now()->addMonths($branchProduct->product->time_of_warranty);
                        break;
                    case 'years':
                        $dateDueWarrantyDetail = Carbon::now()->addYears($branchProduct->product->time_of_warranty);
                        break;
                    default:
                        // En teoria no deberia entrar aca xd
                        break;
                }

                WarrantyDetail::create([

                    'date_due' => $dateDueWarrantyDetail,

                    'discount' => $detail['discount'],
                    'price' => $detail['sale_price'],
                    'quantity' => $detail['quantity'],
    
                    'total' => $total,
    
                    'series' => $productSeries,
    
                    'warranty_id' => $warranty->id,
                    'branch_product_id' => $detail['product_id']
                ]);

                if ($dateDueWarranty < $dateDueWarrantyDetail) {
                    
                    $dateDueWarranty = $dateDueWarrantyDetail;

                }

                $totalWarranty += $total;

            }

            $data['branch_product_id'] = $detail['product_id'];
            $data['quantity'] = $detail['quantity'];
            $data['document'] = $sale->serie->serie . '-' . $sale->document_number;
            $data['series'] = $productSeries;
            $data['user_id'] = $request->user_id;

            
            KardexService::sale($data);

        }


        if ($request->voucher['isMultiPayment']) {

            foreach ($request->voucher['payments'] as $payment) {

                $sale->paymentTypes()->attach($payment['payment_type_id'], ['amount' => $payment['amount']]);

            }

        }
        else {
            $sale->paymentTypes()->attach($request->voucher['payments'][0]['payment_type_id'], ['amount' => $totalSale - $request->voucher['discount']]);

            $sale->update([
                'received_money' => $request->voucher['received_money'],
                'change' => $request->voucher['change'],
            ]);

        }


        $sale->update([
            'subtotal' => $subtotalSale,
            'total_igv' => $totalIgvSale,
            'total_exonerated' => $totalExoneratedSale,
            'total_unaffected' => $totalUnaffectedSale,
            'total_free' => $totalFreeSale,
            'total_taxed' => $totalTaxedSale,
            'total' => $totalSale
        ]);

        if ($request->voucher['warranty']) {

            $warranty->update([
                'total' => $totalWarranty,
                'date_due' => $dateDueWarranty
            ]);

        }
        

        // Enviar a Sunat
        if ($request->voucher['document_type'] == 1) { // Factura

            $sunat = SunatService::facturar($sale->id, 'invoice');

            $sale->update([
                'send_sunat' => $sunat['send'],
                'state' => $sunat['state'],
                'response_sunat' => $sunat['response_sunat'],
                'description_sunat_cdr' => $sunat['response']['message'],
                'hash_cdr' => $sunat['response']['hash_cdr'],
                'hash_cpe' => $sunat['response']['hash_cpe']
            ]);
        }
        elseif ($request->voucher['document_type'] == 2) { // Boleta
            
            $sunat = SunatService::facturar($sale->id, 'ticket');

            $sale->update([
                'send_sunat' => $sunat['send'],
                'state' => $sunat['state'],
                'response_sunat' => $sunat['response_sunat'],
                'description_sunat_cdr' => $sunat['response']['message'],
                'hash_cdr' => $sunat['response']['hash_cdr'],
                'hash_cpe' => $sunat['response']['hash_cpe']
            ]);
        }
        else {

            return "Nota de Venta Guardada";

        }

        return $sale->description_sunat_cdr;
    }
}