<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineRequest;
use App\Http\Resources\LineResource;
use App\Models\Line;
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
        $lines = Line::included()
                        ->filter()
                        ->sort()
                        ->search()
                        ->getOrPaginate();
        return LineResource::collection($lines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineRequest $request)
    {

        $line = line::create([
            'cod' => $request->cod,
            'description' => $request->description,
            'family_id' => $request->family_id,
        ]);

        return LineResource::make($line);
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

        $line->update([
            'cod' => $request->cod,
            'description' => $request->description,
            'family_id' => $request->family_id,
        ]);

        // $line->brands()->sync($request->brand_id);
        
        return LineResource::make($line);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Line $line)
    {
        if ($line->products()->count()) {
            return response()->json(['error' => 'Esta linea esta siendo usada por algun producto.'], 405);
        }

        $line->delete();
        return LineResource::make($line);
    }
}
