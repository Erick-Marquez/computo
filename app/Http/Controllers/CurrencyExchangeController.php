<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyExchangeResource;
use App\Models\CurrencyExchange;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CurrencyExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencyExchanges = CurrencyExchange::latest()->get();
        return CurrencyExchangeResource::collection($currencyExchanges);
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
        $request->validate([
            'change' => 'required|numeric'
        ]);

        $currencyExchange = CurrencyExchange::create([
            'change' => $request->change,
            'date' => Carbon::now()->toDateString()
        ]);

        return response()->json($currencyExchange);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        $currencyExchange = CurrencyExchange::findOrFail($id);

        $currencyExchange->update([
            'change' => $request->change,
            'date' => Carbon::now()->toDateString()
        ]);
        return $currencyExchange;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currencyExchange = CurrencyExchange::findOrFail($id);
        $currencyExchange->delete();
        return response()->json(['message' => 'Cambio de Divisa Eliminado']);
    }

    public function currentCurrencyExchange()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.sunat.gob.pe/a/txt/tipoCambio.txt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($httpCode == 200) {
            if ($response != "") {
                
                $html = $response;
    
                $explode = explode('|', $html);
    
                $values = [
                    'fecha' => $explode[0],
                    'compra' => $explode[1],
                    'venta' => $explode[2]
                ];
    
                return $values;
    
            }
            
        } else {
            return "Problema de conexion";
        }

        
    }
}
