<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::included()
                            ->filter()
                            ->sort()
                            ->search()
                            ->getOrPaginate();
        return BrandResource::collection($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {

        $brand = brand::create([
            'cod' => $request->cod,
            'description' => $request->description,
        ]);

        return BrandResource::make($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
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
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $brand->update([
            'cod' => $request->cod,
            'description' => $request->description
        ]);

        return BrandResource::make($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->products()->count()) {
            return response()->json(['error' => 'Esta marca esta siendo usada por un producto.'], 405);
        }

        $brand->delete();
        return BrandResource::make($brand);

    }
}
