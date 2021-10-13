<?php

namespace App\Services;

use App\Models\Cashbox;
use App\Models\OpenClosedCashbox;
use App\Models\OpenClosedCashboxDetail;
use App\Models\Sale;
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

    public function recoverOpening($id)
    {
        $cashbox = Cashbox::findOrFail($id);

        if (!$cashbox['state']) {  //  Verifico si esta aperturada o no

            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Accion no permitida'
            ], 401);
        }

        $openClosedCashbox = $cashbox->openClosedCashboxes->first();

        return $openClosedCashbox;
    }

    public function cashboxDetail($id)
    {
        try {
            $occ = $this->recoverOpening($id);

            $balance = [
              "sales" => $occ->sales()->sum('total'),
              "incomes" => $occ->openClosedCashboxDetails()->where('type', 'INGRESO')->sum('amount'),
              "expenses" => $occ->openClosedCashboxDetails()->where('type', 'EGRESO')->sum('amount')
            ];

            $sales = $occ->sales()
                        ->select('created_at as date', 'observation', 'total as amount')
                        ->get()
                        ->each(function($item, $key) {
                            return $item['concept'] = 'VENTA';
                        });

            $occd = $occ->openClosedCashboxDetails()
                        ->select('created_at as date', 'observation', 'amount', 'type as concept')
                        ->get();

            $movements = $sales->mergeRecursive($occd)->sortBy(['create_at', 'desc']);

            return response()->json([
                'cashbox_id' => $id,
                'opening_id' => $occ['id'],
                'opening_amount' => $occ['opening_amount'],
                'opening_date' => $occ['opening_date'],
                'user' => $occ->user->name,
                'movements' => $movements,
                'balance' => $balance,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function income($id, $data)
    {
        $occ = $this->recoverOpening($id);
        $data['type'] = 'INGRESO';
        $occ->openClosedCashboxDetails()->create($data);

        return response()->json($data);
    }

    public function expense($id, $data)
    {
        $occ = $this->recoverOpening($id);
        $data['type'] = 'EGRESO';
        $occ->openClosedCashboxDetails()->create($data);

        return response()->json($data);
    }
}
