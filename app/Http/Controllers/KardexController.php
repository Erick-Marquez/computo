<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchProductResource;
use App\Http\Resources\KardexResource;
use App\Models\BranchProduct;
use App\Models\Kardex;
use Illuminate\Http\Request;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $kardex = Kardex::where('branch_product_id', $id)->paginate(3)->sum('quantity');
        $kardex = Kardex::where('branch_product_id', $id)->get();
        return KardexResource::collection($kardex);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchProducts($branchId, $search)
    {
        $branchProducts = BranchProduct::select('branch_product.id', 'p.name', 'p.slug', 'p.cod', 'b.description as brand', 'branch_product.stock', 'p.manager_series', 'branch_product.referential_purchase_price')
            ->where('branch_id', $branchId)
            ->join('products as p', 'branch_product.product_id', '=', 'p.id')
            ->join('brands as b', 'p.brand_id', '=', 'b.id')
            ->where('p.slug', 'like', '%'. $search .'%')
            ->limit(10)->get();
        return BranchProductResource::collection($branchProducts);
    }
    
    public function print($branchProductId)
    {
        $kardex = Kardex::where('branch_product_id', $branchProductId)->get();
        return KardexResource::collection($kardex);
    }
}
