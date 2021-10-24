<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseIncomeResource;
use App\Models\ExpenseIncome;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = ExpenseIncome::all();
        return ExpenseIncomeResource::collection($movements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add([
            'user_id' => auth()->user()->id,
            'branch_id' => auth()->user()->branch_id,
        ]);

        $request->validate([
            'type' => ['required', Rule::in(['INGRESO', 'EGRESO'])],
            'amount' => 'required|min:0|numeric',
            'observation' => 'required|min:10|string',
        ]);

        ExpenseIncome::create($request->all());

        return response()->json(['message' => 'Movimiento Registrado'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseIncome  $expenseIncome
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseIncome $expenseIncome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseIncome  $expenseIncome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseIncome $expenseIncome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseIncome  $expenseIncome
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseIncome $expenseIncome)
    {
        $expenseIncome->delete();

        return response()->json([
            'message' => 'eliminado',
        ]);
    }
}
