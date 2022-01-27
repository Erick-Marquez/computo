<?php

namespace App\Http\Controllers;

use App\Http\Resources\GlobalResource;
use App\Http\Resources\ProductResource;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Brand;
use App\Models\CurrencyExchange;
use App\Models\IgvType;
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
        if (empty(request('search'))) {
            $products = Product::paginate(intVal(request('perPage')));
        }
        else {

            $search = request('search');

            $products = Product::where(function($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('cod', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
            })->paginate(intVal(request('perPage')));

        }

        return GlobalResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('state', true)->get();
        $lines = Line::where('active', true)->get();
        $brands = Brand::where('active', true)->get();
        $currencyExchange = CurrencyExchange::latest()->first();
        $igvTypes = IgvType::all();

        return GlobalResource::make([
            'branches' => $branches,
            'lines' => $lines,
            'brands' => $brands,
            'currencyExchange' => $currencyExchange,
            'igvTypes' => $igvTypes
        ]);
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

        $slug = join(' ', [Line::find($request->line_id)->description, Brand::find($request->brand_id)->description, $request->name]);

        $product = Product::create([
            'cod' => $request->cod,
            'slug' => $slug,
            'name' => $request->name,
            'description' => $request->description,
            'referential_purchase_price' => $request->referential_purchase_price,
            'sale_gain_one' => $request->sale_gain_one,
            'sale_gain_two' => $request->sale_gain_two,
            'sale_gain_three' => $request->sale_gain_three,
            'manager_series' => $request->manager_series,


            'have_warranty' => $request->have_warranty,
            'type_of_time_for_warranty' => $request->type_of_time_for_warranty,
            'time_of_warranty' => $request->time_of_warranty,

            'igv_type_id' => $request->igv_type_id, // obtener del tipo de IGV de la sucursal
            'brand_id' => $request->brand_id,
            'line_id' => $request->line_id
        ]);

        // Inventario Inicial

        foreach ($request->branches as $branch) {

            $branchProduct = BranchProduct::create([
                'stock' => 0,
                'referential_purchase_price' => $request->referential_purchase_price,
                'sale_gain_one' => $request->sale_gain_one,
                'sale_gain_two' => $request->sale_gain_two,
                'sale_gain_three' => $request->sale_gain_three,
                'manager_series' => $request->manager_series,

                'have_warranty' => $request->have_warranty,
                'type_of_time_for_warranty' => $request->type_of_time_for_warranty,
                'time_of_warranty' => $request->time_of_warranty,

                'igv_type_id' => $request->igv_type_id, // obtener del tipo de IGV de la sucursal,
                'branch_id' => $branch['id'],
                'product_id' => $product->id,
            ]);

            // dar formato a las series
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
    public function edit($id)
    {
        $lines = Line::where('active', true)->get();
        $brands = Brand::where('active', true)->get();
        $currencyExchange = CurrencyExchange::latest()->first();
        $igvTypes = IgvType::all();

        $product = Product::findOrFail($id);

        return GlobalResource::make([
            'lines' => $lines,
            'brands' => $brands,
            'currencyExchange' => $currencyExchange,
            'igvTypes' => $igvTypes,

            'product' => $product
        ]);
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

        $slug = join(' ', [Line::find($request->line_id)->description, Brand::find($request->brand_id)->description, $request->name]);

        $product->update([

            'cod' => $request->cod,
            'slug' => $slug,
            'name' => $request->name,
            'description' => $request->description,
            'referential_purchase_price' => $request->referential_purchase_price,
            'sale_gain_one' => $request->sale_gain_one,
            'sale_gain_two' => $request->sale_gain_two,
            'sale_gain_three' => $request->sale_gain_three,

            'have_warranty' => $request->have_warranty,
            'type_of_time_for_warranty' => $request->type_of_time_for_warranty,
            'time_of_warranty' => $request->time_of_warranty,

            'igv_type_id' => $request->igv_type_id, // obtener del tipo de IGV de la sucursal
            'brand_id' => $request->brand_id,
            'line_id' => $request->line_id
        ]);


        return GlobalResource::make($product);
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

    public function searchProductsTrait()
    {
        $products = Product::included()
            ->filter()
            ->search()
            ->sort()
            ->getOrPaginate();

        return GlobalResource::collection($products);
    }
}
