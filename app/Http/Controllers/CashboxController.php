<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CashboxResource;
use App\Models\Cashbox;
use App\Services\CashboxService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        //
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
        //
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
        $cashbox->delete();
        return response()->json(['message' => 'Caja eliminada']);
    }

    // Aperturar caja
    public function openCashbox(Request $request)
    {
        $request->validate([
            'opening_amount' => 'required|numeric',
            'state' => 'required|boolean',
            'closing_date' => 'prohibited',
            'closing_amount' => 'prohibited'
        ]);

        return $this->cashboxService->openCashbox($request->all());
    }

    // Cerrar caja
    public function closeCashbox($id, Request $request)
    {
        $request->validate([
            'closing_date' => 'required|date',
            'closing_amount' => 'required|numeric',
            'state' => 'required|boolean',
            'cashbox_id' => 'required|exists:cashboxes,id',
            'opening_date' => 'prohibited',
            'opening_amount' => 'prohibited',
        ]);

        return $this->cashboxService->closeCashbox($id, $request->all());
    }

    public function cashboxDetail($id)
    {
        return $this->cashboxService->cashboxDetail($id);
    }

    public function income($id, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        return $this->cashboxService->income($id, $request->all());
    }

    public function expense($id, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        return $this->cashboxService->expense($id, $request->all());
    }

}
