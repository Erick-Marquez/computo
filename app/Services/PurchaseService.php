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

            $provider = Provider::updateOrCreate(
                ['document' => $request->provider['document']],
                [
                    'name' => $request->provider['name'],
                    'phone' => $request->provider['phone'],
                    'address' => $request->provider['address'],
                    'identification_document_id' => $request->provider['identification_document_id'],
                    'ubigee_id' => $request->provider['ubigee_id'],
                ]
            );

            $purchase = Purchase::create([
                'document_type' => $request->voucherDetail['document_type'],
                'document_number' => $request->voucherDetail['document_number'],
                'serie' => $request->voucherDetail['serie'],
                'handles_exchange_rate' => $request->voucherDetail['handles_exchange_rate'],
                'exchange_rate' => $request->voucherDetail['exchange_rate'], // ? Deberia de haber un IF
                'date_issue' => $request->voucherDetail['date_issue'],
                'subtotal' => $request->voucherDetail['subtotal'],
                'total' => $request->voucherDetail['total'],
                'total_igv' => $request->voucherDetail['total_igv'],
                'observation' => $request->voucherDetail['observation'],
                'is_credit' => $request->voucherDetail['is_credit'],
                'provider_id' => $provider->id,
                'open_closed_cashbox_id' => auth()->user()->open_closed_cashbox_id,
            ]);


            // COMPRA A CREDITOS X CUOTAS

            if ($purchase->is_credit) {
                $accountToPay = $purchase->accountToPay()->create([
                    'debt' => array_sum($request->installments['amounts']),
                    'number_installments' => $request->installments['number'],
                ]);

                for ($i = 0; $i < $request->installments['number']; $i++) {
                    $accountToPay->accountToPayDetails()->create([
                        'date_issue' => $request->installments['dates'][$i],
                        'amount' => $request->installments['amounts'][$i],
                        'installment' => $i + 1,
                    ]);
                }
            }

            $result = $this->updateProductsAndSeries($request->products, $purchase);

            if (!$result) {
                $purchase->delete();
                return back()->withError('No se pudo registrar la compra, algo esta pasando');
            }

            return response()->json([
                'message' => 'Compra registrada con exito!!'
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 405);
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

            Product::where('id', $product['id'])->update([
                'referential_purchase_price' => $product['referential_purchase_price']
            ]);
        }

        return true;
    }
}
