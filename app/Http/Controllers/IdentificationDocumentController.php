<?php

namespace App\Http\Controllers;

use App\Models\IdentificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IdentificationDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identificationDocuments = IdentificationDocument::all();
        return response()->json($identificationDocuments);
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
     * @param  \App\Models\IdentificationDocument  $identificationDocument
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationDocument $identificationDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentificationDocument  $identificationDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentificationDocument $identificationDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationDocument  $identificationDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationDocument $identificationDocument)
    {
        //
    }

    public function getDataApi($cod, $number)
    {
        $token = env('TOKEN_APIS_PERU');
        // return response()->json([
        //     'token' => $token,
        //     'cod' => $cod,
        //     'number' => $number
        // ]);

        if ($cod == 6) {
            $url = "https://dniruc.apisperu.com/api/v1/ruc/$number?token=$token";

            $response = Http::acceptJson()->get($url)->throw();

            return response()->json([
                "name" => $response['razonSocial'],
                "address" => $response['direccion'],
                "ubigee" => $response['ubigeo']
            ]);

        } elseif ($cod == 1) {
            $url = "https://dniruc.apisperu.com/api/v1/dni/$number?token=$token";

            $response = Http::acceptJson()->get($url)->throw();

            return response()->json([
                "name" => $response['nombres'] . " " . $response['apellidoPaterno'] . " " . $response['apellidoMaterno'],
                "address" => ""
            ]);
        }

    }
}
