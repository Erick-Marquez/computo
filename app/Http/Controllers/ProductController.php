<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Http\Resources\CurrencyExchangeResource;
use App\Http\Resources\LineResource;
use App\Http\Resources\ProductResource;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Brand;
use App\Models\BrandLine;
use App\Models\CurrencyExchange;
use App\Models\Line;
use App\Models\Product;
use App\Services\KardexService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::included()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'line_id' => 'required',
            'brand_id' => 'required'
        ]);

        $brandLine = BrandLine::select('id')->where('line_id', $request->line_id)->where('brand_id', $request->brand_id)->first();

        $product = Product::create([
            'cod' => $request->cod,
            'name' => $request->name,
            'description' => $request->description,
            'referential_purchase_price' => $request->referential_purchase_price,
            'referential_sale_price' => $request->referential_sale_price,
            'referential_sale_price_one' => $request->referential_sale_price_one,
            'referential_sale_price_two' => $request->referential_sale_price_two,
            'manager_series' => $request->manager_series,
            'igv_type_id' => 20, // obtener del tipo de IGV de la sucursal
            'brand_line_id' => $brandLine->id
        ]);

        // Inventario Inicial

        foreach ($request->branches as $branch) {

            $branchProduct = BranchProduct::create([
                'stock' => 0,
                'referential_purchase_price' => $request->referential_purchase_price,
                'sale_price' => $request->referential_sale_price,
                'referential_sale_price_one' => $request->referential_sale_price_one,
                'referential_sale_price_two' => $request->referential_sale_price_two,
                'manager_series' => $request->manager_series,
                'igv_type_id' => 20, // obtener del tipo de IGV de la sucursal,
                'branch_id' => $branch['id'],
                'product_id' => $product->id,
            ]);


            $productSeries = [];

            if ($request->manager_series) {
                foreach ($branch['series'] as $serie) {
                    array_push($productSeries, $serie['serie']);
                }
            }


            $data['branch_product_id'] = $branchProduct->id;
            $data['quantity'] = $branch['quantity'];
            $data['series'] = $productSeries;
            $data['user_id'] = auth()->user()->id;

            KardexService::initialStock($data);
        }

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $branches = Branch::all();
        $lines = Line::all();
        $brands = Brand::all();
        return view('catalogs.products.edit', compact('product', 'lines', 'brands', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'line_id' => 'required',
            'brand_id' => 'required'
        ]);

        $brandLine = BrandLine::select('id')->where('line_id', $request->line_id)->where('brand_id', $request->brand_id)->first();

        $product->update([
            'cod' => $request->cod,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            //'active' => $request->active,
            'brand_line_id' => $brandLine->id,
        ]);


        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function branches()
    {
        $branches = Branch::where('state', true)->get();
        return BranchResource::collection($branches);
    }

    public function lines()
    {
        $lines = Line::where('active', true)->get();
        return LineResource::collection($lines);
    }

    public function brands($id)
    {
        $line = Line::findOrFail($id);
        $brands = $line->brands;
        return LineResource::collection($brands);
    }

    public function currencyExchanges()
    {
        $currencyExchange = CurrencyExchange::latest()->first();
        return $currencyExchange;
    }
}
