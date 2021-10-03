<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogs.families.create');
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
            'description' => 'required'
        ]);

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
        return $family;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        return view('catalogs.families.edit', compact('family'));
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

        $family->update($request->all());

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
        $family->delete();
        return redirect()->route('families.index');
    }
}
