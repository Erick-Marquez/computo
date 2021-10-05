<?php

namespace App\Services;

use App\Models\Cashbox;
use App\Models\OpenClosedCashbox;
use Carbon\Carbon;

class CashboxService
{

    public function openCashbox($request)
    {
        $cashbox = Cashbox::findOrFail($request['id']); //  Busco la caja en la bd

        if ($cashbox['state']) {  //  Verifico si esta aperturada o no

            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Esta Caja ya fue aperturada'
            ], 405);
        }

        //  Si la caja no esta aperturada, se procede a crear su apertura

        $user = auth()->user(); //  recupero la sesión

        $data['user_id'] = $user->id;
        $data['state'] = true;
        $data['opening_date'] = Carbon::now()->toDateTimeString();
        $data['opening_amount'] = $request['opening_amount'];
        $data['cashbox_id'] = $request['id'];

        try {
            $openClosedCashbox = OpenClosedCashbox::create($data); //  Creo la Apertura

            $cashbox->update(['state' => true]); //  Le doy un estado de TRUE - Aperturada a la caja

            return $openClosedCashbox; //  Devuelvo la apertura
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }

        // return response()->json($data);
    }

    public function closeCashbox($id, $data)
    {
        $cashbox = Cashbox::findOrFail($id); //  Busco la caja en la bd

        if (!$cashbox['state']) {  //  Verifico si esta aperturada o no

            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Esta Caja ya esta cerrada'
            ], 405);
        }

        $user = auth()->user(); //  recupero la sesión
        $data['user_id'] = $user->id;
        $data['state'] = false;
        $data['cashbox_id'] = $id;

        //  Actualizo cerrando la caja
        $openClosedCashbox = $cashbox->openClosedCashboxes
            ->update($data)
            ->where('closing_date', null);

        $cashbox->update(['state' => false]); //  Le doy un estado de FALSE - Cajas cerrada

        return $openClosedCashbox; //  Devuelvo los datos del cierre de caja
    }

    public function balanceCashbox($id)
    {
        // $shops = OpenClosedCashbox::findOrFail($id)->sales();
        // $sales
        // $details
    }
}
