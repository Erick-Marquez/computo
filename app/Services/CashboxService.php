<?php

namespace App\Services;

use App\Models\Cashbox;
use App\Models\OpenClosedCashbox;
use App\Models\OpenClosedCashboxDetail;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class CashboxService
{

    public function openCashbox($request)
    {
        $cashbox = Cashbox::findOrFail($request['id']); //  Busco la caja en la bd
        $user = User::findOrFail($request['user_id']);

        if ($cashbox['is_open']) {  //  Verifico si esta aperturada o no
            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Esta caja ya fue aperturada'
            ], 405);
        }

        if (!is_null($user['open_closed_cashbox_id'])) {
            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Usted ya aperturo otra caja',
            ], 405);
        }

        //  Si la caja no esta aperturada, se procede a crear su apertura
        $data['user_id'] = $user['id'];
        $data['state'] = true;
        $data['opening_date'] = Carbon::now()->toDateTimeString();
        $data['opening_amount'] = $request['opening_amount'];
        $data['cashbox_id'] = $cashbox['id'];

        try {

            $openClosedCashbox = OpenClosedCashbox::create($data); //  Creo la Apertura
            $cashbox->update(['is_open' => true]); //  Le doy un estado de TRUE - Aperturada a la caja
            $user->update(['open_closed_cashbox_id' => $openClosedCashbox['id']]);

            return response()->json([$openClosedCashbox]);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        // return response()->json($data);
    }

    public function closeCashbox($id, $request)
    {
        $cashbox = Cashbox::findOrFail($request['cashbox_id']);
        $user = User::findOrFail($request['user_id']);

        if (!$cashbox['is_open']) {  //  Verifico si esta aperturada o no
            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'No puede cerrar esta apertura'
            ], 405);
        }

        if ( $user['open_closed_cashbox_id'] != $id ) {
            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Usted no tiene permitido esta acción',
            ], 405);
        }

        $request['closing_amount'] = $this->balance($cashbox['id']);
        $request['closing_date'] = Carbon::now()->toDateTimeString();
        $request['state'] = false;

        try {
            OpenClosedCashbox::findOrFail($id)->update($request);
            $cashbox->update(['is_open' => false]);
            $user->update(['open_closed_cashbox_id' => null]);

            return response()->json([
                'message' => 'Cerrado con exito'
            ]);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function recoverOpening($id)
    {
        $cashbox = Cashbox::findOrFail($id);

        if (!$cashbox['is_open']) {  //  Verifico si esta aperturada o no

            return response()->json([   //  Devuelvo un mensaje y un 405 de metodo no permitido
                'message' => 'Accion no permitida'
            ], 401);
        }

        $openClosedCashbox = $cashbox->openClosedCashboxes()->orderBy('created_at', 'desc')->first();

        return $openClosedCashbox;
    }

    public function cashboxDetail($id)
    {
        try {
            $occ = $this->recoverOpening($id);

            $balance = [
                "sales" => $occ->sales()->sum('total'),
                "purchases" => $occ->purchases()->sum('total'),
                "incomes" => $occ->openClosedCashboxDetails()->where('type', 'INGRESO')->sum('amount'),
                "expenses" => $occ->openClosedCashboxDetails()->where('type', 'EGRESO')->sum('amount')
            ];

            $sales = $occ->sales()
                            ->select('created_at as date', 'observation', 'total as amount')
                            ->get()
                            ->each(function ($item, $key) {
                                return $item['concept'] = 'VENTA';
                            });

            $purchases = $occ->purchases()
                            ->select('created_at as date', 'observation', 'total as amount')
                            ->get()
                            ->each(function ($item, $key) {
                                return $item['concept'] = 'COMPRA';
                            });

            $occd = $occ->openClosedCashboxDetails()
                        ->select('created_at as date', 'observation', 'amount', 'type as concept')
                        ->get();

            $movements = $sales->mergeRecursive($purchases)->mergeRecursive($occd)->sortBy(['create_at', 'desc']);

            return response()->json([
                'cashbox_description' => $occ->cashbox->description,
                'cashbox_id' => $id,
                'opening_id' => $occ['id'],
                'opening_amount' => $occ['opening_amount'],
                'opening_date' => date("F j, Y, g:i a", strtotime($occ['opening_date'])),
                'user_name' => $occ->user->name,
                'user_id' => $occ->user->id,
                'movements' => $movements,
                'balance' => $balance,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function balance($id)
    {
        $occ = CashboxService::recoverOpening($id);

        $openingAmount = $occ->opening_amount;
        $sales = $occ->sales()->sum('total');
        $purchases = $occ->purchases()->sum('total');
        $incomes = $occ->openClosedCashboxDetails()->where('type', 'INGRESO')->sum('amount');
        $expenses = $occ->openClosedCashboxDetails()->where('type', 'EGRESO')->sum('amount');

        $balance = $openingAmount + $sales + $incomes - $expenses - $purchases;

        return $balance;
    }

    public function movement($id, $data)
    {
        $occ = $this->recoverOpening($id);

        try {
            $occ->openClosedCashboxDetails()->create($data);
            return response()->json($data);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
