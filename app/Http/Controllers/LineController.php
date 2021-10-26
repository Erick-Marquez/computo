<?php

namespace App\Http\Controllers;

use App\Http\Resources\LineResource;
use App\Models\Brand;
use App\Models\Line;
use App\Models\Family;
use Illuminate\Http\Request;


class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lines = Line::all();
        return LineResource::collection($lines);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $families = Family::all();
        $brands = Brand::all();
        return view('catalogs.lines.create', compact('families', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'description' => 'required',
            'family_id' => 'required'
        ]);

        $line = line::create([
            'cod' => $request->cod,
            'description' => $request->description,
            'family_id' => $request->family_id,
        ]);

        $line->brands()->sync($request->brand_id);

        return redirect()->route('lines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Line $line)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Line $line)
    {
        $families = Family::all();
        $brands = Brand::all();
        return view('catalogs.lines.edit', compact('line', 'families', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Line $line)
    {
        $request->validate([
            'description' => 'required',
            'family_id' => 'required'
        ]);

        $line->update($request->all());

        $line->brands()->sync($request->brand_id);
        
        return redirect()->route('lines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Line $line)
    {
        $line->delete();
        return redirect()->route('lines.index');
    }
}
