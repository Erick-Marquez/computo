<?php

namespace App\Http\Controllers;

use App\Models\BranchProduct;
use App\Models\BranchProductSerie;
use App\Models\Provider;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // * ESTO CORRESPONDE A LA PARTE DEL PROVEEDOR
        if (is_null($request->provider['id'])) {
            // ! ESTO TIENE QUE PASAR POR UN METODO CREATE EN PROVEEDOR Y HACER UN REQUEST
            $provider = Provider::create($request->provider);
        } else {
            $provider = Provider::findOrFail($request->provider['id']);
        }

        $request->validate([
            'serie' => 'required',
        ]);

        $products = $request->products;

        foreach ($products as $key => $product) {
            $branch_product = BranchProduct::where('product_id', $product['id'])->first();

            if (!is_null($branch_product)) { # actualiza si ya existe
                $branch_product->update([
                    'stock' => $branch_product['stock'] + $product['quantity'],
                    'referential_purchase_price' => $product['referential_purchase_price'],
                    'manager_series' => count($product['series']) ? true : false
                ]);
            } else { # si esto es nulo, que chucha hacemos
                $branch_product = BranchProduct::create([
                    'branch_id' => auth()->user()->branch_id,
                    'product_id' => $product['id'],
                    'igv_type_id' => 20,
                    'stock' => $product['quantity'],
                    'referential_purchase_price' => $product['referential_purchase_price'],
                ]);
            }

            if (count($product['series'])) {
                foreach ($product['series'] as $key => $serie) {
                    BranchProductSerie::create([
                        'branch_product_id' => $branch_product['id'],
                        'serie' => $serie
                    ]);
                }
            }
        }

        Purchase::create([
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

        return response()->json(['message' => 'todo bien']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
