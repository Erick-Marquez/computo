<?php

namespace App\Http\Controllers;

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
        $providers = Provider::all();
        return view('third-parties.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $identification_documents = IdentificationDocument::all();
        return view('third-parties.providers.create', compact('identification_documents'));
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

        provider::create([
            'name' => $request->name,
            'comercial_name' => $request->comercial_name,
            'document' => $request->document,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'identification_document_id' => $request->identification_document_id,
        ]);

        return redirect()->route('providers.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $identification_documents = IdentificationDocument::all();
        return view('third-parties.providers.edit', compact('provider', 'identification_documents'));
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

        $provider->update($request->all());

        return redirect()->route('providers.index');
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
        return redirect()->route('providers.index');
    }
}
