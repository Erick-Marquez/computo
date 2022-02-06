<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchProductSerieResource;
use App\Http\Resources\ProductResource;
use App\Models\BranchProductSerie;
use App\Models\Product;
use Illuminate\Http\Request;

class BranchProductSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # ?? xd
        $products = Product::where('manager_series', true)
            ->withCount([
                'branchProducts',
                'branchProductSeries as branchProductSerieAvailables' => function ($query) {
                    $query->where('sold', false);
                },
                'branchProductSeries as branchProductSerieSolds' => function ($query) {
                    $query->where('sold', true);
                },
            ])
            ->with([
                'branchProducts' => function ($query) {
                    $query->withCount('branchProductSeries');
                },
                'branchProducts.branch',
                'brand'
            ])
            ->get();
        return BranchProductSerieResource::collection($products);
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

    public function getAllSeries($serie)
    {
        $series = BranchProductSerie::where('serie', 'LIKE', '%' . $serie . '%')
            ->get();

        return BranchProductSerieResource::collection($series);
    }
}
