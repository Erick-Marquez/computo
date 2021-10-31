<?php

namespace App\Services;

use App\Models\BranchProduct;
use App\Models\BranchProductSerie;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseService
{
    public function storePurchase($request)
    {

        try {
            $provider = Provider::firstOrCreate($request->provider);

            $purchase = Purchase::create([
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'serie' => $request->serie,
                'exchange_rate' => $request->exchange_rate,
                'date_issue' => $request->date_issue,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'observation' => $request->observation,
                'provider_id' => $provider['id'],
            ]);

            $result = $this->updateProductsAndSeries($request->products, $purchase['id']);

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
    public function updateProductsAndSeries($products, $purchaseId)
    {
        foreach ($products as $product) {
            $branch_product = BranchProduct::where('product_id', $product['id'])->first();

            if (!is_null($branch_product)) { # actualiza si ya existe
                $branch_product->update([
                    'stock' => $branch_product['stock'] + $product['quantity'],
                    'referential_purchase_price' => $product['referential_purchase_price'],
                    'manager_series' => count($product['series']) ? true : false
                ]);
            } else { # si esto es nulo, que chucha hacemos
                $branch_product = BranchProduct::create([
                    'branch_id' => auth()->user()->branch_id, // ! mala practica, se necesita antes un REQUEST->ADD
                    'product_id' => $product['id'],
                    'igv_type_id' => 20,
                    'stock' => $product['quantity'],
                    'referential_purchase_price' => $product['referential_purchase_price'],
                ]);
            }

            # Si tiene series registradas o no
            if (count($product['series'])) {
                foreach ($product['series'] as $serie) {
                    BranchProductSerie::create([
                        'branch_product_id' => $branch_product['id'],
                        'serie' => $serie
                    ]);
                }
            }

            # creando modelos para la compra detalle
            PurchaseDetail::create([
                'price' => $product['referential_purchase_price'],
                'quantity' => $product['quantity'],
                'total_igv' => 0,
                'subtotal' => $product['referential_purchase_price'] * $product['quantity'],
                'total' => $product['referential_purchase_price'] * $product['quantity'],
                'series' => count($product['series']) ? implode(",", $product['series']) : null,
                'purchase_id' => $purchaseId,
                'branch_product_id' => $branch_product['id'],
            ]);
        }

        return true;
    }
}
