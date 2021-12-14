<?php

namespace App\Http\Controllers;

use App\Http\Resources\LineResource;
use App\Models\Brand;
use App\Models\BrandLine;
use App\Models\Line;
use App\Models\Family;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                        ->getOrPaginate();
        return LineResource::collection($lines);
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
            'description' => 'required',
            'family_id' => 'required'
        ]);

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
        if ($line->brands()->count()) {
            return response()->json(['error' => 'Esta linea esta siendo usada por alguna marca.'], 405);
        }

        $line->delete();
        return LineResource::make($line);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addBrands(Request $request, Line $line)
    {
        //primero obtener los brand_line_id para la linea seleccionada
        $brandLines = BrandLine::where('line_id', $line->id)->get();
        $brandLineIds = [];

        foreach ($brandLines as $brandLine) {
            $brandLineIds[]= $brandLine['id'];
        }

        //obtener las marcas que estan en uso
        $brandsInUse = Product::select('brand_line.brand_id', 'brands.description')
            ->join('brand_line', 'products.brand_line_id', '=', 'brand_line.id')
            ->join('brands', 'brand_line.brand_id', '=', 'brands.id')
            ->whereIn('products.brand_line_id', $brandLineIds)
            ->groupBy('products.brand_line_id')
            ->get()->toArray();

        //comparar las marcas en uso con el request de las marcas si falta uno lanzar una excepcion 405 la marca esta en uso
        foreach ($request->brands as $brand) {
            foreach ($brandsInUse as $key => $brandInUse) {
                if ($brand == $brandInUse['brand_id']) {
                    unset($brandsInUse[$key]);
                }
            }
        }

        // Los elementos que queden el array estan en uso
        if (count($brandsInUse) > 0) {
            return response()->json(['error' => 'No puede quitar las marcas.', 'brands' => array_values($brandsInUse)], 422);
        }

        $line->brands()->sync($request->brands);
        
        return LineResource::make($line);
    }
}
