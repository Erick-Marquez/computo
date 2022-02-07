<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyRequest;
use App\Http\Resources\FamilyResource;
use Illuminate\Http\Request;
use App\Models\Family;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::all();
        return FamilyResource::collection($families);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyRequest $request)
    {
        $family = Family::create([
            'cod' => $request->cod,
            'description' => $request->description,
        ]);

        return FamilyResource::make($family);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        return FamilyResource::make($family);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $family->update([
            'cod' => $request->cod,
            'description' => $request->description
        ]);

        return FamilyResource::make($family);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        if ($family->lines()->count()) {
            return response()->json(['error' => 'Para eliminar la familia tiene que eliminar las lineas.'], 405);
        }

        $family->delete();
        return response()->noContent();
    }
}
