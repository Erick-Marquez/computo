<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProviderResource;
use App\Models\IdentificationDocument;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::included()
                                ->filter()
                                ->search()
                                ->sort()
                                ->getOrPaginate();

        return ProviderResource::collection($providers);
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
            'name' => 'required',
            'document' => 'required',
            'identification_document_id' => 'required'
        ]);

        Provider::create($request->all());

        return response()->json([
            'message' => 'cliente creado'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
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
    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name' => 'required',
            'document' => 'required',
            'identification_document_id' => 'required',
        ]);

        try {
            $provider->update($request->all());
            return response()->json(["message" => "Proveedor actualizado"], 201);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 405);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response()->json([
            'message' => 'proveedor eliminado'
        ]);
    }
}
