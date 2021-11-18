<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CashboxResource;
use App\Models\Cashbox;
use App\Models\Company;
use App\Models\OpenClosedCashbox;
use App\Models\Purchase;
use App\Services\CashboxService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class CashboxController extends Controller
{

    public $cashboxService;

    public function __construct()
    {
        $this->cashboxService = new CashboxService();
    }

    public function index()
    {
        $user = auth()->user()->branch_id;
        $cashboxes = Cashbox::all()->where('branch_id', $user);

        return CashboxResource::collection($cashboxes);
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
            'description' => 'string|min:5|required'
        ]);

        $data = $request->all();
        $branch = auth()->user()->branch_id;
        $data['branch_id'] = $branch;

        Cashbox::create($data);

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function show(Cashbox $cashbox)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cashbox $cashbox)
    {
        $request->validate([
            'description' => 'string|min:5|required'
        ]);

        $cashbox->update($request->all());

        return response()->json([
            'message' => 'Actualización completada'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cashbox = Cashbox::findOrFail($id);

        if ($cashbox['is_open']) {
            return response()->json(['error' => 'Cierre la caja primero'], 405);
        }

        $cashbox->delete();
        return response()->json(['message' => 'Caja eliminada']);
    }

    // Aperturar caja
    public function openCashbox(Request $request)
    {
        $request->request->add(['user_id' => auth()->user()->id]);

        $request->validate([
            'id' => 'required|exists:cashboxes,id',
            'opening_amount' => 'required|numeric',
            'closing_date' => 'prohibited',
            'closing_amount' => 'prohibited'
        ]);

        return $this->cashboxService->openCashbox($request->all());
    }

    // Cerrar caja
    public function closeCashbox($id, Request $request)
    {
        $request->request->add(['user_id' => auth()->user()->id]);

        $request->validate([
            'id' => 'exists:open_closed_cashboxes,id',
            'cashbox_id' => 'exists:cashboxes,id',
            'user_id' => 'exists:users,id'
        ]);

        return $this->cashboxService->closeCashbox($id, $request->all());
    }

    public function cashboxDetail($id)
    {
        return $this->cashboxService->cashboxDetail($id);
    }

    public function movement($id, Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(['INGRESO', 'EGRESO'])],
            'amount' => 'required|min:0|numeric',
            'observation' => 'required|min:10|string',
        ]);

        return $this->cashboxService->movement($id, $request->all());
    }

    public function reportCashboxOpenClosed($occId)
    {
        $dataReport = $this->cashboxService->getDataReport($occId);
        $pdf = \PDF::loadView('templates.pdf.report-cashbox-oc', $dataReport)->setPaper('A4','portrait');
        return $pdf->stream();
    }
}
