<?php

namespace App\Services;

use App\Models\BranchProduct;
use App\Models\BranchProductSerie;
use App\Models\Company;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseService
{
    public function storePurchase($request)
    {

        try {
            $provider = Provider::where('document', $request->provider['document'])->first();

            if (is_null($provider)) {
                $provider = Provider::updateOrCreate();
            }

            $purchase = Purchase::create([
                'document_type' => $request->voucherDetail['document_type'],
                'document_number' => $request->voucherDetail['document_number'],
                'serie' => $request->voucherDetail['serie'],
                'exchange_rate' => $request->voucherDetail['exchange_rate'],
                'date_issue' => $request->voucherDetail['date_issue'],
                'subtotal' => $request->voucherDetail['subtotal'],
                'total' => $request->voucherDetail['total'],
                'total_igv' => $request->voucherDetail['total_igv'],
                'observation' => $request->voucherDetail['observation'],
                'provider_id' => $provider['id'],
                'open_closed_cashbox_id' => auth()->user()->open_closed_cashbox_id,
            ]);

            $result = $this->updateProductsAndSeries($request->products, $purchase);

            if (!$result) {
                $purchase->delete();
                return back()->withError('No se pudo registrar la compra, algo esta pasando');
            }

            return response()->json([
                'message' => 'Compra registrada con exito!!'
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    # PUEDE SERVIR PARA EDITAR TAMBIEN :U
    public function updateProductsAndSeries($products, $purchase)
    {
        foreach ($products as $product) {
            $branch_product = BranchProduct::where('product_id', $product['id'])->first();

            if (is_null($branch_product)) {

                $branch_product = BranchProduct::create([
                    'branch_id' => auth()->user()->branch_id, // ! mala practica, se necesita antes un REQUEST->ADD
                    'product_id' => $product['id'],
                    'igv_type_id' => 20,
                    'stock' => 0,
                    'referential_purchase_price' => $product['referential_purchase_price'],
                ]);

                $data = [
                    'quantity' => 0,
                    'series' => $product['manager_series'] ? $product['series'] : [],
                    'branch_product_id' => $branch_product['id'],
                    'user_id' => auth()->user()->id
                ];

                KardexService::initialStock($data);
            }

            # creando modelos para la compra detalle
            PurchaseDetail::create([
                'price' => $product['referential_purchase_price'],
                'quantity' => $product['quantity'],
                'total_igv' => $product['total'] - $product['subtotal'],
                'subtotal' => $product['subtotal'],
                'total' => $product['total'],
                'series' => $product['manager_series'] ? $product['series'] : null,
                'purchase_id' => $purchase['id'],
                'branch_product_id' => $branch_product['id'],
            ]);

            $purchaseKardex = [
                'quantity' => $product['quantity'],
                'document' => $purchase['serie'] . '-' . $purchase['document_number'],
                'series' => $product['manager_series'] ? $product['series'] : [],
                'branch_product_id' => $branch_product['id'],
                'user_id' => auth()->user()->id
            ];

            KardexService::purchase($purchaseKardex);
        }

        return true;
    }

}
