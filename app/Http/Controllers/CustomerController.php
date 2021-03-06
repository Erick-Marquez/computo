<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::included()
            ->filter()
            ->search()
            ->sort()
            ->getOrPaginate();

        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            $customer = Customer::create($request->all());
            return response()->json(['message' => 'cliente creado', 'request' => $customer], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
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
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'document' => 'required',
            'identification_document_id' => 'required',
        ]);

        try {
            $customer->update($request->all());
            return response()->json(['message' => 'Cliente editado']);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 405);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return response()->json([
                'message' => 'cliente eliminado'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 405);
        }
    }
}
