<?php

namespace App\Services;

use App\Http\Controllers\VoucherController;
use App\Models\Cashbox;
use App\Models\Company;
use App\Models\OpenClosedCashbox;
use App\Models\OpenClosedCashboxDetail;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

            $openClosedCashbox = OpenClosedCashbox::create($data);
            $cashbox->update(['is_open' => true]);
            $user->update(['open_closed_cashbox_id' => $openClosedCashbox['id']]);

            return response()->json([$openClosedCashbox]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 405);
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

        if ($user['open_closed_cashbox_id'] != $id) {
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

            return response()->json($id);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function recoverOpening($id)
    {
        $cashbox = Cashbox::findOrFail($id);

        if (!$cashbox['is_open']) {  //  Verifico si esta aperturada o no
            return false;
        }

        $openClosedCashbox = $cashbox->openClosedCashboxes()->orderBy('created_at', 'desc')->first();

        return $openClosedCashbox;
    }

    public function cashboxDetail($id)
    {
        try {
            $occ = $this->recoverOpening($id);
            $movementsTotal = $occ->getMoneyCash();
            $movements = $occ->getMovementsArray();

            return response()->json([
                'cashbox_description' => $occ->cashbox->description,
                'cashbox_id' => $id,
                'opening_id' => $occ['id'],
                'opening_amount' => $occ['opening_amount'],
                'opening_date' => date("F j, Y, g:i a", strtotime($occ['opening_date'])),
                'user_name' => $occ->user->name,
                'user_id' => $occ->user->id,
                'movements' => $movements,
                'movementsTotal' => $movementsTotal,
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 405);
        }
    }

    public static function balance($id)
    {
        $occ = CashboxService::recoverOpening($id);
        $movements = $occ->getMoneyCash();

        $balance = $movements['opening_amount'] + $movements['sales'] + $movements['incomes'] + $movements['quotations']
                    - $movements['expenses'] - $movements['remunerations'] - $movements['credit_notes'];

        return $balance;
    }

    public function movement($id, $data)
    {
        $occ = $this->recoverOpening($id);
        try {
            $occ->openClosedCashboxDetails()->create($data);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 405);
        }
    }

    public function getDataReport($occ_id)
    {
        $occ = OpenClosedCashbox::findOrFail($occ_id);
        $cashbox = $occ->cashbox;
        $company = Company::first();

        $movements = $occ->getMovementsTotal();


        $salesDetails = DB::table('sales')
            ->join('series', 'sales.serie_id', '=', 'series.id')
            ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
            ->select('series.serie', 'sales.document_number', 'sales.created_at', 'sales.total', 'voucher_types.description')
            ->where('open_closed_cashbox_id', $occ['id'])
            ->get();

        $cashboxMovements = $occ->openClosedCashboxDetails;

        return compact("occ", "cashbox", "company", "movements", 'salesDetails', 'cashboxMovements');
    }
}
