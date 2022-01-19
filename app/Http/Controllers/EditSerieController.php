<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchProductSerieResource;
use App\Http\Resources\GlobalResource;
use App\Models\BranchProductSerie;
use App\Models\Product;
use App\Services\KardexService;
use Illuminate\Http\Request;

class EditSerieController extends Controller
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
        $series = BranchProductSerie::where('branch_product_id', $id)->where('sold', false)->paginate(intVal(request('perPage')));

        return GlobalResource::collection($series);
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
        $branchProductSerie = BranchProductSerie::findOrFail($id);

        $branchProductSerie->update([
            'serie' => $request->newSerie
        ]);

        KardexService::serieEdit(
            array($request->oldSerie),
            array($request->newSerie),
            $branchProductSerie->branch_product_id,
            auth()->user()->id);

        return response()->json($branchProductSerie);
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
}