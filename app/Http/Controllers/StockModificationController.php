<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockModificationRequest;
use App\Http\Resources\BranchProductResource;
use App\Http\Resources\BranchProductSerieResource;
use App\Http\Resources\StockModificationResource;
use App\Models\BranchProduct;
use App\Models\BranchProductSerie;
use App\Models\StockModification;
use App\Services\KardexService;
use Illuminate\Http\Request;

class StockModificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockModifications = StockModification::with('branchProduct.product')
                                ->included()
                                ->filter()
                                ->search()
                                ->sort()
                                ->getOrPaginate();

        return StockModificationResource::collection($stockModifications);
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
    public function store(StockModificationRequest $request)
    {
        $stockModification = StockModification::create([

            'observation' => $request->observation,
            'date' => now(),

            'quantity' => $request->quantity,
            'operation' => $request->operation,
            'series' => $request->series,

            'branch_product_id' => $request->branch_product_id,
            'branch_id' => $request->branch_id,
            'user_id' => auth()->user()->id
        ]);

        KardexService::stockModification($request->quantity, $request->operation, $request->series, $request->branch_product_id, auth()->user()->id);

        return StockModificationResource::make($stockModification);
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
    
    public function getBranchProductSeries($branchProductId)
    {
        $branchProductSeries = BranchProductSerie::select('serie')
            ->where('branch_product_id', $branchProductId)
            ->where('sold', '=', 0)
            ->get();

        return BranchProductSerieResource::make($branchProductSeries);

    }
}
