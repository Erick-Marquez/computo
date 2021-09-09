<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\BrandLine;
use App\Models\Line;
use App\Models\Product;
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
        $products = Product::all();
        return view('catalogs.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $lines = Line::all();
        $brands = Brand::all();
        return view('catalogs.products.create', compact('lines', 'brands', 'branches'));
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

        Product::create([
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
}
