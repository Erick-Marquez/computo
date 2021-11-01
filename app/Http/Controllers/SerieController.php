<?php

namespace App\Http\Controllers;

use App\Http\Resources\SerieResource;
use App\Http\Resources\VoucherTypeResource;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\VoucherType;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Serie::with('branch', 'voucherType')->orderBy('branch_id', 'ASC')->orderBy('voucher_type_id', 'ASC')->get();
        return SerieResource::collection($series);
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
        // Falta validar las letras iniciales de las series(hacerlo en un clase request)
        $request->validate([
            'serie' => 'required|min:4|max:4|unique:series,serie',
            'current_number' => 'required|numeric',
            'voucher_type_id' => 'required',
            'branch_id' => 'required'
        ]);

        $serie = Serie::create([
            'serie' => $request->serie,
            'current_number' => $request->current_number - 1,
            'voucher_type_id' => $request->voucher_type_id,
            'branch_id' => $request->branch_id
        ]);

        return response()->json($serie);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
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
    public function update(Request $request, Serie $serie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        $serie->delete();
        return redirect()->route('series.index');
    }

    public function voucherTypes()
    {
        $voucherTypes = VoucherType::all();

        return VoucherTypeResource::collection($voucherTypes);
    }
}
